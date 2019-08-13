<?php

namespace App\MessageFilters;

class FirewallBlockFilter extends BaseRegExMessageFilter
{
    public function __construct()
    {
        parent::__construct('/^\[\s*[\d\.]+\] \[UFW BLOCK\] IN=eth\d OUT= MAC=([a-f0-9:]{41}) SRC=(?<SRC_IP>[\d\.]+) DST=([\d\.]+).*?DPT=(?<DST_PORT>[\d]+).*$/');
    }

    public function apply_regex_callback(array $matches) : string
    {
        return sprintf( 'Attack by %1$s on port %2$s', $matches['SRC_IP'], $matches['DST_PORT'] );
    }
}
