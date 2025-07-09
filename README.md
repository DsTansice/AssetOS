# AssetOS - 物品持有成本追踪系统

AssetOS 是一个简单易用的 Web 应用程序，用于追踪和管理个人或组织的物品持有成本。用户可以记录物品的购买信息（名称、分类、日期、价格、货币），计算持有天数和每日成本，支持 CSV 导入/导出、分类管理、用户注册/登录、邮箱验证以及管理员功能（如用户管理、数据备份、Webhook 设置）。

本项目由 [DsTansice](https://github.com/DsTansice) 开发，灵感来源于 [Wallos](https://github.com/ellite/Wallos)，旨在提供轻量级的资产管理解决方案。[](https://github.com/dstansice)[](https://github.com/DumbWareio/DumbAssets)

## 功能
- **物品管理**：添加、删除、过滤、排序物品，计算每日持有成本。
- **用户系统**：
  - 注册：支持用户名、邮箱、密码，第一个注册用户自动为管理员。
  - 登录：支持用户名或邮箱登录，需邮箱验证。
  - 管理员面板：管理用户（设为/取消管理员、删除）、自定义分类、数据备份、Webhook 设置。
- **数据导入/导出**：支持 CSV 格式导入/导出物品数据。
- **Webhook 通知**：支持物品添加和用户注册事件的 Webhook 通知。
- **多货币支持**：支持 CNY、USD、EUR 等货币。

## 安装
1. **克隆仓库**：
   ```bash
   git clone https://github.com/DsTansice/AssetOS.git
   cd AssetOS
   ```
2. **安装依赖**：
   - 确保 PHP 8.2 已安装，启用 `pdo_sqlite` 和 `curl` 扩展。
   - 安装 PHPMailer：
     ```bash
     composer install
     ```
     或手动将 PHPMailer 的 `src` 目录放入 `lib/PHPMailer/`。
3. **配置 SMTP**：
   - 编辑 `api/api.php`，更新 `sendVerificationEmail` 函数中的 SMTP 设置（`Host`、`Username`、`Password`）。
   - 示例（Gmail）：
     ```php
     $mail->Host = 'smtp.gmail.com';
     $mail->Username = 'your-email@gmail.com';
     $mail->Password = 'your-app-password';
     ```
4. **设置文件权限**：
   ```bash
   chmod -R 775 db
   chown -R www-data:www-data db  # 对于 Apache/Nginx
   ```
5. **运行服务器**：
   ```bash
   php -S localhost:8000
   ```
   或使用 Apache/Nginx 部署。

## 使用
1. **注册**：访问 `http://localhost:8000/register.php`，输入用户名、邮箱、密码，检查邮箱验证链接。
2. **登录**：在 `http://localhost:8000/login.php` 使用用户名或邮箱登录。
3. **物品管理**：在 `http://localhost:8000/index.php` 添加、删除、导入/导出物品。
4. **管理员功能**：在 `http://localhost:8000/admin.php` 管理用户、分类、备份数据、设置 Webhook。

## Docker 部署
```bash
docker build -t assetos .
docker run -d -p 8000:80 --name assetos-container assetos
```

## 开发
- **技术栈**：PHP 8.2、SQLite、JavaScript、Tailwind CSS（提取为静态 CSS）、PHPMailer。
- **目录结构**：
  ```
  AssetOS/
  ├── api/              # API 端点
  ├── css/              # 样式文件
  ├── db/               # SQLite 数据库
  ├── js/               # JavaScript 文件
  ├── lib/              # 第三方库（如 PHPMailer）
  ├── .gitignore
  ├── composer.json
  ├── Dockerfile
  ├── LICENSE
  ├── README.md
  ├── admin.php         # 管理员面板
  ├── index.php         # 主页面
  ├── login.php         # 登录页面
  ├── register.php      # 注册页面
  ```
- **贡献**：欢迎提交 Issue 或 Pull Request 到 [AssetOS](https://github.com/DsTansice/AssetOS)。

## 许可证
MIT License，详见 [LICENSE](LICENSE) 文件。

## 联系
- GitHub: [DsTansice](https://github.com/DsTansice)
- 问题反馈：请在 GitHub 提交 Issue。
