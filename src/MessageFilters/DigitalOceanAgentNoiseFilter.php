<?php

namespace App\MessageFilters;

class DigitalOceanAgentNoiseFilter extends BaseRegExMessageFilter
{
    public function __construct()
    {
        parent::__construct('/^\s*\/home\/do-agent\/[^\s]+ failed to .*$/');
    }

    public function apply_regex_callback(array $matches) : string
    {
        return 'DigitalOcean Agent Noise';
    }
}
