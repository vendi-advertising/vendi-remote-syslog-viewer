<?php

namespace App\MessageFilters;

use App\Entity\SyslogEvent;

class NXDomainFilter extends BaseMessageFilter
{
    public function process_message(SyslogEvent $event): string
    {
        return 'NXDOMAIN Warning';
    }

    public function is_match(SyslogEvent $event): bool
    {
        return trim($event->getMessage()) === 'Server returned error NXDOMAIN, mitigating potential DNS violation DVE-2018-0001, retrying transaction with reduced feature level UDP.';
    }
}
