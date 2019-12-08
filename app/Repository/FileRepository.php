<?php
/**
 * Пример реализации репозитория на основе базового класса Illuminate\Database\Eloquent\Model
 * User: Дмитрий Беликов
 * Date: 26.03.2019
 * Time: 13:16
 */

namespace App\Repository;

use App\File as Model;
use App\Offer;

class FileRepository extends CoreRepository
{
    /**
     * @return mixed
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Получить файл по $id
     * @method getById($id)
     * @param Offer $offer
     * @return mixed
     */
    public function getById( $id )
    {
        $select = [
            'id',
            'name',
            'path',
            'mime_type'
        ];
        $result = $this->startConditions()
            ->select($select)
            ->where('id', $id)
            ->get()
            ->first();

        return $result;
    }

}