<?php

namespace App\Service;

use App\MessageFilters\DigitalOceanAgentNoiseFilter;
use App\MessageFilters\FirewallBlockFilter;
use App\MessageFilters\FsTabSwapWarningFilter;
use App\MessageFilters\GeneralBootMessages;
use App\MessageFilters\MySqlNote;
use App\MessageFilters\NXDomainFilter;

class MessageFilterService
{
    public function get_filters() : array
    {
        static $filters;
        if(!$filters){
            $filters = [
                new FirewallBlockFilter(),
                new MySqlNote(),
                new GeneralBootMessages(),
                new DigitalOceanAgentNoiseFilter(),
                new NXDomainFilter(),
                new FsTabSwapWarningFilter(),
            ];
        }

        return $filters;
    }

    public function apply_filters(array $events)
    {
        $filters = $this->get_filters();
        foreach($events as $event){
            foreach($filters as $filter) {

                if(!$filter->is_match($event)) {
                    continue;
                }

                $event->set_filtered_message($filter->process_message($event));
                break;
            }
        }
    }
}
