<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/4
 * Time: 14:20
 */

namespace app\wechat\controller;
use app\wechat\handler\MessageHandler;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages\Message;
use think\Controller;
use think\facade\Config;

class Gateway extends Controller
{
    protected $wechat;

    protected function initialize()
    {
        $config = Config::get('wechat.');
        $this->wechat = Factory::officialAccount($config);
    }

    public function index()
    {
        $this->wechat->server->push(MessageHandler::class,Message::ALL);
        $response = $this->wechat->server->serve();
        return $response->send();
    }


    public function setMenu()
    {
        $buttons = [
            [
                'name'=>'开关',
                'sub_button'=>[
                    [
                        'type'=>'click',
                        'name'=>'开灯',
                        'key' =>'light_on',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'关灯',
                        'key' =>'light_off',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'加湿器开',
                        'key' =>'humidifier_on',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'加湿器关',
                        'key' =>'humidifier_off'
                    ],
                    [
                        'type'=>'click',
                        'name'=>'开门',
                        'key' =>'door_open',
                    ],
                ]
            ],
            [
                'name'=>'检测',
                'sub_button'=>[
                    [
                        'type'=>'click',
                        'name'=>'温湿度计',
                        'key' =>'humiture_read',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'光照度计',
                        'key' =>'illuminance_read',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'超声波测距',
                        'key' =>'ultrasonic_read',
                    ]
                ]
            ],
            [
                'name'=>'遥控',
                'sub_button'=>[
                    [
                        'type'=>'click',
                        'name'=>'舵机顺90度',
                        'key' =>'steering_clockwise_90',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'舵机逆90度',
                        'key' =>'steering_contrarotate_90',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'舵机顺5度',
                        'key' =>'steering_clockwise_5',
                    ],
                    [
                        'type'=>'click',
                        'name'=>'舵机逆5度',
                        'key' =>'steering_contrarotate_5'
                    ],
                ]
            ],
        ];
        $this->wechat->menu->create($buttons);
    }

    public function getMenu()
    {
        $menus = $this->wechat->menu->list();
        echo '<pre>';
        var_dump($menus);
    }

    public function testRasp()
    {
        $client = new \GuzzleHttp\Client();
        $res = $client
            ->request('GET','http://192.168.199.249/gateway.php', [
                'query'=>['sensor'=>'humiture']
            ]);
        echo '<pre>';
        var_dump((string)$res->getBody());
    }
}