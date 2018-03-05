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

class VoiceMessageHandler
{
    const MSGTYPE = 'voice';
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

        if($eventKey = array_search(rtrim($this->msg['Recognition'],'。'),self::$textToEvent)){
            return $this->eventHandle($eventKey);
        }

        return rtrim($this->msg['Recognition'],'。');
    }

    public function eventHandle($eventKey)
    {
        $sender = new Sender($eventKey);
        return $sender->send();
    }


}