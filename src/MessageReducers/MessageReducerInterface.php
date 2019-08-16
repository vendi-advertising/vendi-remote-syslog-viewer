<?php

namespace App\MessageReducers;

use App\Entity\SyslogEvent;

interface MessageReducerInterface
{
    public function should_event_be_skipped(SyslogEvent $thisEvent, ?SyslogEvent $prevEvent, ?SyslogEvent $nextEvent) : bool;
}
