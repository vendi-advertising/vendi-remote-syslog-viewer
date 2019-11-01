<?php

namespace App\MessageFilters;

class FsTabSwapWarningFilter extends BaseRegExMessageFilter
{
    public const MESSAGE = 'Ignoring duplicate swapfile';

    public function __construct()
    {
        parent::__construct('/^\s*\[[\d\.]+\] systemd-fstab-generator\[\d+\]: Failed to create unit file \/run\/systemd\/generator\/swapfile\.swap, as it already exists. Duplicate entry in \/etc\/fstab\?$/');
    }

    public function apply_regex_callback(array $matches): string
    {
        return self::MESSAGE;
    }
}
