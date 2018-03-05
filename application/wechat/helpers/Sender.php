<?php
/**
 * Created by PhpStorm.
 * User: fangle
 * Date: 2018/2/5
 * Time: 16:46
 */

namespace app\wechat\helpers;

use think\facade\Config;

class Sender
{
    protected $sensor;
    protected $params;
    protected $instruction;
    protected $piHost;

    public function __construct($input)
    {
        $arr = explode('_',$input);
        foreach ($arr as $key=>$val){
            if($key==0)
                $this->sensor = $val;
            else
                $this->params[] = $val;
        }
        $this->instruction = Config::get('pi.instruction.'.$this->sensor);
        $this->piHost = Config::get('pi.host');
    }

    public function send():string
    {

        $client = new \GuzzleHttp\Client([
            'base_uri' => $this->piHost,
            'timeout'  => 10,
            'debug' => fopen('./guzzle.log','a+')
        ]);

        $query = $this->instruction::interpret($this->params);

        $response = $client
            ->request($query['method'],'/gateway.php',[
                'query' => [
                    'sensor' => $this->sensor,
                    'params' => $query['params'],
                ],
            ]);

        return $this->instruction::format(
            (string)$response->getBody()
        );
    }
}