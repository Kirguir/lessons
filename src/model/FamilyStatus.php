<?php

namespace work\model;

/**
 * Description of FamilyStatus
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class FamilyStatus
{
    const F_STATUS_FREE = 1;
    const F_STATUS_MARRIED = 2;
    const F_STATUS_DIVORCEE = 3;

    public static function getStatuses($status = false)
    {
        $statuses = [
            self::F_STATUS_FREE => Lang::t('f_free'),
            self::F_STATUS_MARRIED => Lang::t('f_married'),
            self::F_STATUS_DIVORCEE => Lang::t('f_divorcee'),
        ];

        return $status ? $statuses[$status] : $statuses;
    }
}
