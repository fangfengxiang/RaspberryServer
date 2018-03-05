<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/5
 * Time: 11:32
 */

namespace app\wechat\handler;


use app\wechat\helpers\Sender;
use EasyWeChat\Kernel\Exceptions\Exception;

class TextMessageHandler
{
    const MSGTYPE = 'text';
    protected $msg;

    static protected $textToEvent = [
        'light_on' => '开灯',
        'light_off' => '关灯',
    ];

    public function work($payload)
    {

        $this->msg = $payload;
        if($this->msg['MsgType'] != self::MSGTYPE)
            throw new Exception('该消息不该由此消息处理器处理');

        if($eventKey = array_search($this->msg['Content'],self::$textToEvent)){
            return $this->eventHandle($eventKey);
        }

        return "暂未支持该指令";
    }

    public function eventHandle($eventKey)
    {
        $sender = new Sender($eventKey);
        return $sender->send();
    }


}