<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SlotParkir extends Model
{
    public function Gedung(){
        return $this->belongsTo('App\Gedung');
    }
}
