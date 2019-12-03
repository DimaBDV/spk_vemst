<?php
/**
 * Created by PhpStorm.
 * User: Дмитрий Беликов
 * Date: 13.11.2019
 * Time: 13:54
 */

namespace App\Traits;

use App\Jobs\NewOfferJob;
use App\Notifications\NewOfferNotification;
use App\Offer;
use App\Repository\UserRepository;
use Carbon\Carbon;
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
        $this->user = $request->user();

        $offer->section = $request->get('section');
        $offer->theme = $request->get('theme');
        $offer->mainText = $request->get('mainText');
        $offer->files = $request->get('files');
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
     * Сендер
     * @var \App\User
     */
    private $user;

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
            $this->fireNotify();
            return [
                'message' => [
                    'id' => $offer->id,
                    'section' => $offer->section,
                    'theme' => $offer->theme
                ],
                'code' => 201,
                'offer' => $offer
            ];
        }
        else{
            return[
                'message' => [$this->error],
                'code' => 500
            ];
        }
    }

    /**
     * Создаёт новое уведомление
     */
    public function fireNotify(){
//        FIXME: swiftMailer даёт сбой, а так же надо какой-то обработчик ошибок сюда заебенить
        $admins = app(UserRepository::class);
        $admins = $admins->getAllAdmins();
//        $this->dispatch(new NewOfferJob($this->user, $this->offer));
        $admins->each(function ($item, $key){
            return $item->notify(new NewOfferNotification($this->offer));
        });
//        $this->dispatch(new SendEmailNewOffer($this->user, $this->offer));
    }


}