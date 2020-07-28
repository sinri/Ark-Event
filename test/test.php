<?php

use sinri\ark\event\ArkEventDispatcher;
use sinri\ark\event\ArkListenerProvider;
use sinri\ark\event\test\SampleEvent;
use sinri\ark\event\test\SampleStoppableEvent;

require_once __DIR__ . '/../vendor/autoload.php';

$lp = new ArkListenerProvider();

$event1 = (new SampleEvent())->setEventName('event1');
$stopEvent1 = (new SampleStoppableEvent())->setEventName('event3')->setEventParameters(['stop' => false]);
$stopEvent2 = (new SampleStoppableEvent())->setEventName('event4')->setEventParameters(['stop' => true]);

//$lp->registerListenerForEvent(SampleEvent::class,function (\sinri\ark\event\ArkEvent $event){
//   echo __FUNCTION__.' event: '.$event->getEventName().PHP_EOL;
//})
//->registerListenerForEvent(SampleStoppableEvent::class,function (\sinri\ark\event\ArkEvent $event){
//    echo __FUNCTION__.' event: '.$event->getEventName().PHP_EOL;
//});

$lp
    ->registerListenerForEvent(\sinri\ark\event\ArkEvent::class, function (\sinri\ark\event\ArkEvent $event) {
        echo __FUNCTION__.'@'.__LINE__ . ' event: ' . $event->getEventName() . PHP_EOL;
    })
    ->registerListenerForEvent(\sinri\ark\event\ArkEvent::class, function (\sinri\ark\event\ArkEvent $event) {
        echo __FUNCTION__.'@'.__LINE__ . ' event: ' . $event->getEventName() . PHP_EOL;
    })
    ->registerListenerForEvent(\sinri\ark\event\ArkEvent::class, function (\sinri\ark\event\ArkEvent $event) {
        echo __FUNCTION__.'@'.__LINE__ . ' event: ' . $event->getEventName() . PHP_EOL;
    });

$ed = (new ArkEventDispatcher())->setListenerProvider($lp);

$ed->dispatch($event1);


$ed->dispatch($stopEvent1);

$ed->dispatch($stopEvent2);
