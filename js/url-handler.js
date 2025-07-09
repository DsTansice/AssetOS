/**
 * URL解码和链接处理工具
 */

// URL解码函数
function decodeUrl(encoded) {
  try {
    // 还原字符替换
    let decoded = encoded.replace(/_eq_/g, '=').replace(/_plus_/g, '+').replace(/_slash_/g, '/');
    // Base64解码
    return atob(decoded);
  } catch (e) {
    console.error('URL解码失败:', e);
    return '';
  }
}

// 安全打开链接函数
function openLink(encodedUrl) {
  try {
    const url = decodeUrl(encodedUrl);
    if (url) {
      window.open(url, '_blank', 'noopener,noreferrer');
    }
  } catch (e) {
    console.error('链接解码失败:', e);
  }
}

// 初始化编码链接
function initEncodedLinks() {
  // 这些编码值将在PHP中生成
  return {
    github_main: '',
    github_issues: '',
    github_readme: '',
    github_user: ''
  };
}
