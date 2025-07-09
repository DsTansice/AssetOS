/**
 * 图片链接解码处理工具
 * 用于自动解码带有 data-encoded-url 属性的图片元素
 */

/**
 * 解码单个图片元素
 * @param {HTMLImageElement} imgElement 图片元素
 * @param {string} encodingType 编码类型 (base64, custom)
 */
function decodeImageUrl(imgElement, encodingType = 'base64') {
    if (!imgElement || !imgElement.hasAttribute('data-encoded-url')) {
        return false;
    }
    
    const encodedUrl = imgElement.getAttribute('data-encoded-url');
    
    try {
        let decodedUrl;
        
        switch (encodingType) {
            case 'base64':
                decodedUrl = atob(encodedUrl);
                break;
            case 'custom':
                // 如果将来需要使用自定义解码（如 includes/url_encoder.php 中的解码函数）
                if (typeof decodeUrl === 'function') {
                    decodedUrl = decodeUrl(encodedUrl);
                } else {
                    console.warn('Custom decode function not available, falling back to base64');
                    decodedUrl = atob(encodedUrl);
                }
                break;
            default:
                throw new Error('Unsupported encoding type: ' + encodingType);
        }
        
        // 添加图片加载事件监听
        imgElement.onload = function() {
            console.log('Image loaded successfully:', {
                element: imgElement.id || imgElement.className,
                url: decodedUrl
            });
            imgElement.classList.remove('decode-error');
        };
        
        imgElement.onerror = function() {
            console.error('Image failed to load:', {
                element: imgElement.id || imgElement.className,
                url: decodedUrl
            });
            
            // 设置错误状态
            imgElement.alt = 'Image loading failed';
            imgElement.classList.add('decode-error');
            
            // 尝试使用备用图片或保持空白
            imgElement.src = 'asset/qr-placeholder.svg';
            
            // 添加重试按钮
            setTimeout(() => {
                if (!imgElement.nextElementSibling || !imgElement.nextElementSibling.classList.contains('retry-button')) {
                    createRetryButton(imgElement);
                }
            }, 100);
        };
        
        // 设置解码后的 URL
        imgElement.src = decodedUrl;
        
        // 保留 data-encoded-url 属性，不移除，以便重试时使用
        // imgElement.removeAttribute('data-encoded-url');
        
        return true;
    } catch (e) {
        console.error('Failed to decode image URL:', {
            element: imgElement.id || imgElement.className,
            error: e.message
        });
        
        // 设置默认的错误状态
        imgElement.alt = 'Image decoding failed';
        imgElement.classList.add('decode-error');
        
        return false;
    }
}

/**
 * 自动解码页面中所有带有 data-encoded-url 属性的图片
 * @param {string} encodingType 编码类型 (base64, custom)
 */
function decodeAllImages(encodingType = 'base64') {
    const images = document.querySelectorAll('img[data-encoded-url]');
    let successCount = 0;
    
    images.forEach(img => {
        if (decodeImageUrl(img, encodingType)) {
            successCount++;
        }
    });
    
    console.log(`Decoded ${successCount} out of ${images.length} images`);
    return successCount;
}

/**
 * 重试失败的图片加载
 */
function retryFailedImages() {
    const failedImages = document.querySelectorAll('img.decode-error[data-encoded-url]');
    console.log(`Retrying ${failedImages.length} failed images`);
    
    failedImages.forEach(img => {
        img.classList.remove('decode-error');
        decodeImageUrl(img);
    });
}

/**
 * 创建图片重试按钮
 */
function createRetryButton(imgElement) {
    const retryBtn = document.createElement('button');
    retryBtn.textContent = '重试加载图片';
    retryBtn.className = 'retry-button px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm mt-2 block mx-auto';
    retryBtn.onclick = function() {
        imgElement.classList.remove('decode-error');
        decodeImageUrl(imgElement);
        retryBtn.remove();
    };
    
    imgElement.parentNode.insertBefore(retryBtn, imgElement.nextSibling);
}

/**
 * 初始化图片解码
 * 在 DOM 加载完成后自动执行
 */
function initImageDecoding() {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            decodeAllImages();
        });
    } else {
        // DOM 已经加载完成
        decodeAllImages();
    }
}

// 如果页面已经加载完成，立即初始化
// 否则等待 DOM 加载完成
initImageDecoding();

// 导出函数以供其他脚本使用
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        decodeImageUrl,
        decodeAllImages,
        initImageDecoding
    };
}
