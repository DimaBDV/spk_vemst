<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\offerRequest;
use App\Jobs\OfferDeleteJob;
use App\Jobs\OfferRestoreJob;
use App\Offer;
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
     * @param offerRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(offerRequest $request)
    {
        $this->authorize('store', Offer::class);

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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $offer  = $this->repository->getOfferById($id);
        $this->authorize('update',$offer);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($id)
    {
        $offer  = $this->repository->getOfferById($id);

        $this->authorize('destroy',$offer);
        $this->dispatch(new OfferDeleteJob($offer));

        if( $offer->delete() ){
            return response()->json([
                'status' => 'Ok'
            ], 200);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => [
                    'Что-то пошло не так, или Вы ошиблись в ID'
                ]
            ], 409);
        }


    }


    /**
     * Restore the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore(Request $request, $id)
    {

        if (! $request->hasValidSignature()) {
            abort(401);
        }

        $offer  = $this->repository->getTrashedById($id);
        $this->authorize('restore', $offer);

        if( $offer->restore() ){
            $this->dispatch(new OfferRestoreJob($offer));
            return redirect('/');
        }
        else
        {
            return abort(409, 'Упс, что-то пошло не так.');
        }

    }

}
