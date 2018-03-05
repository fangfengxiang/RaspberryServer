<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/5
 * Time: 11:47
 */

namespace app\wechat\handler;


use EasyWeChat\Kernel\Contracts\EventHandlerInterface;
use think\facade\Config;

class MessageHandler implements EventHandlerInterface
{

    protected function getHandler($msgType)
    {
        $handlerLists = Config::get('wechat.msg_handler');
        return new $handlerLists[$msgType];
    }

    public function handle($payload = null)
    {
        // TODO: Implement handle() method.
        $handler = $this->getHandler($payload['MsgType']);
        return $handler->work($payload);
    }
}