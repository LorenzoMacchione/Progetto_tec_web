<?php

namespace App\Models\Resources;

use Illuminate\Database\Eloquent\Model;

//Classe che definisce il mapping con la tabella delle faq del nostro database
class Faq extends Model {

    protected $table = 'faqs';
    protected $primaryKey = 'faqId';
    public $timestamps = false;

}
