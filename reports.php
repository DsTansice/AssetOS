<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'zh-CN';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($language); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>统计报告 - AssetOS</title>
  <link rel="icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center pt-8 pb-12">
  <div class="w-full max-w-4xl mx-auto">
    <header class="mb-8 text-center">
      <h1 class="text-3xl font-bold text-gray-900">统计报告</h1>
      <p class="text-gray-600 mt-2">查看资产统计和成本分析</p>
    </header>

    <!-- 导航栏 -->
    <div class="navbar p-6 mb-6 rounded-lg shadow-sm bg-white">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
        <!-- 左侧标题 -->
        <div class="mb-4 lg:mb-0 flex items-center">
          <img src="asset/logo.png" alt="AssetOS Logo" class="mr-3 rounded" style="width: 64px; height: 64px;">
          <div>
            <h1 class="text-3xl font-bold page-title">统计报告</h1>
            <p class="text-gray-600 mt-2">查看资产统计和成本分析</p>
          </div>
        </div>
        
        <!-- 右侧导航 -->
        <div class="flex items-center gap-4">
          <!-- 语言切换 -->
          <button id="languageToggle" class="nav-btn bg-blue-100 text-blue-700 hover:bg-blue-200">English</button>
          
          <!-- 赞助按钮 -->
          <a href="sponsor.php" class="nav-btn bg-purple-500 hover:bg-purple-600">赞助</a>
          
          <!-- 用户下拉菜单 -->
          <div class="user-dropdown">
            <button class="user-button">
              <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
              <?php if ($_SESSION['is_admin']): ?>
              <span class="px-1.5 py-0.5 bg-red-100 text-red-800 text-xs rounded-full">管理员</span>
              <?php endif; ?>
            </button>
            <div class="user-dropdown-content">
              <a href="index.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                查看物品
              </a>
              <a href="menu.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                返回菜单
              </a>
              <?php if ($_SESSION['is_admin']): ?>
              <a href="admin.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                管理员面板
              </a>
              <?php endif; ?>
              <a href="settings.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                个人设置
              </a>
              <div class="user-dropdown-divider"></div>
              <button onclick="logout()" class="user-dropdown-item danger">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                退出登录
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 加载动画 -->
    <div class="spinner"></div>

    <!-- 统计概览 -->
    <div id="statsContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
      <!-- 动态生成统计卡片 -->
    </div>

    <!-- 详细统计图表 -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- 分类统计 -->
      <div class="card">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">分类统计</h2>
        <div id="categoryStats" class="space-y-2">
          <!-- 动态生成分类统计 -->
        </div>
      </div>

      <!-- 状态统计 -->
      <div class="card">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">状态统计</h2>
        <div id="statusStats" class="space-y-2">
          <!-- 动态生成状态统计 -->
        </div>
      </div>

      <!-- 月度支出 -->
      <div class="card">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">月度支出</h2>
        <div id="monthlyExpenses" class="space-y-2">
          <!-- 动态生成月度支出 -->
        </div>
      </div>
    </div>

    <!-- 项目信息 -->
    <?php include 'includes/footer.php'; ?>
  </div>
  
  <script src="js/script.js"></script>
  <script src="js/user-dropdown.js"></script>
  <script src="js/theme-simple.js"></script>
  <script src="js/button-text-enhancer.js"></script>
  
  <script>
    // 页面加载时获取统计数据
    document.addEventListener('DOMContentLoaded', function() {
      fetchStatistics();
    });

    // 获取统计数据
    async function fetchStatistics() {
      try {
        const response = await fetch('api/api.php?action=statistics');
        const data = await response.json();
        
        if (data.success) {
          updateStatsDisplay(data.stats);
        } else {
          console.error('获取统计数据失败:', data.message);
        }
      } catch (error) {
        console.error('获取统计数据错误:', error);
      }
    }

    // 更新统计显示
    function updateStatsDisplay(stats) {
      // 更新概览统计
      document.getElementById('statsContainer').innerHTML = `
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-lg font-semibold text-gray-900 mb-2">物品总数</h3>
          <p class="text-3xl font-bold text-blue-600">${stats.totalItems || 0}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-lg font-semibold text-gray-900 mb-2">总投入</h3>
          <p class="text-3xl font-bold text-green-600">¥${(stats.totalValue || 0).toFixed(2)}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-lg font-semibold text-gray-900 mb-2">日均成本</h3>
          <p class="text-3xl font-bold text-purple-600">¥${(stats.avgDailyCost || 0).toFixed(2)}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-sm">
          <h3 class="text-lg font-semibold text-gray-900 mb-2">在用物品</h3>
          <p class="text-3xl font-bold text-orange-600">${stats.inUseItems || 0}</p>
        </div>
      `;

      // 更新分类统计
      const categoryHTML = Object.entries(stats.categoryStats || {})
        .map(([category, count]) => `
          <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
            <span class="font-medium">${category}</span>
            <span class="text-blue-600 font-bold">${count}</span>
          </div>
        `).join('');
      document.getElementById('categoryStats').innerHTML = categoryHTML;

      // 更新状态统计
      const statusHTML = Object.entries(stats.statusStats || {})
        .map(([status, count]) => {
          const statusNames = {
            'in_use': '在用',
            'idle': '闲置',
            'broken': '损坏',
            'sold': '已售出',
            'discarded': '已丢弃',
            'transferred': '已转手',
            'damaged': '已损坏'
          };
          return `
            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
              <span class="font-medium">${statusNames[status] || status}</span>
              <span class="text-green-600 font-bold">${count}</span>
            </div>
          `;
        }).join('');
      document.getElementById('statusStats').innerHTML = statusHTML;

      // 更新月度支出
      const monthlyHTML = Object.entries(stats.monthlyExpenses || {})
        .map(([month, amount]) => `
          <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
            <span class="font-medium">${month}</span>
            <span class="text-purple-600 font-bold">¥${amount.toFixed(2)}</span>
          </div>
        `).join('');
      document.getElementById('monthlyExpenses').innerHTML = monthlyHTML;
    }
  </script>
</body>
</html>
