<?php
// 应用公共文件
if (!function_exists('msectime')) {
    /**
     * 获取毫秒数
     * @return float
     */
    function msectime()
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }
}