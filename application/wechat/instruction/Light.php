<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/5
 * Time: 17:06
 */

namespace app\wechat\instruction;


class Light
{
    protected static $events = [
        'on' => [
            'method' => 'POST',
            'params' => ['switch'=>1],
        ],
        'off' => [
            'method' => 'POST',
            'params' => ['switch'=>0],
        ]
    ];


    public static function interpret(array $params):array
    {
        $key = $params[0];
        $event = self::$events[$key];
        $event['params'] = json_encode($event['params']);
        return $event;
    }

    public static function format(string $res):string
    {
        $res = json_decode($res,true);
        if($res['code']!=0)
            return ErrorMap::getMsg($res['code']);

        $status = $res['data']['switch']?'开启':'关闭';
        return  '当前实验室照明系统已'.$status;
    }
}