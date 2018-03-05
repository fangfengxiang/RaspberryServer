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

class EventMessageHandler
{
    const MSGTYPE = 'event';
    protected $msg;
    protected $event;
    protected $eventCallable;

    public function work($payload)
    {

        $this->msg = $payload;
        if($this->msg['MsgType'] != self::MSGTYPE)
            throw new Exception('该消息不该由此消息处理器处理');

        $this->event = strtolower($this->msg['Event']);
        $this->eventCallable = 'on'.ucfirst($this->event);

        return $this->{$this->eventCallable}();
    }

    /**
     * 用户点击了菜单
     * @return string
     */
    protected function onClick():string
    {
        $sender = new Sender($this->msg['EventKey']);
        return $sender->send();
    }

    /**
     * 用户打开菜单链接
     * @return string
     */
    protected function onView():string
    {
        return '用户打开菜单链接';
    }

    /**
     * 关注公众号
     * @return string
     */
    protected function onSubscribe():string
    {
        return '欢迎关注光学实验室远程控制系统';
    }

    /**
     * 取消关注公众号
     * @return string
     */
    protected function onUnsubscribe():string
    {
        return '要走了吗?期待你归来';
    }

    /**
     * 扫二维码事件(包括扫码关注)
     * @return string
     */
    protected function onScan():string
    {
        return '扫二维码事件(包括扫码关注)';
    }

    /**
     * 上报地理位置
     * @return string
     */
    protected function onLocation():string
    {
        return '上报地理位置';
    }
}