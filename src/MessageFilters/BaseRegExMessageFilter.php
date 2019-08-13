<?php

namespace App\MessageFilters;

use App\Entity\SyslogEvent;
use App\Exceptions\GeneralVendiRemoteSyslogException;

abstract class BaseRegExMessageFilter extends BaseMessageFilter
{
    private $pattern;

    abstract public function apply_regex_callback(array $matches) : string;

    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    public function process_message(SyslogEvent $event) : string
    {
        return \preg_replace_callback(
            $this->pattern,
            [$this, 'apply_regex_callback'],
            $this->get_clean_message_string($event)
        );
    }

    public function is_match(SyslogEvent $event) : bool
    {
        $ret = \preg_match($this->pattern, $this->get_clean_message_string($event));
        if(false === $ret){
            throw new GeneralVendiRemoteSyslogException(sprintf( 'Invalid regex: %1$s', $this->pattern));
        }

        return $ret ? true : false;
    }

    public function get_pattern() : string
    {
        return $this->pattern;
    }
}
