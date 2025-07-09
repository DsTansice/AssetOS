<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Lo              <a href="settings.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span data-i18n="settings_title">个人设置</span>
              </a>on: login.php');
    exit;
}
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'zh-CN';
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($language); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="manage_page_title">物品管理 - AssetOS</title>
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
            <h1 class="text-3xl font-bold page-title" data-i18n="manage_title">物品管理</h1>
            <p class="text-gray-600 mt-2" data-i18n="manage_subtitle">添加新物品、导入导出数据</p>
          </div>
        </div>
        
        <!-- 右侧导航 -->
        <div class="flex items-center gap-4">
          <!-- 主题切换按钮 -->
          <button id="themeToggle" class="nav-btn bg-gray-100 text-gray-700 hover:bg-gray-200" title="切换主题">
            <svg id="sunIcon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
            <svg id="moonIcon" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
              <a href="index.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span data-i18n="view_items">查看物品</span>
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

    <!-- 添加物品表单 -->
    <div class="card mb-8 fade-in">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="add_item">添加物品</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label for="itemName" class="form-label" data-i18n="item_name">物品名称</label>
          <input id="itemName" type="text" placeholder="请输入物品名称" class="input-field" data-i18n-placeholder="item_name_placeholder">
        </div>
        
        <div>
          <label for="category" class="form-label" data-i18n="category">分类</label>
          <select id="category" class="input-field">
            <!-- 动态加载分类 -->
          </select>
        </div>
        
        <div>
          <label for="purchaseDate" class="form-label" data-i18n="purchase_date">购买日期</label>
          <input id="purchaseDate" type="date" class="input-field">
        </div>
        
        <div>
          <label for="purchasePrice" class="form-label" data-i18n="purchase_price">购买价格</label>
          <input id="purchasePrice" type="number" step="0.01" placeholder="请输入价格" class="input-field" data-i18n-placeholder="purchase_price_placeholder">
        </div>
        
        <div>
          <label for="statusDate" class="form-label" data-i18n="status_date">状态日期</label>
          <input id="statusDate" type="date" placeholder="状态变更日期" class="input-field" data-i18n-placeholder="status_date_placeholder">
        </div>
        
        <div>
          <label for="itemStatus" class="form-label" data-i18n="status">状态</label>
          <select id="itemStatus" class="input-field">
            <option value="in_use" data-i18n="status_in_use">在用</option>
            <option value="discarded" data-i18n="status_discarded">已丢弃</option>
            <option value="transferred" data-i18n="status_transferred">已转手</option>
            <option value="damaged" data-i18n="status_damaged">已损坏</option>
          </select>
        </div>
        
        <div>
          <label for="currency" class="form-label" data-i18n="currency">货币</label>
          <select id="currency" class="input-field">
            <option value="CNY">CNY (￥)</option>
            <option value="USD">USD ($)</option>
            <option value="EUR">EUR (€)</option>
          </select>
        </div>
        
        <div id="transferPriceContainer" class="hidden">
          <label for="transferPrice" class="form-label" data-i18n="transfer_price">转手价格</label>
          <input id="transferPrice" type="number" step="0.01" placeholder="请输入转手价格" class="input-field" data-i18n-placeholder="transfer_price_placeholder">
        </div>
        
        <!-- 备注 -->
        <div class="md:col-span-2">
          <label for="itemNotes" class="form-label" data-i18n="notes">备注信息</label>
          <textarea id="itemNotes" placeholder="添加关于该物品的备注信息（可选）" class="input-field h-24 focus:ring-2 focus:ring-blue-300" data-i18n-placeholder="item_notes_placeholder"></textarea>
          <p class="text-xs text-gray-500 mt-1" data-i18n="notes_help">您可以在此添加任何关于物品的额外信息，如使用体验、保修信息等</p>
        </div>
        
        <div class="md:col-span-2 mt-6 flex justify-center">
          <button onclick="addItem()" class="w-1/2 bg-blue-500 text-white px-4 py-3 rounded-md hover:bg-blue-600 transition text-center text-lg font-medium" data-i18n="add_item_button">
            添加物品
          </button>
        </div>
      </div>
    </div>

    <!-- CSV 导入 -->
    <div class="card mb-6 fade-in">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="import_csv">导入 CSV</h2>
      <div class="grid grid-cols-1 gap-4">
        <input id="csvFile" type="file" accept=".csv" class="input-field">
        <button onclick="importCSV()" class="w-full bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition" data-i18n="import_csv_button">导入 CSV</button>
        <div class="bg-blue-50 border border-blue-200 rounded-md p-3">
          <h4 class="text-sm font-medium text-blue-800 mb-2" data-i18n="csv_format_title">CSV 格式说明</h4>
          <p class="text-sm text-blue-600">name,category,date,price,currency,status,status_date,transfer_price,notes</p>
          <p class="text-sm text-blue-600 mt-1" data-i18n="csv_example">示例：手机,电子产品,2023-10-01,1000,CNY,in_use,,,备注内容</p>
        </div>
      </div>
    </div>

    <!-- CSV 导出 -->
    <div class="card mb-6 fade-in">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="export_csv">导出 CSV</h2>
      <div class="grid grid-cols-1 gap-4">
        <p class="text-gray-600" data-i18n="export_description">导出所有物品数据为 CSV 文件，可用于备份或在其他程序中使用。</p>
        <button onclick="exportToCSV()" class="w-full bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition" data-i18n="export_csv_button">导出 CSV</button>
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
  
  <script src="js/script.js"></script>
  <script src="js/user-dropdown.js"></script>
  <script src="js/theme-simple.js"></script>
  <script src="js/button-text-enhancer.js"></script>
</body>
</html>
