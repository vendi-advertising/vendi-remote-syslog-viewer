<?php

namespace App\MessageFilters;

interface MessageFilterInterface
{
    public function process_message(string $message) : string;

    public function is_match(string $message) : bool;
}