<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;

class DownloadFileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
    public function downloadFile($id){

        

        $fileName = "$id.jpg";
        
        if (Storage::disk('restrict_files')->missing($fileName)){
            return abort('404');
        }
        return Storage::disk('restrict_files')->download($fileName);   
         // return abort('401');
    }
}
