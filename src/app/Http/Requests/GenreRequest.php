<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenreRequest extends FormRequest
{

    	public function authorize(): bool
    	{
        	return true;
    	}

    	public function rules(): array
    	{
        	return [
            		'name' => 'required',
        	];
    	}

	public function messages()
    	{
        	return [
            		'required' => 'Lauks ":attribute" ir obligāts',
        	];
    	}

    	public function attributes()
    	{
        	return [
            	'name' => 'nosaukums',
        	];
    	}
}
