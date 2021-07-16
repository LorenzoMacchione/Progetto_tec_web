<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

//Classe che definisce il mapping con la tabella degli eventi del nostro database
class Ticket extends Model {

    protected $table = 'tickets';
    protected $primaryKey = 'ticketId';
    public $timestamps = false;

}
