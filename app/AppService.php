<?php

declare (strict_types=1);

namespace app;

use utils\Json;
use think\Service;

/**
 * 应用服务类
 */
class AppService extends Service
{
    //绑定容器对象
    public array $bind = [
        'json' => Json::class,
    ];

    public function register()
    {
        // 服务注册
    }

    public function boot()
    {
        // 服务启动
        defined('DS') || define('DS', DIRECTORY_SEPARATOR);
    }
}
