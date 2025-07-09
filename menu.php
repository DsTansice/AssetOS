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
  <title data-i18n="menu_page_title">菜单 - AssetOS</title>
  <link rel="icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center pt-8 pb-12">
  <div class="w-full max-w-6xl mx-auto">
    <!-- 导航栏 -->
    <div class="navbar p-6 mb-6 rounded-lg shadow-sm bg-white">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
        <!-- 左侧标题 -->
        <div class="mb-4 lg:mb-0 flex items-center">
          <img src="asset/logo.png" alt="AssetOS Logo" class="mr-3 rounded" style="width: 64px; height: 64px;">
          <div>
            <h1 class="text-3xl font-bold page-title" data-i18n="menu_title">AssetOS 菜单</h1>
            <p class="text-gray-600 mt-2" data-i18n="menu_subtitle">选择您要使用的功能</p>
          </div>
        </div>
        
        <!-- 右侧导航 -->
        <div class="flex items-center gap-4">
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
              <a href="index.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span data-i18n="view_items">查看物品</span>
              </a>
              <a href="manage.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                <span data-i18n="manage_items">管理物品</span>
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

    <!-- 功能菜单 -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      
      <!-- 物品展示 -->
      <div class="card hover:shadow-lg transition-shadow">
        <div class="text-center">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2" data-i18n="view_items">物品列表</h3>
          <p class="text-gray-600 text-sm mb-4" data-i18n="view_items_desc">查看和管理您的所有物品</p>
          <a href="index.php" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition inline-block" data-i18n="enter">进入</a>
        </div>
      </div>

      <!-- 物品管理 -->
      <div class="card hover:shadow-lg transition-shadow">
        <div class="text-center">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2" data-i18n="manage_items">物品管理</h3>
          <p class="text-gray-600 text-sm mb-4" data-i18n="manage_items_desc">添加新物品，导入/导出CSV</p>
          <a href="manage.php" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition inline-block" data-i18n="enter">进入</a>
        </div>
      </div>

      <!-- 统计报告 -->
      <div class="card hover:shadow-lg transition-shadow">
        <div class="text-center">
          <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2" data-i18n="view_reports">统计报告</h3>
          <p class="text-gray-600 text-sm mb-4" data-i18n="view_reports_desc">查看资产统计和成本分析</p>
          <a href="reports.php" class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition inline-block" data-i18n="enter">进入</a>
        </div>
      </div>

      <!-- 赞助 -->
      <div class="card hover:shadow-lg transition-shadow">
        <div class="text-center">
          <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2" data-i18n="sponsor_support">赞助支持</h3>
          <p class="text-gray-600 text-sm mb-4" data-i18n="sponsor_support_desc">支持项目发展</p>
          <a href="sponsor.php" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition inline-block" data-i18n="enter">进入</a>
        </div>
      </div>

      <!-- 管理员功能 -->
      <?php if ($_SESSION['is_admin']): ?>
      <div class="card hover:shadow-lg transition-shadow">
        <div class="text-center">
          <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2" data-i18n="admin_panel">管理员面板</h3>
          <p class="text-gray-600 text-sm mb-4" data-i18n="admin_panel_desc">用户管理、系统设置</p>
          <a href="admin.php" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition inline-block" data-i18n="enter">进入</a>
        </div>
      </div>
      <?php endif; ?>

      <!-- 个人设置 -->
      <div class="card hover:shadow-lg transition-shadow">
        <div class="text-center">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
          </div>
          <h3 class="text-lg font-semibold text-gray-900 mb-2" data-i18n="settings_title">个人设置</h3>
          <p class="text-gray-600 text-sm mb-4" data-i18n="personal_settings_desc">账户设置、密码修改</p>
          <a href="settings.php" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition inline-block" data-i18n="enter">进入</a>
        </div>
      </div>
    </div>

    <?php include 'includes/footer.php'; ?>
  </div>
  <script src="js/theme-simple.js"></script>
  <script src="js/script.js"></script>
  <script src="js/user-dropdown.js"></script>
  <script src="js/button-text-enhancer.js"></script>
</body>
</html>
