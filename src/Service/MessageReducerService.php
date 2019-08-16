<?php

namespace App\Service;

use App\MessageReducers\StaticStringReducer;

class MessageReducerService
{
    public function get_reducers() : array
    {
        static $filters;
        if(!$filters){
            $filters = [
                new StaticStringReducer(),
            ];
        }

        return $filters;
    }

    public function apply_reducers(array $events) : array
    {
        $reducers = $this->get_reducers();
        $last = null;
        $next = null;

        $ret = [];

        for($i = 0; $i < count($events); $i++) {
            if($i !== 0){
                $last = $events[$i - 1];
            }

            if($i < count($events) - 1){
                $next = $events[$i + 1];
            }

            $current = $events[$i];

            $skip = false;

            foreach($reducers as $reducer){
                if($reducer->should_event_be_skipped($current, $last, $next)){
                    $skip = true;
                    break;
                }
            }

            if(!$skip){
                $ret[] = $current;
            }
        }

        return $ret;
    }
}
