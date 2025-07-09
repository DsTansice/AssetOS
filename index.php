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
  <title data-i18n="title">物品持有成本追踪 - AssetOS</title>
  <link rel="icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center pt-8 pb-12">
  <div class="w-full max-w-6xl mx-auto">
    <!-- 导航栏 -->
    <div class="navbar p-6 mb-6 rounded-lg shadow-sm bg-white">
      <div class="flex flex-col lg:flex-row justify-between items-center">
        <!-- 左侧标题 -->
        <div class="flex items-center mb-4 lg:mb-0">
          <img src="asset/logo.png" alt="AssetOS Logo" class="mr-3 rounded" style="width: 64px; height: 64px;">
          <div class="flex flex-col">
            <h1 class="text-3xl font-bold page-title leading-tight" data-i18n="title">物品持有成本追踪</h1>
            <p class="text-gray-600 text-sm mt-1" data-i18n="subtitle">查看和管理您的资产</p>
          </div>
        </div>
        
        <!-- 右侧导航 -->
        <div class="flex items-center gap-4 flex-shrink-0">
          <!-- 暗模式切换 -->
          <button class="theme-toggle" title="切换主题模式" aria-label="切换主题模式">
            <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
          </button>
          
          <!-- 语言切换 -->
          <button id="languageToggle" class="nav-btn bg-blue-100 text-blue-700 hover:bg-blue-200" data-i18n="language_toggle">English</button>
          
          <!-- 赞助按钮 -->
          <a href="sponsor.php" class="nav-btn bg-purple-500 hover:bg-purple-600" data-i18n="sponsor">赞助</a>
          
          <!-- 用户下拉菜单 -->
          <div class="user-dropdown">
            <button class="user-button">
              <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
              <?php if ($_SESSION['is_admin']): ?>
              <span class="px-1.5 py-0.5 bg-red-100 text-red-800 text-xs rounded-full" data-i18n="admin_status">管理员</span>
              <?php endif; ?>
            </button>
            <div class="user-dropdown-content">
              <a href="menu.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                <span data-i18n="back_to_menu">返回菜单</span>
              </a>
              <a href="manage.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <span data-i18n="manage_items">管理物品</span>
              </a>
              <a href="reports.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                <span data-i18n="view_reports">统计报告</span>
              </a>
              <?php if ($_SESSION['is_admin']): ?>
              <a href="admin.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span data-i18n="admin_panel">管理员面板</span>
              </a>
              <?php endif; ?>
              <a href="settings.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span data-i18n="settings_title">个人设置</span>
              </a>
              <div class="user-dropdown-divider"></div>
              <button onclick="logout()" class="user-dropdown-item danger">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                <span data-i18n="logout">退出登录</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- 加载动画 -->
    <div class="spinner"></div>

    <!-- 物品管理界面 -->
    <div id="itemManager" class="card">
      <!-- 统计信息 -->
      <div id="statsContainer" class="mb-6"></div>

      <!-- 过滤和排序 -->
      <div class="mb-6 flex flex-col md:flex-row gap-4">
        <div class="flex-1">
          <label for="filterCategory" class="form-label" data-i18n="filter_category">过滤分类</label>
          <select id="filterCategory" onchange="fetchItems()" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2">
            <option value="all" data-i18n="filter_category_all">所有分类</option>
            <!-- 动态加载分类 -->
          </select>
        </div>
        <div class="flex-1">
          <label for="filterStatus" class="form-label" data-i18n="filter_status">过滤状态</label>
          <select id="filterStatus" onchange="fetchItems()" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2">
            <option value="all" data-i18n="filter_status_all">所有状态</option>
            <option value="in_use" data-i18n="status_in_use">在用</option>
            <option value="discarded" data-i18n="status_discarded">已丢弃</option>
            <option value="transferred" data-i18n="status_transferred">已转手</option>
            <option value="damaged" data-i18n="status_damaged">已损坏</option>
          </select>
        </div>
        <div class="flex-1">
          <label for="sortBy" class="form-label" data-i18n="sort_by">排序方式</label>
          <select id="sortBy" onchange="fetchItems()" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2">
            <option value="name" data-i18n="sort_name">按名称排序</option>
            <option value="date" data-i18n="sort_date">按购买日期排序</option>
            <option value="price" data-i18n="sort_price">按购买价格排序</option>
            <option value="dailyCost" data-i18n="sort_daily_cost">按每日成本排序</option>
          </select>
        </div>
      </div>

      <!-- 物品列表 -->
      <div id="itemList" class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- 动态生成物品 -->
      </div>
    </div>

    <!-- 项目信息 -->
    <?php include 'includes/footer.php'; ?>
  </div>

  <!-- 自定义弹窗 -->
  <div id="custom-alert" class="custom-alert hidden">
    <div class="custom-alert-content">
      <button id="alert-close-btn" class="alert-close-btn">&times;</button>
      <div id="alert-icon" class="alert-icon mb-3">
        <!-- 不同类型的图标会通过 JS 动态添加 -->
      </div>
      <div id="alert-message" class="mb-3"></div>
      <div id="alert-buttons" class="flex justify-center gap-3">
        <!-- 如果需要按钮，将在 JS 中动态添加 -->
      </div>
    </div>
  </div>

  <script src="js/theme-simple.js"></script>
  <script src="js/script.js"></script>
  <script src="js/user-dropdown.js"></script>
  <script src="js/button-text-enhancer.js"></script>
</body>
</html>