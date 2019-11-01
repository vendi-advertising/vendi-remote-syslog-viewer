<?php

namespace App\MessageReducers;

use App\Entity\SyslogEvent;
use App\MessageFilters\FsTabSwapWarningFilter;

class StaticStringReducer implements MessageReducerInterface
{
    private $items;

    public function get_items() : array
    {
        if(!$this->items){
            $this->items = [
                [
                    'facility' => 3,
                    'tag' => '/usr/sbin/irqbalance:',
                    'message' => 'Balancing is ineffective on systems with a single cache domain.  Shutting down',
                ],
                [
                    'facility' => 3,
                    'tag' => 'mysqld:',
                    'message' => 'MySql general message',
                ],
                [
                    'facility' => 0,
                    'tag' => 'kernel:',
                    'message' => 'General boot message',
                ],
                [
                    'facility' => 1,
                    'tag' => 'kernel:',
                    'message' => 'General boot message',
                ],
                [
                    'facility' => 0,
                    'tag' => '/opt/digitalocean/bin/do-agent[1',
                    'message' => 'DigitalOcean Agent Noise',
                ],
                [
                    'facility' => 3,
                    'tag' => 'systemd-resolved[8820]:',
                    'message' => 'NXDOMAIN Warning',
                ],
                [
                    'facility' => 3,
                    'tag' => 'kernel:',
                    'message' => FsTabSwapWarningFilter::MESSAGE ,
                ],
            ];
        }

        return $this->items;
    }
    public function should_event_be_skipped(SyslogEvent $thisEvent, ?SyslogEvent $prevEvent, ?SyslogEvent $nextEvent) : bool
    {
        foreach($this->get_items() as $item){
            if($thisEvent->getFacility() === $item['facility'] && $thisEvent->getSysLogTag() === $item['tag'] && trim( $thisEvent->get_best_message() ) === $item['message'] ){
                return true;
            }
        }

        return false;
    }
}
