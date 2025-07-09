/**
 * 按钮文本和样式增强器
 * 处理主题切换和语言切换按钮的文本显示
 */

document.addEventListener('DOMContentLoaded', function() {
    // 更新主题切换按钮文本
    function updateThemeButtonText() {
        const themeButtons = document.querySelectorAll('.theme-toggle-enhanced, .theme-toggle');
        const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        const currentLang = localStorage.getItem('language') || 'zh-CN';
        
        themeButtons.forEach(button => {
            const textSpan = button.querySelector('.theme-text') || button.querySelector('span');
            const sunPath = button.querySelector('.sun-path');
            const moonPath = button.querySelector('.moon-path');
            
            if (textSpan) {
                if (currentTheme === 'dark') {
                    textSpan.textContent = currentLang === 'zh-CN' ? '亮色' : 'Light';
                    button.title = currentLang === 'zh-CN' ? '切换到亮色模式' : 'Switch to light mode';
                } else {
                    textSpan.textContent = currentLang === 'zh-CN' ? '暗色' : 'Dark';
                    button.title = currentLang === 'zh-CN' ? '切换到暗色模式' : 'Switch to dark mode';
                }
            }
            
            // 更新图标显示
            if (sunPath && moonPath) {
                if (currentTheme === 'dark') {
                    sunPath.style.display = 'block';
                    moonPath.style.display = 'none';
                } else {
                    sunPath.style.display = 'none';
                    moonPath.style.display = 'block';
                }
            }
        });
    }
    
    // 更新语言切换按钮文本 - 已移到主脚本中处理
    function updateLanguageButtonText() {
        // 这个函数已经移到script.js中处理，这里保留空函数以防其他代码调用
    }
    
    // 初始化按钮文本
    updateThemeButtonText();
    // updateLanguageButtonText(); // 已移到主脚本处理
    
    // 监听主题变化
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'attributes' && mutation.attributeName === 'data-theme') {
                updateThemeButtonText();
            }
        });
    });
    
    observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['data-theme']
    });
    
    // 监听语言变化 - 已移到主脚本处理
    // const originalSetLanguage = window.setLanguage;
    // if (originalSetLanguage) {
    //     window.setLanguage = function(lang) {
    //         originalSetLanguage(lang);
    //         setTimeout(() => {
    //             updateLanguageButtonText();
    //             updateThemeButtonText();
    //         }, 100);
    //     };
    // }
    
    // 监听主题切换点击
    document.addEventListener('click', function(e) {
        const themeButton = e.target.closest('.theme-toggle-enhanced, .theme-toggle');
        if (themeButton) {
            // 延迟更新以确保主题已切换
            setTimeout(updateThemeButtonText, 100);
        }
        
        // 移除语言切换监听，让主脚本处理
        // const languageButton = e.target.closest('#languageToggle');
        // if (languageButton) {
        //     setTimeout(updateLanguageButtonText, 100);
        // }
    });
    
    // 暴露函数到全局
    window.updateThemeButtonText = updateThemeButtonText;
    window.updateLanguageButtonText = updateLanguageButtonText;
});
