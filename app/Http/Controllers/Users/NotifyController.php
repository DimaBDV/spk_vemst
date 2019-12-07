<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Jobs\DeleteNotificationJob;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotifyController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth' => 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**@var \App\User $user */
        $user = Auth::user();

        return response()->json([
            'allNotifications' => $user->notifications,
            'unreadNotifications' => $user->unreadNotifications
        ],200);
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
    public function update(Request $request)
    {
        $unread = $request->user()->unreadNotifications;

        foreach ($unread as $item){
            $uuid = $item->id;
            $delayTime = Carbon::now()->addDays(3);
            $job = ( new DeleteNotificationJob($uuid, $request->user()) )->delay($delayTime);
            $this->dispatch($job);
        }

        $unread->markAsRead();
        return response()->json(['status' => 'ok'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $uuid)
    {

        $job = ( new DeleteNotificationJob($uuid, $request->user()) );
        $this->dispatch($job);
        return response()->json(['status' => 'ok'], 200);
    }
}
