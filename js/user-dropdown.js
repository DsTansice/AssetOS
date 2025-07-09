/**
 * 用户下拉菜单功能
 * 处理导航栏用户下拉菜单的显示与隐藏逻辑
 */

// 初始化用户下拉菜单
function initUserDropdown() {
  const userDropdowns = document.querySelectorAll('.user-dropdown');
  if (!userDropdowns.length) return;
  
  // 为每个下拉菜单添加事件监听
  userDropdowns.forEach(dropdown => {
    const button = dropdown.querySelector('.user-button');
    if (!button) return;
    
    let clickTimeout = null;
    
    // 点击按钮切换下拉菜单显示状态
    button.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      // 清除可能的延时关闭
      if (clickTimeout) {
        clearTimeout(clickTimeout);
        clickTimeout = null;
      }
      
      // 关闭其他下拉菜单
      userDropdowns.forEach(otherDropdown => {
        if (otherDropdown !== dropdown) {
          otherDropdown.classList.remove('active');
        }
      });
      
      // 切换当前下拉菜单
      dropdown.classList.toggle('active');
    });
    
    // 鼠标悬停在整个下拉菜单区域时显示菜单（延迟显示）
    dropdown.addEventListener('mouseenter', function() {
      if (clickTimeout) {
        clearTimeout(clickTimeout);
        clickTimeout = null;
      }
      
      // 短暂延迟后显示，避免意外触发
      setTimeout(() => {
        dropdown.classList.add('active');
      }, 100);
    });
    
    // 鼠标离开下拉菜单区域时隐藏菜单（延迟隐藏）
    dropdown.addEventListener('mouseleave', function() {
      // 延迟关闭，给用户时间移动鼠标
      clickTimeout = setTimeout(() => {
        dropdown.classList.remove('active');
      }, 200);
    });
    
    // 防止菜单内容区域的点击事件冒泡
    const dropdownContent = dropdown.querySelector('.user-dropdown-content');
    if (dropdownContent) {
      dropdownContent.addEventListener('click', function(e) {
        // 如果点击的是链接，允许正常跳转
        if (e.target.tagName === 'A' || e.target.closest('a')) {
          return;
        }
        // 如果点击的是按钮，允许正常执行
        if (e.target.tagName === 'BUTTON' || e.target.closest('button')) {
          return;
        }
        e.stopPropagation();
      });
    }
  });
  
  // 点击页面其他位置关闭所有下拉菜单
  document.addEventListener('click', function(e) {
    const clickedDropdown = e.target.closest('.user-dropdown');
    
    userDropdowns.forEach(dropdown => {
      // 如果点击的不是当前下拉菜单内的元素，则关闭该菜单
      if (dropdown !== clickedDropdown) {
        dropdown.classList.remove('active');
      }
    });
  });
  
  // ESC键关闭所有下拉菜单
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      userDropdowns.forEach(dropdown => {
        dropdown.classList.remove('active');
      });
    }
  });
  
  // Tab键导航支持
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Tab') {
      // 如果不是在下拉菜单区域内，关闭所有菜单
      setTimeout(() => {
        const activeElement = document.activeElement;
        const isInDropdown = userDropdowns.some(dropdown => 
          dropdown.contains(activeElement)
        );
        
        if (!isInDropdown) {
          userDropdowns.forEach(dropdown => {
            dropdown.classList.remove('active');
          });
        }
      }, 0);
    }
  });
}

// 页面加载完成后初始化
document.addEventListener('DOMContentLoaded', function() {
  initUserDropdown();
});

// 页面加载完成后初始化下拉菜单
document.addEventListener('DOMContentLoaded', function() {
  initUserDropdown();
});
