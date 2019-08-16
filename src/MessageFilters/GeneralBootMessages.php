<?php

namespace App\MessageFilters;

class GeneralBootMessages extends BaseRegExMessageFilter
{
    public function __construct()
    {
        parent::__construct('/^\[\s+\d+\.\d+\] [A-Za-z_]+\:\s.*$/');
    }

    public function apply_regex_callback(array $matches) : string
    {
        return 'General boot message';
    }
}


//[ 0.683589] ACPI: PCI Interrupt Link [LNKD] enabled at IRQ 11
