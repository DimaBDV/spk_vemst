<?php

namespace App\Http\Controllers\Support;

use App\Http\Controllers\Support\BaseController as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request);
        $path = $request->file('file')->store('uploads', 'public');
        $type = $request->file('file')->getMimeType();
        $link = env('APP_URL') . Storage::url($path);
        $error = $request->file('file')->getError();
        if($error != 0){
            $error = $request->file('file')->getErrorMessage();
        }
        return response()->json([
            'path' => $path,
            'type' => $type,
            'link' => $link,
            'error' => $error ?? null
        ], 201);
//        if($request->hasFile('file')){
//            foreach ($request->file as $file) {
//
//                dd($file->isValid(), $request->text);
//            }
//        }
        //
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
