<?php
/**
 * AssetOS 版本管理
 * Version Management for AssetOS
 */

// 当前版本号
define('ASSETOS_VERSION', '1.6.0');
define('ASSETOS_RELEASE_DATE', '2025-07-10');
define('ASSETOS_CODE_NAME', 'Enhanced');

// 版本信息数组
$version_info = [
    'version' => ASSETOS_VERSION,
    'release_date' => ASSETOS_RELEASE_DATE,
    'code_name' => ASSETOS_CODE_NAME,
    'full_name' => 'AssetOS ' . ASSETOS_VERSION . ' (' . ASSETOS_CODE_NAME . ')',
    'build_date' => date('Y-m-d H:i:s')
];

/**
 * 获取版本号
 * @return string 版本号
 */
function getVersion() {
    return ASSETOS_VERSION;
}

/**
 * 获取完整版本信息
 * @return array 版本信息数组
 */
function getVersionInfo() {
    global $version_info;
    return $version_info;
}

/**
 * 获取版本显示字符串
 * @param bool $include_codename 是否包含代号
 * @return string 版本显示字符串
 */
function getVersionString($include_codename = false) {
    if ($include_codename) {
        return 'AssetOS v' . ASSETOS_VERSION . ' (' . ASSETOS_CODE_NAME . ')';
    }
    return 'AssetOS v' . ASSETOS_VERSION;
}

/**
 * 检查是否有新版本（预留接口）
 * @return bool 是否有新版本
 */
function checkForUpdates() {
    // 这里可以实现检查更新的逻辑
    return false;
}
?>