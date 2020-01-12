<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedungs';
    public $primaryKey = 'id';

    public function Admin(){
        return $this->belongsTo('App\Admin');
    }
    public function Operator(){
        return $this->hasOne('App\Operator');
    }
    public function slotparkir(){
        return $this->hasMany('App\SlotParkir');
    }
}
