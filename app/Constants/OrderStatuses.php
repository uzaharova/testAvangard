<?php

namespace App\Constants;

class OrderStatuses
{
    public const NEW_STATUS = 0;
    public const VERIFY_STATUS = 10;
    public const DONE_STATUS = 20;

    public const ALL_STATUSES = [
        self::NEW_STATUS => 'новый',
        self::VERIFY_STATUS => 'подтвержден',
        self::DONE_STATUS => 'завершен'
    ];
}