<?php

namespace work\model;

use PDO;

/**
 * Description of EducationStorage
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class EducationStorage extends Storage
{
    protected static $table = 'education';

    protected static $model = 'Education';

    /**
     *
     * @param \work\model\User $user
     * @return array
     */
    public function findByUser(User $user)
    {
        $sql = "SELECT * FROM " . static::$table . " WHERE user_id = ?";
        $stm = self::$db->prepare($sql);
        $stm->setFetchMode(PDO::FETCH_CLASS, __NAMESPACE__ . "\\" . static::$model);
        $stm->execute([$user->id]);
        $model = $stm->fetchAll(PDO::FETCH_CLASS);

        return $model;
    }
}
