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
            'link' => './link_two',
        ];
        View::assign('link_two', $link_two);
        return View::fetch();
    }

    //link_two
    public function linkTwo()
    {
        $link_two = [
            'name'             => '宝藏',
            'linkTwoIframeUrl' => 'https://bitbucket.org/letsgo666/letsgogo_6/src/main/README.md',
            'title'            => '快连VPN - 永远能连上的梯子',
            'invitationCode'   => '496302488',
        ];
        View::assign('link_two', $link_two);
        $env = env('APP_DEBUG', true);
        View::assign('env', $env);
        return View::fetch();
    }
}