<?php

namespace App\Service;

use App\MessageFilters\FirewallBlockFilter;

class MessageFilterService
{
    public function get_filters() : array
    {
        static $filters;
        if(!$filters){
            $filters = [
                new FirewallBlockFilter(),
            ];
        }

        return $filters;
    }

    public function apply_filters(array $events)
    {
        $filters = $this->get_filters();
        foreach($events as $event){
            foreach($filters as $filter) {
                if(!$filter->is_match($event->getMessage())) {
                    continue;
                }

                $event->set_filtered_message($filter->process_message($event->getMessage()));
                break;
            }
        }
    }
}