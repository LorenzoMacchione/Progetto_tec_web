<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventCreateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'titolo' => 'required|max:25',
            'descrizione' => 'required|max:300',
            'immagine' => 'image',
            'programma' => 'required|max:300',
            'data' => 'required|date|after:now',
            'orario' => 'required',
            'regione' => 'required',
            'luogo' => 'required|max:60',
            'latitudine' => 'required',
            'longitudine' => 'required',
            'indicazioni' => 'required|max:500',
            'prezzo' => 'required|numeric|min:5|max:500',
            'biglietti' => 'required|numeric|min:50|max:1000000',
            'sconto' => 'nullable|required_with:inizio_sconto|numeric|min:10|max:90',
            'inizio_sconto' => 'nullable|required_with:sconto|date|after:now|before:data',
        ];
    }

}
