# AssetOS Multi-stage Dockerfile
# Stage 1: 构建阶段
FROM php:8.2-apache as builder

# 设置工作目录
WORKDIR /var/www/html

# 安装系统依赖
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    curl \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# 安装 PHP 扩展
RUN docker-php-ext-install pdo pdo_sqlite

# 复制项目文件
COPY . /var/www/html/

# 清理不需要的文件
RUN rm -rf \
    .git \
    .github \
    .gitignore \
    .dockerignore \
    *.md \
    tests/ \
    docs/ \
    build-and-push.sh \
    quick-release.sh

# Stage 2: 生产阶段
FROM php:8.2-apache as production

# 设置标签
LABEL maintainer="DsTansice <admin@010085.xyz>"
LABEL description="AssetOS - Open Source Asset Holding Cost Tracking System"
LABEL version="1.6.0"

# 安装系统依赖
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    curl \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

# 安装 PHP 扩展
RUN docker-php-ext-install pdo pdo_sqlite

# 启用 Apache 模块
RUN a2enmod rewrite headers

# 从构建阶段复制文件
COPY --from=builder /var/www/html /var/www/html

# 创建必要目录
RUN mkdir -p /var/www/html/db \
    && mkdir -p /var/www/html/backups

# 设置权限
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 775 /var/www/html/db \
    && chmod -R 775 /var/www/html/backups

# 配置 Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    ServerName localhost\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
        DirectoryIndex index.php\n\
    </Directory>\n\
    <Directory /var/www/html/db>\n\
        Require all denied\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# 配置 PHP
RUN echo 'expose_php = Off\n\
upload_max_filesize = 10M\n\
post_max_size = 10M\n\
memory_limit = 256M\n\
date.timezone = Asia/Shanghai' > /usr/local/etc/php/conf.d/assetos.ini

# 添加健康检查脚本
RUN echo '#!/bin/bash\n\
curl -f http://localhost/ >/dev/null 2>&1 || exit 1' > /usr/local/bin/healthcheck \
    && chmod +x /usr/local/bin/healthcheck

# 创建启动脚本
RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# 确保目录权限正确\n\
chown -R www-data:www-data /var/www/html/db\n\
chmod -R 775 /var/www/html/db\n\
\n\
# 如果数据库不存在，创建空文件\n\
if [ ! -f /var/www/html/db/database.sqlite ]; then\n\
    touch /var/www/html/db/database.sqlite\n\
    chown www-data:www-data /var/www/html/db/database.sqlite\n\
    chmod 664 /var/www/html/db/database.sqlite\n\
fi\n\
\n\
# 启动 Apache\n\
exec apache2-foreground' > /usr/local/bin/docker-entrypoint.sh \
    && chmod +x /usr/local/bin/docker-entrypoint.sh

# 暴露端口
EXPOSE 80

# 设置健康检查
HEALTHCHECK --interval=30s --timeout=10s --start-period=5s --retries=3 \
    CMD /usr/local/bin/healthcheck

# 设置工作目录
WORKDIR /var/www/html

# 切换到非特权用户（在启动脚本中处理权限）
USER www-data

# 启动应用
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
