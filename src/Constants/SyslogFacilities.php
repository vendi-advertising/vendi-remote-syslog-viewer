<?php

namespace App\Constants;

use App\Exceptions\GeneralVendiRemoteSyslogException;

/**
 * From https://wiki.gentoo.org/wiki/Rsyslog#Facility
 */
final class SyslogFacilities
{

    public static function get_all() : array
    {
        static $numbers;
        if(!$numbers){
            $numbers = [
                0  => ['name' => 'kern',        'description' => 'kernel messages'],
                1  => ['name' => 'user',        'description' => 'user-level messages'],
                2  => ['name' => 'mail',        'description' => 'mail system'],
                3  => ['name' => 'daemon',      'description' => 'system daemons'],
                4  => ['name' => 'auth',        'description' => 'security/authorization messages'],
                5  => ['name' => 'syslog',      'description' => 'messages generated internally by syslogd'],
                6  => ['name' => 'lpr',         'description' => 'line printer subsystem'],
                7  => ['name' => 'news',        'description' => 'network news subsystem'],
                8  => ['name' => 'uucp',        'description' => 'UUCP subsystem'],
                9  => ['name' => 'cron',        'description' => 'clock daemon'],
                10 => ['name' => 'security',    'description' => 'security/authorization messages'],
                11 => ['name' => 'ftp',         'description' => 'FTP daemon'],
                12 => ['name' => 'ntp',         'description' => 'NTP subsystem'],
                13 => ['name' => 'logaudit',    'description' => 'log audit'],
                14 => ['name' => 'logalert',    'description' => 'log alert'],
                15 => ['name' => 'clock',       'description' => 'clock daemon (note 2)'],
                16 => ['name' => 'local0',      'description' => 'local use 0 (local0)'],
                17 => ['name' => 'local1',      'description' => 'local use 1 (local1)'],
                18 => ['name' => 'local2',      'description' => 'local use 2 (local2)'],
                19 => ['name' => 'local3',      'description' => 'local use 3 (local3)'],
                20 => ['name' => 'local4',      'description' => 'local use 4 (local4)'],
                21 => ['name' => 'local5',      'description' => 'local use 5 (local5)'],
                22 => ['name' => 'local6',      'description' => 'local use 6 (local6)'],
                23 => ['name' => 'local7',      'description' => 'local use 7 (local7)'],
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
            throw new GeneralVendiRemoteSyslogException(sprintf( 'Syslog facility number %1$d is not defined', $number));
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
