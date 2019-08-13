<?php

namespace App\MessageFilters;

class MySqlNote extends BaseRegExMessageFilter
{
    public function __construct()
    {
        parent::__construct('/^\d+\s+[\d\:]+\s+\[Note\].*?$/');
    }

    public function apply_regex_callback(array $matches) : string
    {
        return 'MySql general message';
    }
}
