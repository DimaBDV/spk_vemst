<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer extends Model
{
    use SoftDeletes;


    protected $table = 'offer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'section',
        'theme',
        'mainText',
        'files',
        'description',
        'url',
        'complete',
        'deadline',
        'publishing',
        'user_id'
];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'deadline' => 'datetime',
        'publishing' => 'datetime',
        'complete' => 'bool'
    ];

    public function createTimeForHuman(){
        return $this->created_at = Carbon::parse($this->created_at)->diffForHumans();
    }
}
