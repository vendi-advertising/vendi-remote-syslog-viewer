<?php

namespace App\MessageFilters;

use App\Entity\SyslogEvent;
use App\Exceptions\GeneralVendiRemoteSyslogException;

abstract class BaseMessageFilter implements MessageFilterInterface
{
    final public function get_clean_message_string(SyslogEvent $event) : string
    {
        return trim( $event->getMessage() );
    }
}
