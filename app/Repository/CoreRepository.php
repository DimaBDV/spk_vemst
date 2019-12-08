<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий Беликов
 * Date: 26.03.2019
 * Time: 13:07
 */

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

abstract class CoreRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Служит для создания обьекта репозитория
     * CoreRepository constructor.
     */
    public function __construct()
    {
//        TODO: Требуется сделать из этого singleton
        $this->model = app($this->getModelClass());
    }

    /**
     * @return mixed
     */
    abstract protected function getModelClass();

    /**
     * @return Model | \Illuminate\Contracts\Foundation\Application|Model|mixed
     */
    protected function startConditions()
    {
        return clone $this->model;
    }
}