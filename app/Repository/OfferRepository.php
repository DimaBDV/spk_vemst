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
     * Используется у пользователя для построения списка предложений
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

    /**
     * Получить модель Offer по id
     * @param $id
     * @return Model
     */
    public function getOfferById($id){

        $result = $this->startConditions()
            ->find($id);

        return $result;
    }

    /**
     * Поиск удалённой (архивной) записи по id
     * @param $id
     * @return mixed
     */
    public function getTrashedById($id){

        $result = $this->startConditions()
            ->withTrashed()
            ->where('id', $id)
            ->get()
            ->first();

        return $result;
    }

    /**
     * Поиск всех не выполненных предложений с подтяжкой данных пользователя
     * @return mixed
     */
    public function getAllForAdmin(){
        $offerColumns = [
            'id',
            'section',
            'theme',
            'description',
            'user_id'
        ];

        $result = $this->startConditions()
            ->select($offerColumns)
            ->orderBy('id', 'desc')
            ->with(['user:id,name,fathers_name,unit'])
            ->get();

        return $result;
    }

//    public function getOfferByIdToShowAdmin($id){
//        $result = $this->startConditions()
//            ->find($id);
//
//
//        return $result;
//    }

}