<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorySaldo extends Model
{
    protected $table = 'history_saldos';
    public $primarykey ='id';
    public $timestamps= true;

}
