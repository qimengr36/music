<?php

namespace trait;

trait Song
{
    public function commonParams($clienttime = ''): array
    {
        [
            'mid'    => $mid,
            'dfid'   => $dfid,
            'userid' => $userid,
        ] = json_decode(file_get_contents(root_path().'runtime/openssl/config'), true);
        $token = file_get_contents(root_path().'runtime/token');
        return [
            'srcappid'   => 2919,
            'appid'      => 1014,
            'clienttime' => $clienttime ?: msectime(),
            'mid'        => $mid,
            'uuid'       => $mid,
            'dfid'       => $dfid,
            'token'      => $token,
            'userid'     => $userid,
        ];
    }

    public function searchSongParams($keyword, $page, $limit): array
    {
        //https://complexsearch.kugou.com/v2/search/song
        return [
            'callback'         => 'callback123',
            'clientver'        => 1000,
            'keyword'          => $keyword,
            'page'             => $page,
            'pagesize'         => $limit,
            'bitrate'          => 0,
            'isfuzzy'          => 0,
            'inputtype'        => 0,
            'platform'         => 'WebFilter',
            'iscorrection'     => 1,
            'privilege_filter' => 0,
            'filter'           => 10,
        ];
    }

    public function playSongInfoParams($audio_id): array
    {
        //https://wwwapi.kugou.com/play/songinfo
        return [
            'clientver'             => 20000,
            'platid'                => 4,
            'encode_album_audio_id' => $audio_id,
        ];
    }
}