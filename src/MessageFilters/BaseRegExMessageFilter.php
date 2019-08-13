<?php

namespace App\MessageFilters;

use App\Exceptions\GeneralVendiRemoteSyslogException;

abstract class BaseRegExMessageFilter implements MessageFilterInterface
{
    private $pattern;

    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    public function process_message(string $message) : string
    {
        return \preg_replace_callback(
            $this->pattern,
            [$this, 'apply_regex_callback'],
            $message
        );
    }

    abstract public function apply_regex_callback(array $matches) : string;

    public function is_match(string $message) : bool
    {
        $ret = \preg_match($this->pattern, $message);
        if(false === $ret){
            throw new GeneralVendiRemoteSyslogException(sprintf( 'Invalid regex: %1$s', $this->pattern));
        }

        return $ret ? true : false;

        //^\[\s*[\d\.]+\] \[UFW BLOCK\] IN=eth\d OUT= MAC=([a-f0-9:]{41}) SRC=([\d\.]+) DST=([\d\.]+).*?$
    }
}
//
