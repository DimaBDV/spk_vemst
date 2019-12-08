<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Jobs\OfferArchiveJob;
use App\Jobs\OfferCompleteJob;
use App\Repository\FileRepository;
use App\Repository\OfferRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{

    /**
     * Репозиторий оффер
     * @var \Illuminate\Contracts\Foundation\Application|mixed
     */
    protected $offerRepository;

    protected $fileRepository;

    public function __construct()
    {
        parent::__construct();
        $this->offerRepository = app(OfferRepository::class);
        $this->fileRepository = app(FileRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->checkToAdmin($request->user());

        $offer = $this->offerRepository->getAllForAdmin();
        return view('admin.index', compact('offer'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->checkToAdmin($request->user());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkToAdmin($request->user());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $this->checkToAdmin($request->user());
        $offer = $this->offerRepository->getOfferById($id);
        $fileId = $ids = explode(',', trim($offer->files, '[\]'));
        $file = collect();

        foreach ($fileId as $item){
            $file->push( $this->fileRepository->getById($item) );
        }

//        $deletedOffer = $this->offerRepository->getTrashedById($id);
        return view('admin.offerShow', compact(['offer', 'file']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $this->checkToAdmin($request->user());
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
        $this->checkToAdmin($request->user());

        $offer = $this->offerRepository->getOfferbyId($id);

        $offer->update(['complete' => true]);
        $offer->delete();

        $this->dispatch(new OfferCompleteJob($offer));

        return redirect(route('admin.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->checkToAdmin($request->user());

        $message = $request->get('description');
        $offer = $this->offerRepository->getOfferbyId($id);

        $offer->delete();

        $this->dispatch(new OfferArchiveJob($offer, $message));

        return redirect(route('admin.index'));
    }

    /**
     * FIXME: Исправить, и сделать норм проверку на админа!!!!
     * Проверка на админа КРИВОКОД ПИЗДА!!!!
     * @param $user
     */
    protected function checkToAdmin($user){
        if (!$user->isAdmin()){
            return abort(404);
        }
    }


   public function downloadFile($id){
        $file = $this->fileRepository->getById($id);
       return response()->download('storage/' . $file->path, $file->name);
   }
}
