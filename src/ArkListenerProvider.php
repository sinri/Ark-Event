<?php


namespace sinri\ark\event;


use Psr\EventDispatcher\ListenerProviderInterface;

/**
 * Class ArkListenerProvider
 * @package sinri\ark\event
 *
 * A simple implementation of `ListenerProviderInterface`
 * And it might be extended with Queue, Cluster, etc.
 */
class ArkListenerProvider implements ListenerProviderInterface
{
    /**
     * @var callable[][]
     */
    protected $eventRegistration=[];

    /**
     * @param object $event
     *   An event for which to return the relevant listeners.
     * @return iterable[callable]
     *   An iterable (array, iterator, or generator) of callables.  Each
     *   callable MUST be type-compatible with $event.
     */
    public function getListenersForEvent(object $event): iterable
    {
        $classNameList=array_keys($this->eventRegistration);
        foreach ($classNameList as $className){
            if($event instanceof $className){
                return $this->eventRegistration[$className];
            }
        }
        return [];
    }

    /**
     * @param string $eventClassName such as `Extended_ArkEvent::class`
     * @param callable $listener such as `function ($event)`
     * @return $this
     */
    public function registerListenerForEvent(string $eventClassName,callable $listener){
        if(!isset($this->eventRegistration[$eventClassName])){
            $this->eventRegistration[$eventClassName]=[];
        }
        $this->eventRegistration[$eventClassName][]=$listener;
        return $this;
    }

    /**
     * @param string $eventClassName
     * @param iterable[callable] $listeners actually it means callable[], each as `function ($event)`
     */
    public function registerListenersForEvent(string $eventClassName,iterable $listeners)
    {
        foreach ($listeners as $listener){
            $this->registerListenerForEvent($eventClassName,$listener);
        }
    }

    /**
     * This method is designed to stopped listening to a type of event, clearing all.
     * @param string $eventClassName such as `Extended_ArkEvent::class`
     * @return $this
     */
    public function unregisterAllListenersForEvent(string $eventClassName){
        if(isset($this->eventRegistration[$eventClassName])){
            unset($this->eventRegistration[$eventClassName]);
        }
        return $this;
    }
}