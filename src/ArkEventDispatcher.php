<?php


namespace sinri\ark\event;


use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\StoppableEventInterface;

class ArkEventDispatcher implements EventDispatcherInterface
{
    /**
     * @var ArkListenerProvider
     */
    protected $listenerProvider;

    /**
     * @return ArkListenerProvider
     */
    public function getListenerProvider(): ArkListenerProvider
    {
        return $this->listenerProvider;
    }

    /**
     * @param ArkListenerProvider $listenerProvider
     * @return ArkEventDispatcher
     */
    public function setListenerProvider(ArkListenerProvider $listenerProvider): ArkEventDispatcher
    {
        $this->listenerProvider = $listenerProvider;
        return $this;
    }

    /**
     * Provide all relevant listeners with an event to process.
     *
     * @param object $event
     *   The object to process.
     *
     * @return object
     *   The Event that was passed, now modified by listeners.
     */
    public function dispatch(object $event)
    {
        $listeners=$this->listenerProvider->getListenersForEvent($event);
        foreach ($listeners as $listener){
            call_user_func_array($listener,[$event]);
            if($event instanceof StoppableEventInterface){
                if($event->isPropagationStopped()){
                    break;
                }
            }
        }
        return $event;
    }
}