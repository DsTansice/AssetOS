/**
 * AssetOS 简化版暗模式切换功能
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Theme toggle script loaded');

    // 获取存储的主题设置
    function getStoredTheme() {
        try {
            return localStorage.getItem('assetOS-theme');
        } catch (e) {
            return null;
        }
    }

    // 保存主题设置
    function setStoredTheme(theme) {
        try {
            localStorage.setItem('assetOS-theme', theme);
        } catch (e) {
            console.warn('无法保存主题设置');
        }
    }

    // 应用主题
    function applyTheme(theme) {
        console.log('Applying theme:', theme);
        
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
        }
        
        // 更新按钮提示文本
        updateButtonTitles(theme);
        
        // 保存设置
        setStoredTheme(theme);
    }

    // 更新按钮提示文本
    function updateButtonTitles(theme) {
        const buttons = document.querySelectorAll('.theme-toggle');
        buttons.forEach(button => {
            if (theme === 'dark') {
                button.setAttribute('title', '切换到亮色模式');
            } else {
                button.setAttribute('title', '切换到暗色模式');
            }
        });
    }

    // 切换主题
    function toggleTheme() {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        console.log('Toggling theme from', currentTheme || 'light', 'to', newTheme);
        
        applyTheme(newTheme);
        showNotification(newTheme);
    }

    // 显示切换通知
    function showNotification(theme) {
        const message = theme === 'dark' ? '已切换到暗色模式' : '已切换到亮色模式';
        
        const notification = document.createElement('div');
        notification.textContent = message;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${theme === 'dark' ? 'rgba(30, 30, 30, 0.95)' : 'rgba(255, 255, 255, 0.95)'};
            color: ${theme === 'dark' ? '#fff' : '#333'};
            padding: 10px 15px;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 10000;
            font-size: 14px;
            backdrop-filter: blur(10px);
            border: 1px solid ${theme === 'dark' ? 'rgba(255,255,255,0.1)' : 'rgba(255,255,255,0.2)'};
        `;
        
        document.body.appendChild(notification);
        
        // 2秒后自动消失
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 2000);
    }

    // 初始化主题
    const storedTheme = getStoredTheme();
    const systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const initialTheme = storedTheme || (systemDark ? 'dark' : 'light');
    
    console.log('Initial theme:', initialTheme);
    applyTheme(initialTheme);

    // 绑定切换按钮事件
    document.addEventListener('click', function(e) {
        const toggleButton = e.target.closest('.theme-toggle');
        if (toggleButton) {
            e.preventDefault();
            console.log('Theme toggle button clicked');
            toggleTheme();
        }
    });

    // 键盘快捷键 Ctrl/Cmd + Shift + T
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'T') {
            e.preventDefault();
            toggleTheme();
        }
    });

    // 暴露到全局作用域
    window.toggleTheme = toggleTheme;
    
    console.log('AssetOS Theme toggle initialized');
});
