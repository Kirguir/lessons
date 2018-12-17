<?php

namespace work\model;

use PDO;

/**
 * Description of WorkStorage
 *
 * @author Aleksey Shutiy<a.shutiy@gmail.com>
 */
class WorkStorage extends Storage
{
    protected static $table = 'works';

    protected static $model = 'Work';

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
