<?php

namespace App\Constants;

use App\Exceptions\GeneralVendiRemoteSyslogException;

/**
 * From https://wiki.gentoo.org/wiki/Rsyslog#Facility
 */
final class SyslogPriorities
{

    public static function get_all() : array
    {
        static $numbers;
        if(!$numbers){
            $numbers = [
                0 => ['name' => 'emerg',        'description' => 'system is unusable'],
                1 => ['name' => 'alert',        'description' => 'action must be taken immediately'],
                2 => ['name' => 'crit',         'description' => 'critical conditions'],
                3 => ['name' => 'error',        'description' => 'error conditions'],
                4 => ['name' => 'warning',      'description' => 'warning conditions'],
                5 => ['name' => 'notice',       'description' => 'normal but significant condition'],
                6 => ['name' => 'info',         'description' => 'informational messages'],
                7 => ['name' => 'debug',        'description' => 'debug-level messages'],
            ];
        }

        return $numbers;
    }

    protected static function get_by_number(string $key, int $number) : string
    {
        if(!in_array($key, ['name', 'description'])){
            throw new GeneralVendiRemoteSyslogException(sprintf( 'Syslog get_by_number key %1$s is not defined', $key));
        }

        $numbers = self::get_all();

        if(!array_key_exists($number, $numbers)){
            throw new GeneralVendiRemoteSyslogException(sprintf( 'Syslog priority number %1$d is not defined', $number));
        }

        return $numbers[$number][$key];
    }

    public static function get_name_by_number(int $number) : string
    {
        return self::get_by_number('name');

    }

    public static function get_description_by_number(int $number) : string
    {
        return self::get_by_number('description');
    }
}
