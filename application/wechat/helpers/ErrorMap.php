<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/5
 * Time: 16:54
 */

namespace app\wechat\helpers;


class ErrorMap
{
    public static $map = [
        -1 => '安全校验未通过',
        -2 => '该树莓派丢失此传感器的硬件驱动',
        -3 => '传感器冷却中，再过一两秒重试吧',
    ];

    public static function getMsg(int $code):string
    {
        return isset(self::$map[$code])
            ? self::$map[$code]
            : '未知错误，错误状态码:'.$code;
    }
}