<?php


namespace sinri\ark\event\test;


use Psr\EventDispatcher\StoppableEventInterface;
use sinri\ark\event\ArkStoppableEvent;

class SampleStoppableEvent extends ArkStoppableEvent
{

    /**
     * Is propagation stopped?
     *
     * This will typically only be used by the Dispatcher to determine if the
     * previous listener halted propagation.
     *
     * @return bool
     *   True if the Event is complete and no further listeners should be called.
     *   False to continue calling listeners.
     */
    public function isPropagationStopped(): bool
    {
        return (isset($this->eventParameters['stop']) && $this->eventParameters['stop']);
    }
}