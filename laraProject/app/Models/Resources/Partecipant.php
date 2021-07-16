<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

//Classe che definisce il mapping con la tabella degli eventi del nostro database
class Partecipant extends Model {

    protected $table = 'partecipants';
    protected $primaryKey = 'partecipantId';
    public $timestamps = false;

}
