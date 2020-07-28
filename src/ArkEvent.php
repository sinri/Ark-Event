<?php


namespace sinri\ark\event;


abstract class ArkEvent
{
    /**
     * @var string
     */
    protected $eventName;
    /**
     * @var array
     */
    protected $eventParameters=[];

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->eventName;
    }

    /**
     * @param string $eventName
     * @return ArkEvent
     */
    public function setEventName(string $eventName): ArkEvent
    {
        $this->eventName = $eventName;
        return $this;
    }

    /**
     * @return array
     */
    public function getEventParameters(): array
    {
        return $this->eventParameters;
    }

    /**
     * @param array $eventParameters
     * @return ArkEvent
     */
    public function setEventParameters(array $eventParameters): ArkEvent
    {
        $this->eventParameters = $eventParameters;
        return $this;
    }
}