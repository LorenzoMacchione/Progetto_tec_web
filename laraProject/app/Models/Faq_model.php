<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resources\Faq;

class Faq_model extends Model {
    
    //Funzione che prende tutte le faq e le restituisce
    public function getFaq() {
        $faq = Faq::all();
        return $faq;
    }
    
    //Metodo che restituisce la faq con un determinato id
    public function getFaqById (int $id) {
        $faq = Faq::where('faqId', $id);
        return $faq;
    }
}
