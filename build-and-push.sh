#!/bin/bash

# AssetOS Docker 构建和发布脚本
# 作者: DsTansice
# 日期: 2025-07-10

set -e

# 配置变量
IMAGE_NAME="dstansice/assetos"
VERSION="1.0.0"
LATEST_TAG="latest"

# 颜色输出
RED='\033[0;31m'
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# 日志函数
log_info() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

log_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

log_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

log_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# 检查Docker是否安装
check_docker() {
    if ! command -v docker &> /dev/null; then
        log_error "Docker 未安装，请先安装Docker"
        echo "安装方法："
        echo "  macOS: brew install --cask docker"
        echo "  Ubuntu: curl -fsSL https://get.docker.com | sh"
        echo "  或访问: https://docs.docker.com/get-docker/"
        exit 1
    fi
    log_success "Docker 已安装: $(docker --version)"
}

# 检查Docker是否运行
check_docker_running() {
    if ! docker info &> /dev/null; then
        log_error "Docker 服务未运行，请启动Docker Desktop"
        exit 1
    fi
    log_success "Docker 服务正在运行"
}

# 清理旧的镜像和容器
cleanup() {
    log_info "清理旧的镜像和容器..."
    
    # 停止并删除容器
    if docker ps -a | grep -q "assetos-build"; then
        docker stop assetos-build 2>/dev/null || true
        docker rm assetos-build 2>/dev/null || true
    fi
    
    # 删除旧的镜像
    if docker images | grep -q "$IMAGE_NAME"; then
        log_warning "发现旧镜像，正在删除..."
        docker rmi $(docker images "$IMAGE_NAME" -q) 2>/dev/null || true
    fi
    
    log_success "清理完成"
}

# 构建Docker镜像
build_image() {
    log_info "开始构建Docker镜像..."
    
    # 检查Dockerfile是否存在
    if [[ ! -f "Dockerfile" ]]; then
        log_error "Dockerfile 不存在"
        exit 1
    fi
    
    # 构建镜像
    log_info "构建镜像: $IMAGE_NAME:$VERSION"
    docker build -t "$IMAGE_NAME:$VERSION" .
    
    # 添加latest标签
    log_info "添加latest标签"
    docker tag "$IMAGE_NAME:$VERSION" "$IMAGE_NAME:$LATEST_TAG"
    
    log_success "镜像构建完成"
}

# 测试镜像
test_image() {
    log_info "测试镜像..."
    
    # 运行容器进行测试
    log_info "启动测试容器..."
    docker run -d --name assetos-test -p 8081:80 "$IMAGE_NAME:$VERSION"
    
    # 等待容器启动
    sleep 10
    
    # 健康检查
    if curl -f http://localhost:8081/ &> /dev/null; then
        log_success "镜像测试通过"
    else
        log_error "镜像测试失败"
        docker logs assetos-test
        docker stop assetos-test
        docker rm assetos-test
        exit 1
    fi
    
    # 清理测试容器
    docker stop assetos-test
    docker rm assetos-test
    
    log_success "测试完成"
}

# 登录Docker Hub
docker_login() {
    log_info "登录Docker Hub..."
    
    if [[ -z "$DOCKER_USERNAME" ]] || [[ -z "$DOCKER_PASSWORD" ]]; then
        log_warning "请设置环境变量或手动登录:"
        log_info "export DOCKER_USERNAME=your_username"
        log_info "export DOCKER_PASSWORD=your_password"
        log_info "或者运行: docker login"
        
        read -p "是否现在手动登录? (y/n): " -r
        if [[ $REPLY =~ ^[Yy]$ ]]; then
            docker login
        else
            log_error "需要登录才能推送镜像"
            exit 1
        fi
    else
        echo "$DOCKER_PASSWORD" | docker login -u "$DOCKER_USERNAME" --password-stdin
    fi
    
    log_success "Docker Hub 登录成功"
}

# 推送镜像到Docker Hub
push_image() {
    log_info "推送镜像到Docker Hub..."
    
    # 推送版本标签
    log_info "推送 $IMAGE_NAME:$VERSION"
    docker push "$IMAGE_NAME:$VERSION"
    
    # 推送latest标签
    log_info "推送 $IMAGE_NAME:$LATEST_TAG"
    docker push "$IMAGE_NAME:$LATEST_TAG"
    
    log_success "镜像推送完成"
}

# 生成使用说明
generate_usage() {
    log_info "生成使用说明..."
    
    cat > docker-usage.md << EOF
# AssetOS Docker 镜像使用说明

## 快速开始

### 方式一: Docker Run
\`\`\`bash
# 创建数据目录
mkdir -p assetOS/data

# 运行容器
docker run -d \\
  --name assetOS \\
  -p 8080:80 \\
  -v \$(pwd)/assetOS/data:/var/www/html/db \\
  --restart unless-stopped \\
  $IMAGE_NAME:$VERSION
\`\`\`

### 方式二: Docker Compose
创建 \`docker-compose.yml\`:

\`\`\`yaml
version: '3.8'

services:
  assetos:
    image: $IMAGE_NAME:$VERSION
    container_name: assetOS
    ports:
      - "8080:80"
    volumes:
      - ./data:/var/www/html/db
    restart: unless-stopped
    healthcheck:
      test: ["CMD", "curl", "-f", "http://localhost/"]
      interval: 30s
      timeout: 10s
      retries: 3
\`\`\`

然后运行:
\`\`\`bash
docker-compose up -d
\`\`\`

## 访问应用

打开浏览器访问: http://localhost:8080

## 数据持久化

确保将 \`/var/www/html/db\` 目录挂载到主机，以保存数据。

## 镜像信息

- **镜像名称**: $IMAGE_NAME
- **版本**: $VERSION
- **大小**: $(docker images $IMAGE_NAME:$VERSION --format "{{.Size}}" 2>/dev/null || echo "未知")
- **创建时间**: $(date)

## 支持

- GitHub: https://github.com/DsTansice/AssetOS
- Issues: https://github.com/DsTansice/AssetOS/issues
- Telegram: https://t.me/AssetOSOffical
EOF

    log_success "使用说明已生成: docker-usage.md"
}

# 显示镜像信息
show_image_info() {
    log_info "镜像信息:"
    echo "----------------------------------------"
    docker images "$IMAGE_NAME" --format "table {{.Repository}}\t{{.Tag}}\t{{.Size}}\t{{.CreatedAt}}"
    echo "----------------------------------------"
    
    log_info "推送的镜像:"
    echo "  docker pull $IMAGE_NAME:$VERSION"
    echo "  docker pull $IMAGE_NAME:$LATEST_TAG"
}

# 主函数
main() {
    log_info "开始 AssetOS Docker 构建和发布流程..."
    
    # 检查环境
    check_docker
    check_docker_running
    
    # 询问用户操作
    echo ""
    echo "请选择操作:"
    echo "1) 仅构建镜像"
    echo "2) 构建并测试"
    echo "3) 构建、测试并推送到Docker Hub"
    echo "4) 清理并重新构建"
    read -p "请输入选择 (1-4): " -r choice
    
    case $choice in
        1)
            build_image
            show_image_info
            ;;
        2)
            build_image
            test_image
            show_image_info
            ;;
        3)
            build_image
            test_image
            docker_login
            push_image
            generate_usage
            show_image_info
            ;;
        4)
            cleanup
            build_image
            test_image
            show_image_info
            ;;
        *)
            log_error "无效选择"
            exit 1
            ;;
    esac
    
    log_success "所有操作完成！"
}

# 运行主函数
main "$@"
