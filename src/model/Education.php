<?php

namespace work\model;

/**
 * Description of Education
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class Education extends Model
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
            'institut',
            'faculty',
            'e_start_date',
            'e_end_date',
        ];
    }
}
