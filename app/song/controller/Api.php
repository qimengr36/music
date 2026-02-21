<?php

namespace app\song\controller;

use app\AuthController;
use app\services\SongServices;
use think\facade\App;

class Api extends AuthController
{
    public function __construct(App $app, SongServices $service)
    {
        parent::__construct($app);
        $this->services = $service;
    }
    //对请求参数进行加密
    //歌曲检索
    public function searchSong($keyword)
    {
        $list = $this->services->searchSong($keyword);
        return app('json')->success($list);
    }

    //播放歌曲
    public function playSongInfo()
    {
        $audio_id = $this->request->post('audio_id', '');
        $list = $this->services->playSongInfo($audio_id);
        return app('json')->success($list);
    }
}