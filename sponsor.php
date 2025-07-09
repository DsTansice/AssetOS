<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$language = isset($_SESSION['language']) ? $_SESSION['language'] : 'zh-CN';
require_once 'includes/url_encoder.php';
$encoded_links = getEncodedProjectLinks();
?>
<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($language); ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="sponsor_title">赞助项目 - AssetOS</title>
  <link rel="icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center pt-8 pb-12">
  <div class="w-full max-w-md mx-auto">
    <header class="mb-8 text-center">
      <h1 class="text-3xl font-bold text-gray-900" data-i18n="sponsor_title">赞助 AssetOS</h1>
      <p class="text-gray-600 mt-2" data-i18n="sponsor_subtitle">支持我们的项目，保持持续开发</p>
    </header>

    <!-- 导航栏 -->
    <div class="navbar p-6 mb-6 rounded-lg shadow-sm bg-white">
      <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center">
        <!-- 左侧标题 -->
        <div class="mb-4 lg:mb-0 flex items-center">
          <img src="asset/logo.png" alt="AssetOS Logo" class="mr-3 rounded" style="width: 64px; height: 64px;">
          <div>
            <h1 class="text-3xl font-bold page-title" data-i18n="sponsor_title">赞助 AssetOS</h1>
            <p class="text-gray-600 mt-2" data-i18n="sponsor_subtitle">支持我们的项目，保持持续开发</p>
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
              <a href="manage.php" class="user-dropdown-item">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                管理物品
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

    <!-- 赞助卡片 -->
    <div class="card">
      <h2 class="text-xl font-semibold text-gray-900 mb-4" data-i18n="sponsor_wechat">通过微信赞助</h2>
      <p class="text-gray-600 mb-4" data-i18n="sponsor_instructions">扫描下方二维码，通过微信支持我们的项目。您的支持将帮助我们改进 AssetOS！</p>
      
      <div class="text-center">
        <img id="sponsorQrCode" class="w-full max-w-xs mx-auto rounded-md shadow-sm" data-encoded-url="aHR0cHM6Ly93d3cuMDEwMDg1Lnh5ei9waWMvd2VjaGF0LmpwZw==" alt="WeChat QR Code">
        
        <!-- 备用联系信息，当图片加载失败时显示 -->
        <div id="sponsorFallback" class="hidden mt-4 p-4 bg-blue-50 rounded-lg">
          <h3 class="text-lg font-medium text-blue-900 mb-2">其他赞助方式</h3>
          <p class="text-blue-700 text-sm mb-2">如果二维码无法显示，您也可以通过以下方式支持我们：</p>
          <ul class="text-blue-600 text-sm space-y-1">
            <li>• 在 GitHub 上为项目加星</li>
            <li>• 分享项目给更多人</li>
            <li>• 提交功能建议或错误报告</li>
            <li>• 参与项目开发</li>
          </ul>
        </div>
      </div>
      
      <p class="text-sm text-gray-500 mt-4 text-center" data-i18n="sponsor_thank_you">感谢您的慷慨支持！</p>
    </div>

    <!-- 项目信息 -->
    <div class="mt-8 text-center">
      <div class="bg-white rounded-lg shadow-sm p-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-2">AssetOS</h3>
        <p class="text-gray-600 text-sm mb-3">开源物品持有成本追踪系统</p>
        <div class="flex justify-center space-x-4">
          <a href="#" onclick="openLink('<?php echo $encoded_links['github_main']; ?>')" class="flex items-center text-gray-700 hover:text-blue-500 transition cursor-pointer">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
            </svg>
            GitHub
          </a>
          <a href="#" onclick="openLink('<?php echo $encoded_links['github_issues']; ?>')" class="text-gray-700 hover:text-blue-500 transition cursor-pointer">反馈</a>
          <a href="#" onclick="openLink('<?php echo $encoded_links['github_readme']; ?>')" class="text-gray-700 hover:text-blue-500 transition cursor-pointer">文档</a>
        </div>
        <p class="text-gray-500 text-xs mt-2">您的赞助将帮助我们持续改进 AssetOS</p>
      </div>
    </div>
  </div>
  
  <?php include 'includes/footer.php'; ?>
  
  <script src="js/script.js"></script>
  <script src="js/user-dropdown.js"></script>
  <script src="js/url-handler.js"></script>
  <script src="js/theme-simple.js"></script>
  <script src="js/image-decoder.js"></script>
  <script src="js/button-text-enhancer.js"></script>
  
  <script>
    // 赞助页面专用的图片处理逻辑
    document.addEventListener('DOMContentLoaded', function() {
      const qrCodeImg = document.getElementById('sponsorQrCode');
      const fallbackDiv = document.getElementById('sponsorFallback');
      
      if (qrCodeImg) {
        // 监听图片加载失败事件
        qrCodeImg.addEventListener('error', function() {
          console.log('QR Code image failed to load, showing fallback options');
          if (fallbackDiv) {
            fallbackDiv.classList.remove('hidden');
          }
        });
        
        // 监听图片加载成功事件
        qrCodeImg.addEventListener('load', function() {
          console.log('QR Code image loaded successfully');
          if (fallbackDiv) {
            fallbackDiv.classList.add('hidden');
          }
        });
        
        // 如果图片已经加载失败（比如在脚本执行前就失败了）
        if (qrCodeImg.complete && !qrCodeImg.naturalWidth) {
          if (fallbackDiv) {
            fallbackDiv.classList.remove('hidden');
          }
        }
      }
    });
  </script>
</body>
</html>