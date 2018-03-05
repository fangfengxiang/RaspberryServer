<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/5
 * Time: 17:05
 */

namespace app\wechat\instruction;


use app\wechat\helpers\ErrorMap;

class Humiture
{

    protected static $events = [
       'read' => [
           'method' => 'GET',
           'params' =>[],
       ]
    ];


    public static function interpret(array $params):array
    {
        $key = $params[0];
        $events = self::$events;
        return $events[$key];
    }

    public static function format(string $res):string
    {
        $res = json_decode($res,true);
        if($res['code']!=0)
            return ErrorMap::getMsg($res['code']);

        $msg = '当前实验室:'.PHP_EOL
            .'温度为'.$res['data']['temperature'].'ºC'.PHP_EOL
            .'湿度为'.$res['data']['humidity'].'%';
        return $msg;
    }
}