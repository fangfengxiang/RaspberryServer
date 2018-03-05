<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/6
 * Time: 17:23
 */
return [
    //'host' => 'http://192.168.199.249',
    'host' => 'http://192.168.1.102',
    'port' => '80',
    'gateway'=>'192.168.199.249/gateway.php',

    /**
     * 指令解析类
     */
    'instruction' => [
        //开关类
        'light'    => 'app\wechat\instruction\Light',
        'humidifier' => 'app\wechat\instruction\humidifier',
        'door' => 'app\wechat\instruction\Door',
        //检测类
        'humiture' => 'app\wechat\instruction\Humiture',
        'illuminance' => 'app\wechat\instruction\Illuminance',
        'ultrasonic' => 'app\wechat\instruction\Ultrasonic',
        //遥控类
        'steering' => 'app\wechat\instruction\Steering',
    ],
];