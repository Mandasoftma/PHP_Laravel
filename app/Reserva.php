<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'Reservas';

    protected $fillable = [
        'Names','LastNames','NoPersonas','Butacas','User_id'
    ];

    public function user(){
        $this->belongsTo('App\User');
    }
}
