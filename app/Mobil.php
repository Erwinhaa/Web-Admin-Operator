<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = 'mobils';
    public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
