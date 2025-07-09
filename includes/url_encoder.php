<?php
/**
 * URL 编码/解码工具
 * 用于对敏感链接进行简单编码处理
 */

/**
 * 简单的URL编码函数
 * @param string $url 要编码的URL
 * @return string 编码后的字符串
 */
function encodeUrl($url) {
    // 使用base64编码并添加简单的字符替换
    $encoded = base64_encode($url);
    $encoded = str_replace(['=', '+', '/'], ['_eq_', '_plus_', '_slash_'], $encoded);
    return $encoded;
}

/**
 * 简单的URL解码函数
 * @param string $encoded 编码后的字符串
 * @return string 解码后的URL
 */
function decodeUrl($encoded) {
    // 还原字符替换并base64解码
    $decoded = str_replace(['_eq_', '_plus_', '_slash_'], ['=', '+', '/'], $encoded);
    return base64_decode($decoded);
}

/**
 * 获取编码后的项目链接
 * @return array 包含各种编码链接的数组
 */
function getEncodedProjectLinks() {
    // 多层混淆：先异或再base64
    $key = 0x42; 
    
    // 混淆后的字符串
    $domain_parts = [
        pack('H*', dechex(ord('h') ^ $key) . dechex(ord('t') ^ $key) . dechex(ord('t') ^ $key) . dechex(ord('p') ^ $key) . dechex(ord('s') ^ $key)),
        pack('H*', dechex(ord(':') ^ $key) . dechex(ord('/') ^ $key) . dechex(ord('/') ^ $key)),
        pack('H*', dechex(ord('g') ^ $key) . dechex(ord('i') ^ $key) . dechex(ord('t') ^ $key) . dechex(ord('h') ^ $key) . dechex(ord('u') ^ $key) . dechex(ord('b') ^ $key)),
        pack('H*', dechex(ord('.') ^ $key) . dechex(ord('c') ^ $key) . dechex(ord('o') ^ $key) . dechex(ord('m') ^ $key))
    ];
    
    // 构建基础URL
    $base_url = '';
    foreach ($domain_parts as $part) {
        for ($i = 0; $i < strlen($part); $i++) {
            $base_url .= chr(ord($part[$i]) ^ $key);
        }
    }
    
    // 用户和仓库信息
    $user_repo = chr(ord('/') ^ $key) . chr(ord('D') ^ $key) . chr(ord('s') ^ $key) . chr(ord('T') ^ $key) . 
                 chr(ord('a') ^ $key) . chr(ord('n') ^ $key) . chr(ord('s') ^ $key) . chr(ord('i') ^ $key) . 
                 chr(ord('c') ^ $key) . chr(ord('e') ^ $key) . chr(ord('/') ^ $key) . chr(ord('A') ^ $key) . 
                 chr(ord('s') ^ $key) . chr(ord('s') ^ $key) . chr(ord('e') ^ $key) . chr(ord('t') ^ $key) . 
                 chr(ord('O') ^ $key) . chr(ord('S') ^ $key);
    
    // 解混淆
    $user_repo_clean = '';
    for ($i = 0; $i < strlen($user_repo); $i++) {
        $user_repo_clean .= chr(ord($user_repo[$i]) ^ $key);
    }
    
    $github_base = $base_url . $user_repo_clean;
    
    // 路径1混淆
    $path1 = '';
    $chars1 = [0x2F^$key, 0x69^$key, 0x73^$key, 0x73^$key, 0x75^$key, 0x65^$key, 0x73^$key];
    foreach ($chars1 as $char) {
        $path1 .= chr($char ^ $key);
    }
    
    // 路径2混淆  
    $path2 = '';
    $chars2 = [0x2F^$key, 0x62^$key, 0x6C^$key, 0x6F^$key, 0x62^$key, 0x2F^$key, 0x6D^$key, 0x61^$key, 0x69^$key, 0x6E^$key, 0x2F^$key, 0x52^$key, 0x45^$key, 0x41^$key, 0x44^$key, 0x4D^$key, 0x45^$key, 0x2E^$key, 0x6D^$key, 0x64^$key];
    foreach ($chars2 as $char) {
        $path2 .= chr($char ^ $key);
    }
    
    $paths = [
        'p1' => $path1,
        'p2' => $path2,
        'user' => substr($user_repo_clean, 0, strrpos($user_repo_clean, '/'))
    ];
    
    return [
        'github_main' => encodeUrl($github_base),
        'github_issues' => encodeUrl($github_base . $paths['p1']),
        'github_readme' => encodeUrl($github_base . $paths['p2']),
        'github_user' => encodeUrl($base_url . $paths['user'])
    ];
}
?>
