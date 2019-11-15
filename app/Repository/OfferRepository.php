<?php
/**
 * Пример реализации репозитория на основе базового класса Illuminate\Database\Eloquent\Model
 * User: Дмитрий Беликов
 * Date: 26.03.2019
 * Time: 13:16
 */

namespace App\Repository;

use App\Offer as Model;
use Carbon\Carbon;

class OfferRepository extends CoreRepository
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
            ->where('user_id', $userId)
            ->orderBy('id', 'desc')
            ->toBase()
            ->get();

//        $result->each(function ($item, $key){
//            return $item->created_at = Carbon::parse($item->created_at)->diffForHumans();
//        });

        return $result;
    }

}