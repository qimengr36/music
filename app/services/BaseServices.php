<?php

namespace app\services;

use think\facade\Config;

class BaseServices
{
    public function getPageValue(bool $isPage = true, bool $isRelieve = true)
    {
        $page = $limit = 0;
        $defaultLimit = 30;
        if ($isPage) {
            $page = app()->request->param('page', 0);
            $limit = app()->request->param('pagesize', 0);
        }
        return [(int)$page ? $page : 1, (int)$limit ? $limit : 30, (int)$defaultLimit];
    }
}