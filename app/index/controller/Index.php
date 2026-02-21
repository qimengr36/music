<?php

namespace app\index\controller;

use think\facade\View;
use think\facade\Request;

class Index
{
    public function index()
    {
        // 赋值给模板
        $domain = Request::domain();
        View::assign('domain', $domain);
        $env = env('APP_DEBUG', true);
        View::assign('env', $env);
        $link_two = [
            'name' => '宝藏',
            'link' => 'https://36haxb.onelink.me/MoVT/82y2yrp9',
        ];
        View::assign('link_two', $link_two);
        return View::fetch();
    }
}