<?php

namespace app\index\controller;

use think\facade\View;
use think\facade\Request;

class Index
{
    public function index()
    {
        $domain = Request::domain();
        $env = env('APP_DEBUG', true);
        // 赋值给模板
        View::assign('domain', $domain);
        View::assign('env', $env);
        return View::fetch();
    }
}