#!/bin/bash

# AssetOS 快速发布脚本
# 适用于有Docker环境的本地快速发布

set -e

# 配置
IMAGE_NAME="dstansice/assetos"
VERSION=${1:-"latest"}

echo "🚀 AssetOS Docker 快速发布"
echo "镜像名称: $IMAGE_NAME:$VERSION"
echo ""

# 检查Docker
if ! command -v docker &> /dev/null; then
    echo "❌ Docker 未安装"
    exit 1
fi

if ! docker info &> /dev/null; then
    echo "❌ Docker 服务未运行"
    exit 1
fi

echo "✅ Docker 环境检查通过"

# 构建镜像
echo "📦 构建镜像..."
docker build -t "$IMAGE_NAME:$VERSION" .
echo "✅ 镜像构建完成"

# 测试镜像
echo "🧪 测试镜像..."
docker run -d --name assetos-test -p 8081:80 "$IMAGE_NAME:$VERSION"
sleep 10

if curl -f http://localhost:8081/ &> /dev/null; then
    echo "✅ 镜像测试通过"
else
    echo "❌ 镜像测试失败"
    docker logs assetos-test
    docker stop assetos-test 2>/dev/null || true
    docker rm assetos-test 2>/dev/null || true
    exit 1
fi

# 清理测试容器
docker stop assetos-test
docker rm assetos-test
echo "🧹 测试环境清理完成"

# 推送镜像（可选）
read -p "是否推送到Docker Hub? (y/N): " -r
if [[ $REPLY =~ ^[Yy]$ ]]; then
    echo "🔐 登录Docker Hub..."
    docker login
    
    echo "📤 推送镜像..."
    docker push "$IMAGE_NAME:$VERSION"
    
    if [[ "$VERSION" != "latest" ]]; then
        docker tag "$IMAGE_NAME:$VERSION" "$IMAGE_NAME:latest"
        docker push "$IMAGE_NAME:latest"
    fi
    
    echo "✅ 镜像推送完成"
    echo ""
    echo "🎉 发布成功！"
    echo "使用方法:"
    echo "  docker run -d --name assetOS -p 8080:80 -v \$(pwd)/data:/var/www/html/db $IMAGE_NAME:$VERSION"
else
    echo "⏩ 跳过推送，仅本地构建"
    echo ""
    echo "🎉 本地构建完成！"
    echo "本地使用:"
    echo "  docker run -d --name assetOS -p 8080:80 -v \$(pwd)/data:/var/www/html/db $IMAGE_NAME:$VERSION"
fi

echo ""
echo "📊 镜像信息:"
docker images "$IMAGE_NAME" --format "table {{.Repository}}\t{{.Tag}}\t{{.Size}}\t{{.CreatedAt}}"
