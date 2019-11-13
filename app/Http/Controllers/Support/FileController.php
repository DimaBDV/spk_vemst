<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Support\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\File;
use Illuminate\Support\Str;

class FileController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /** Функция тестирования ответов с ошибками
     * @return \Illuminate\Http\JsonResponse
     */
    public function testResponseErrorMessage(){

        return response()->json([
            'errors' => 'Не удалось сохранить файл'
        ], 500);

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $this->testResponseErrorMessage();
//        FIXME: ГОВНОКОД!!!! ИСПРАВИТЬ ПОСЛЕ ПРОДА
//        Если при загрузке с файлом не произошло никаких проблем то продолжаем
        if($request->hasFile('file') && $request->file('file')->isValid() ){
            $user = Auth::user(); // Данные авторизованного пользователя

            $path = 'uploads/'. Str::slug($user->name. '-'. $user->fathers_name); // Путь сохранения файла

            $requestFile = $request->file('file'); // данные по файлу

            $path = $requestFile->store($path, 'public'); // сохранение файла

            $file = new File(); // новая модель файл
            $file->user_id = $user->id;
            $file->name = $requestFile->getClientOriginalName();
            $file->mime_type = $requestFile->getMimeType();
            $file->path = $path;

            if ($file->save()){
                return response()->json([
                    'path' => $path,
                    'type' => $requestFile->getMimeType(),
                    'link' => env('APP_URL') . Storage::url($path),
                    'id' => $file->id,
                ], 201);
            }
            else {
                return response()->json([
                    'errors' => [
                        'Не удалось сохранить файл'
                    ]
                ], 500);
            }
        }

        return response()->json([
            'errors'=>[
                $request->file('file')->getErrorMessage()
            ]
        ],422);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
