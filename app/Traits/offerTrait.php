<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий Беликов
 * Date: 13.11.2019
 * Time: 13:54
 */

namespace App\Traits;


use App\Offer;
use Illuminate\Http\Request;

trait offerTrait
{

    /**
     * Обработка потока, какие именно данные к нам пришли
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkSection(Request $request){
        if(
            ($request->get('section') === 'Новости') ||
            ($request->get('section') === 'Расписание') ||
            ($request->get('section') === 'Документы') ||
            ($request->get('section') === 'Другое')
        ){
            $this->saveOffer($request);
        }
        return response()->json(['error'=> 'Мы не смогли определить секцию'], 422);
    }

    /**
     * @param $request
     * @return bool
     */
    private function saveOffer( $request){
        $offer = new Offer();

        $offer->section = $request->get('section');
        $offer->theme = $request->get('theme');
        $offer->mainText = $request->get('mainText');
        $offer->files = json_decode( $request->get('files') );
        $offer->description = $request->get('description');
        $offer->url = $request->get('url');
        $offer->complete = false;
        $offer->deadline = null;
        $offer->user_id = $request->user()->id;

        if(!$offer->save()){
            $this->setStatus(false);
            $this->setError('Нам не удалось сохранить ваш запрос, информация об ошибке уже поступила администратору.');
        }
        else{
            $this->setOffer($offer);
            $this->setStatus(true);
            return true;
        }
        return abort(500, 'Что-то пошло не так, мы уже разбираемся с этим');
    }

    private $complete;

    private $status;
    private $offer;
    private $error;

    /**
     * Установка статуса
     * @param $status
     * @return mixed
     */
    private function setStatus($status){
        return $this->status = $status;
    }

    /**
     * Установка модели
     * @param $offer
     * @return mixed
     */
    private function setOffer(Offer $offer){
        return $this->offer = $offer;
    }

    /**
     * Установка статуса, используется для понимания всё ли ок (для контроллеар)
     * @param $errorMessage
     */
    private function setError($errorMessage){
        $this->error = $errorMessage;
    }

    /**
     * Используется в контроллере для понимания что ответить пользователю
     * @return array
     */
    public function checkComplete(){
        if($this->status){
            $offer = $this->offer;
            return [
                'message' => [
                    'id' => $offer->id,
                    'section' => $offer->section,
                    'theme' => $offer->theme
                ],
                'code' => 201
            ];
        }
        else{
            return[
                'message' => [$this->error],
                'code' => 500
            ];
        }
    }



}