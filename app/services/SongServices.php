<?php

namespace app\services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use trait\Song;
use utils\HttpClient;


class SongServices extends BaseServices
{
    use Song;

    public function searchSong($keyword)
    {
        [$page, $limit] = $this->getPageValue();
        $params = array_merge($this->commonParams(), $this->searchSongParams($keyword, $page, $limit));
        $params = $this->setSign($params);
        $url = 'https://complexsearch.kugou.com/v2/search/song';
        $client = app()->make(HttpClient::class);
        $res = $client->request($url, $params, 'get');
        if ($res['code']) {
            return [];
        } else {
            $html_data = $res['data'];
        }
        if (is_bool($html_data)) {
            return [];
        }
        $str = preg_replace('/\)$/', '', preg_match('/\((.*)\)/', $html_data, $matches) ? $matches[1] : '');
        $arr = json_decode($str, true);
        $lists = [];
        if ($arr && isset($arr['data'])) {
            $arr = $arr['data'];
            [
                'pagesize' => $pagesize,
                'page'     => $page,
                'total'    => $total,
                'lists'    => $array,
            ] = $arr;
            if ($array) {
                foreach ($array as $val) {
                    $lists[] = [
                        'singer_name' => $val['SingerName'],
                        'album_name'  => $val['AlbumName'],
                        'file_name'   => $val['FileName'],
                        'song_id'     => $val['EMixSongID'],
                    ];
                }
            }
        } else {
            $pagesize = $page = $total = 0;
        }
        return compact('pagesize', 'page', 'total', 'lists');
    }

    public function playSongInfo($audio_id)
    {
        $params = array_merge($this->commonParams(), $this->playSongInfoParams($audio_id));
        $params = $this->setSign($params);
        $url = 'https://wwwapi.kugou.com/play/songinfo?'.http_build_query($params);

        $client = new Client(['verify' => false]);
        $request = new Request(
            'GET',
            $url
        );
        $res = $client->sendAsync($request)->wait();
        $arr = json_decode($res->getBody(), true);
        if ($arr && isset($arr['data'])) {
            $arr = $arr['data'];
        } else {
            return [];
        }
        return [
            'audio_name'  => $arr['author_name'].'-'.$arr['song_name'],
            'play_url'    => $arr['play_url'],
            'author_name' => $arr['author_name'],
        ];
    }

    //下载

    public function setSign($array): array
    {
        $serve_key = 'NVPh5oo715z5DIWAeQlhMDsWXXQV4hwt';
        if (!$array) {
            return [];
        }
        $arr = [];
        ksort($array);
        foreach ($array as $key => $value) {
            $arr[] = $key.'='.$value;
        }
        array_unshift($arr, $serve_key);
        $arr[] = $serve_key;
        $str = implode('', $arr);
        $sign = md5($str);
        $array['signature'] = $sign;
        return $array;
    }


}