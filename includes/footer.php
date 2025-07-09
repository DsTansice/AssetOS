<?php
/**
 * Footer                <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.30.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
          </svg>
          <span class="text-xs footer-btn-text-github">GitHub</span>   <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.30.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
          </svg>
          <span class="text-xs footer-btn-text-github">GitHub</span>   <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
          </svg>
          <span class="text-xs footer-btn-text-github">GitHub</span>- 包含版本信息
 */
require_once 'version.php';
require_once 'includes/url_encoder.php';
$version_info = getVersionInfo();
$encoded_links = getEncodedProjectLinks();
?>

<footer class="mt-8 text-center">
  <div class="bg-white rounded-lg shadow-sm p-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-2" data-i18n="footer_title">AssetOS - 开源物品持有成本追踪系统</h3>
    <p class="text-gray-600 mb-6" data-i18n="footer_subtitle">轻松管理您的资产，追踪持有成本</p>
    
    <!-- 快速链接按钮 -->
    <div class="mb-4">
      <div class="flex flex-wrap justify-center items-center gap-2">
        <a href="#" onclick="openLink('<?php echo $encoded_links['github_main']; ?>')" class="flex items-center bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-gray-800 transition cursor-pointer shadow border border-gray-600">
          <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
          </svg>
          <span class="text-sm footer-btn-text-github">GitHub</span>
        </a>
        
        <a href="https://t.me/AssetOSOffical" target="_blank" rel="noopener noreferrer" class="flex items-center bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-blue-700 transition shadow border border-blue-400">
          <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.820 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
          </svg>
          <span class="text-xs footer-btn-text-telegram" data-i18n="tg_group">交流</span>
        </a>
        
        <a href="https://t.me/OPAssetOS" target="_blank" rel="noopener noreferrer" class="flex items-center bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-cyan-700 transition shadow border border-cyan-400">
          <svg class="w-3.5 h-3.5 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.820 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
          </svg>
          <span class="text-xs footer-btn-text-cyan" data-i18n="tg_channel">频道</span>
        </a>
        
        <a href="#" onclick="openLink('<?php echo $encoded_links['github_issues']; ?>')" class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-orange-600 transition cursor-pointer shadow border border-orange-400">
          <span class="text-xs footer-btn-text-orange" data-i18n="feedback">反馈</span>
        </a>
        
        <a href="#" onclick="openLink('<?php echo $encoded_links['github_readme']; ?>')" class="bg-blue-600 text-white px-3 py-1.5 rounded hover:bg-green-600 transition cursor-pointer shadow border border-green-400">
          <span class="text-xs footer-btn-text-green" data-i18n="documentation">文档</span>
        </a>
      </div>
    </div>
    
    <!-- 分隔线 -->
    <div class="border-t border-gray-200 pt-3">
      <p class="text-gray-500 text-xs">
        <span data-i18n="version_label">版本</span>: v<?php echo htmlspecialchars($version_info['version']); ?> (<?php echo htmlspecialchars($version_info['code_name']); ?>) 
        | <span data-i18n="release_date_label">发布时间</span>: <?php echo htmlspecialchars($version_info['release_date']); ?> 
        | <span data-i18n="license_label">开源许可</span>: GPL-3.0 + <span data-i18n="commercial_license">商业许可</span> 
        | <a href="#" onclick="openLink('<?php echo $encoded_links['github_user']; ?>')" class="text-blue-600 hover:text-blue-800 hover:underline cursor-pointer font-medium">@DsTansice</a>
      </p>
    </div>
  </div>
</footer>

<script>
// URL解码函数
function decodeUrl(encoded) {
  try {
    console.log('正在解码:', encoded);
    // 还原字符替换
    let decoded = encoded.replace(/_eq_/g, '=').replace(/_plus_/g, '+').replace(/_slash_/g, '/');
    console.log('字符替换后:', decoded);
    // Base64解码
    const result = atob(decoded);
    console.log('解码结果:', result);
    return result;
  } catch (e) {
    console.error('链接解码失败:', e);
    return '';
  }
}

// 安全打开链接函数
function openLink(encodedUrl) {
  try {
    console.log('尝试打开链接:', encodedUrl);
    const url = decodeUrl(encodedUrl);
    if (url) {
      console.log('打开URL:', url);
      window.open(url, '_blank', 'noopener,noreferrer');
    } else {
      console.error('解码后的URL为空');
    }
  } catch (e) {
    console.error('链接打开失败:', e);
  }
}

// 测试解码功能
console.log('链接解码函数已加载');
</script>
