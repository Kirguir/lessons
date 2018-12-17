<?php

namespace work\model;

/**
 * Description of Work
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 *
 * @property int $id
 * @property int $user_id
 * @property string $company
 * @property string $position
 * @property string $w_start_date
 * @property string $w_end_date
 */
class Work extends Model
{
    /**
     * Return name attributes of Work
     * @return array
     */
    public function fields()
    {
        return [
            'id',
            'user_id',
            'company',
            'position',
            'w_start_date',
            'w_end_date',
        ];
    }
}
