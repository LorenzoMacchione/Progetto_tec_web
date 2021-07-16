<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

//Classe che definisce il mapping con la tabella delle faq del nostro database
class User extends Model {

    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

}
