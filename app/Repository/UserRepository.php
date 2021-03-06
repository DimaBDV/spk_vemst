<?php
/**
 * Пример реализации репозитория на основе базового класса Illuminate\Database\Eloquent\Model
 * User: Дмитрий Беликов
 * Date: 26.03.2019
 * Time: 13:16
 */

namespace App\Repository;

use App\User as Model;

class UserRepository extends CoreRepository
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить Все категории Мастера по его Id
     * @method getAll($userId)
     * @param int $userId
     * @return mixed
     */
    public function getAll( $userId )
    {
        $result = $this->startConditions()
            ->select(['id', 'category'])
            ->where('id', $userId)
            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Найти всех Администраторов
     * @return mixed
     */
    public function getAllAdmins(){
        $result = $this->startConditions()
            ->where('group', 'A')
//            ->toBase()
            ->get();

        return $result;
    }

    /**
     * Найти пользователя по Id
     * @param $id
     * @return Model
     */
    public function findUserById($id)
    {
        $result = $this->startConditions()
            ->where('id', $id)
//            ->toBase()
            ->get()
            ->first();

        return $result;
    }

}