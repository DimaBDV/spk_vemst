<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\offerRequest;
use App\Traits\offerTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Users\BaseController as Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Repository\OfferRepository;

class OfferController extends Controller
{
//    FIXME: код с трейта раскидать по нормальным модулям, а не вот это вот всё
    use offerTrait;

    /**
     * OfferController constructor.
     */
    public function __construct()
    {
        $this->repository = app(OfferRepository::class);
        parent::__construct();
    }

    /**
     * Репозиторий Offer
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    private $repository;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offers = $this->repository->getAll(Auth::id());
        return response()->json($offers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('offer.main');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(offerRequest $request)
    {
        $this->checkSection($request);
        $status = $this->checkComplete();
        return response()->json($status['offer'], $status['code']);
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
