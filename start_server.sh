#!/bin/bash

# 启动PHP服务器
echo "正在启动PHP服务器..."
php -S localhost:8000 &
SERVER_PID=$!

# 等待服务器启动
sleep 2

echo "PHP服务器已启动 (PID: $SERVER_PID)"
echo "请访问 http://localhost:8000 来测试应用程序"
echo "测试完成后按 Ctrl+C 停止服务器"

# 等待用户按键
read -p "按任意键停止服务器..."

# 停止服务器
kill $SERVER_PID
echo "服务器已停止"
