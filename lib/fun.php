<?php
/**
 * 消息提示
 * @param  int $type 1成功2失败
 * @param  string $msg
 * @param  string $url
 * @return null
 */
function message($type, $msg = '', $url = '') {
    $toUrl = "Location:message.php?type={$type}";
    //当msg不存在时，不写入
    $toUrl .= $msg ? "&msg={$msg}" : '';
    //当url不存在时，不写入
    $toUrl .= $url ? "&url={$url}" : '';
    header($toUrl);
    exit;
}

/**
 * 检查用户是否登录
 * @return bool 
 */
function checkLogin() {
    //开启session
    session_start();
    //用户未登录
    if (empty($_SESSION['user'])) {
        return false;
    }
    return true;
}
 ?>
