# AssetOS Docker 部署指南

## 📦 Docker镜像发布流程

我们为AssetOS创建了完整的Docker构建和发布流程，支持多种部署方式。

## 🛠 构建和发布

### 方式一：使用快速发布脚本（推荐）

```bash
# 构建最新版本
./quick-release.sh

# 构建特定版本
./quick-release.sh v1.0.0
```

### 方式二：使用完整构建脚本

```bash
# 运行交互式构建脚本
./build-and-push.sh

# 选择操作：
# 1) 仅构建镜像
# 2) 构建并测试  
# 3) 构建、测试并推送到Docker Hub
# 4) 清理并重新构建
```

### 方式三：手动构建

```bash
# 构建镜像
docker build -t dstansice/assetos:latest .

# 测试镜像
docker run -d --name test -p 8081:80 dstansice/assetos:latest

# 推送镜像
docker login
docker push dstansice/assetos:latest
```

## 🚀 使用Docker镜像

### 快速启动

```bash
# 创建数据目录
mkdir -p assetOS/data

# 运行容器
docker run -d \
  --name assetOS \
  -p 8080:80 \
  -v $(pwd)/assetOS/data:/var/www/html/db \
  --restart unless-stopped \
  dstansice/assetos:latest

# 访问应用
open http://localhost:8080
```

### 使用Docker Compose

创建 `docker-compose.yml`：

```yaml
version: '3.8'

services:
  assetos:
    image: dstansice/assetos:latest
    container_name: assetOS
    ports:
      - "8080:80"
    volumes:
      - ./data:/var/www/html/db
      - ./backups:/var/www/html/backups
    restart: unless-stopped
    healthcheck:
      test: ["CMD", "/usr/local/bin/healthcheck"]
      interval: 30s
      timeout: 10s
      retries: 3
      start_period: 40s

  # 可选：数据库备份服务
  backup:
    image: alpine:latest
    container_name: assetOS-backup
    volumes:
      - ./data:/data
      - ./backups:/backups
    command: >
      sh -c "
      apk add --no-cache sqlite dcron &&
      echo '0 2 * * * cd /data && sqlite3 database.sqlite \".backup /backups/backup_\$$(date +%Y%m%d_%H%M%S).sqlite\"' | crontab - &&
      crond -f
      "
    restart: unless-stopped
    depends_on:
      - assetos

networks:
  default:
    name: assetos-network
```

启动服务：

```bash
docker-compose up -d
```

## 🔧 高级配置

### 环境变量

| 变量名 | 描述 | 默认值 |
|--------|------|--------|
| `APACHE_DOCUMENT_ROOT` | Web根目录 | `/var/www/html` |
| `PHP_MEMORY_LIMIT` | PHP内存限制 | `256M` |
| `PHP_UPLOAD_MAX_FILESIZE` | 上传文件大小限制 | `10M` |
| `TZ` | 时区设置 | `Asia/Shanghai` |

### 数据持久化

确保以下目录被正确挂载：

- `/var/www/html/db` - 数据库文件
- `/var/www/html/backups` - 备份文件（可选）

### 端口配置

- `80` - HTTP端口（容器内）
- 映射到主机端口（如8080）

### 健康检查

容器内置健康检查，检查Web服务是否正常运行：

```bash
# 手动健康检查
docker exec assetOS /usr/local/bin/healthcheck

# 查看健康状态
docker inspect --format='{{.State.Health.Status}}' assetOS
```

## 📋 多平台支持

Docker镜像支持以下平台：

- `linux/amd64` - x86_64架构
- `linux/arm64` - ARM64架构（Apple Silicon等）

## 🔄 自动化CI/CD

项目包含GitHub Actions工作流，自动构建和发布：

- **触发条件**: 推送到main/master分支或创建tag
- **构建平台**: linux/amd64, linux/arm64
- **发布目标**: Docker Hub
- **自动测试**: 容器启动和健康检查

### 设置GitHub Secrets

需要在GitHub仓库设置以下Secrets：

- `DOCKER_USERNAME` - Docker Hub用户名
- `DOCKER_PASSWORD` - Docker Hub密码或访问令牌

## 🐛 故障排除

### 常见问题

1. **权限问题**
   ```bash
   # 检查目录权限
   ls -la data/
   
   # 修复权限
   sudo chown -R 33:33 data/
   chmod -R 775 data/
   ```

2. **端口冲突**
   ```bash
   # 检查端口占用
   lsof -i :8080
   
   # 使用其他端口
   docker run -p 8081:80 dstansice/assetos:latest
   ```

3. **数据库问题**
   ```bash
   # 查看日志
   docker logs assetOS
   
   # 进入容器检查
   docker exec -it assetOS bash
   ```

### 调试模式

```bash
# 以调试模式运行
docker run -it --rm \
  -p 8080:80 \
  -v $(pwd)/data:/var/www/html/db \
  dstansice/assetos:latest \
  bash
```

## 📞 支持

- **GitHub**: https://github.com/DsTansice/AssetOS
- **Issues**: https://github.com/DsTansice/AssetOS/issues
- **Telegram群**: https://t.me/AssetOSOffical
- **Telegram频道**: https://t.me/OPAssetOS
- **商业许可**: admin@010085.xyz

## 📊 镜像信息

- **基础镜像**: php:8.2-apache
- **架构**: Multi-platform (amd64/arm64)
- **大小**: ~200MB (压缩后)
- **安全**: 定期更新，漏洞扫描
- **标签策略**: 
  - `latest` - 最新稳定版
  - `v1.0.0` - 具体版本号
  - `main` - 开发版本
