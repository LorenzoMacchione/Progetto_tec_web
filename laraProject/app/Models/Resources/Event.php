<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

//Classe che definisce il mapping con la tabella degli eventi del nostro database
class Event extends Model {

    protected $table = 'events';
    protected $primaryKey = 'eventId';
    public $timestamps = false;

}
