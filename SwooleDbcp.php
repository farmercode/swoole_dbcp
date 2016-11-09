<?php

/**
 * Created by PhpStorm.
 * User: king
 * Date: 16/11/9
 * Time: 下午11:53
 */
class Object {

    public function __construct($attr)
    {
        foreach($attr as $name=>$value){
            if(isset($this->$name)){
                $this->$name = $value;
            }
        }
    }
}

class ServerConfig extends Object{

    public $host;

    public $port;

}

class SwooleDbcp
{
    /**
     * @var ServerConfig 服务器端配置文件
     */
    public $sConfig;

    /**
     * @var swoole_http_server
     */
    public $server;

    public function __construct(ServerConfig $serverConfig)
    {
        $this->sConfig = $serverConfig;
    }

    protected function _init(){
        $this->server = new swoole_http_server($this->sConfig->host,$this->sConfig->port);
    }

    /**
     * 开启连接池
     */
    public function run(){
        $this->server->start();
    }
}