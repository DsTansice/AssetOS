<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}
require_once 'includes/url_encoder.php';
$encoded_links = getEncodedProjectLinks();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title data-i18n="register_title">注册 - AssetOS</title>
  <link rel="icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="asset/favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-4">
  <div class="w-full max-w-md mx-auto">
    <!-- 注册表单 -->
    <div class="card">
      <div class="text-center mb-6">
        <h1 class="text-2xl font-bold page-title" data-i18n="register_title">注册 - AssetOS</h1>
        <p class="text-gray-600 mt-2" data-i18n="register_subtitle">创建一个账户来管理您的资产</p>
      </div>

      <!-- 顶部按钮 -->
      <div class="flex justify-between items-center mb-4">
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
        <button id="languageToggle" class="language-toggle" data-i18n="language_toggle">English</button>
      </div>

      <!-- 注册表单 -->
      <div class="space-y-4">
        <div>
          <label for="username" class="form-label" data-i18n="username">用户名</label>
          <input id="username" type="text" data-i18n-placeholder="enter_username" placeholder="请输入用户名" class="input-field">
        </div>
        <div>
          <label for="email" class="form-label" data-i18n="email">邮箱</label>
          <input id="email" type="email" data-i18n-placeholder="enter_email" placeholder="请输入邮箱" class="input-field">
        </div>
        <div>
          <label for="password" class="form-label" data-i18n="password">密码</label>
          <input id="password" type="password" data-i18n-placeholder="enter_password" placeholder="请输入密码" class="input-field">
        </div>
        <button onclick="register()" class="btn btn-primary w-full" data-i18n="register">注册</button>
        
        <!-- 邮箱验证提示 -->
        <div id="emailVerificationMessage" class="hidden mt-4 p-3 bg-green-100 text-green-800 rounded-md text-sm" data-i18n="registration_success">
          注册成功！请检查您的邮箱以验证账户
        </div>
        
        <div class="text-center">
          <a href="login.php" class="text-blue-500 text-sm hover:underline" data-i18n="have_account">已有账户？去登录</a>
        </div>
      </div>
    </div>

    <!-- 项目信息 -->
    <div class="mt-8 text-center">
      <div class="card">
        <h3 class="text-lg font-semibold text-gray-900 mb-2 gradient-text">AssetOS</h3>
        <p class="text-gray-600 text-sm mb-3" data-i18n="project_description">开源物品持有成本追踪系统</p>
        <div class="flex justify-center space-x-4">
          <a href="#" onclick="openLink('<?php echo $encoded_links['github_main']; ?>')" class="flex items-center text-gray-700 hover:text-blue-500 transition cursor-pointer">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
            </svg>
            GitHub
          </a>
          <a href="#" onclick="openLink('<?php echo $encoded_links['github_issues']; ?>')" class="text-gray-700 hover:text-blue-500 transition cursor-pointer" data-i18n="feedback">反馈</a>
          <a href="#" onclick="openLink('<?php echo $encoded_links['github_readme']; ?>')" class="text-gray-700 hover:text-blue-500 transition cursor-pointer" data-i18n="documentation">文档</a>
        </div>
        <p class="text-gray-500 text-xs mt-2" data-i18n="first_user_admin">第一个注册的用户将自动成为管理员</p>
        <p id="version-info" class="text-gray-500 text-xs mt-4"></p>
      </div>
    </div>
  </div>

  <!-- 自定义弹窗 -->
  <div id="custom-alert" class="custom-alert hidden">
    <div class="custom-alert-content">
      <span id="alert-message"></span>
      <button id="alert-close-btn" class="alert-close-btn">&times;</button>
    </div>
  </div>

  <!-- 加载动画 -->
  <div class="spinner"></div>

  <?php include 'includes/footer.php'; ?>

  <script src="js/script.js"></script>
  <script src="js/url-handler.js"></script>
  <script src="js/theme-simple.js"></script>
  <script src="js/button-text-enhancer.js"></script>
  <script>
    // 页面加载完成后执行
    document.addEventListener('DOMContentLoaded', function() {
      // 初始化语言设置
      const savedLanguage = localStorage.getItem('language') || 'zh-CN';
      setLanguage(savedLanguage);
      
      // 获取版本号
      fetchVersion();
      
      // 绑定语言切换按钮事件
      document.getElementById('languageToggle').addEventListener('click', function() {
        const currentLang = localStorage.getItem('language') || 'zh-CN';
        setLanguage(currentLang === 'zh-CN' ? 'en' : 'zh-CN');
      });
    });
  </script>
</body>
</html>