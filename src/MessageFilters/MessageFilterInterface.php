<?php

namespace App\MessageFilters;

use App\Entity\SyslogEvent;

interface MessageFilterInterface
{
    public function process_message(SyslogEvent $event) : string;

    public function is_match(SyslogEvent $event) : bool;

    public function get_clean_message_string(SyslogEvent $event) : string;
}
