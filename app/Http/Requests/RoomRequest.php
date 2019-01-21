<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
            return [
                    'image' => 'image|required',
                    'name' => 'string|required',
                    'accessibility' => 'integer|required',
                  ];
        
    }
    public function messages()
    {
        return [
            'image' =>'The file must be a picture',
            'name.required' => 'The name is required',
            'accessibility.required' => 'Choose a accessibility!!'
       ];
    }

    public function inputs(){
        $inputs = $this->except(['_token']);
        $inputs['uuid'] = str_random(24);

        if($this->hasFile('image')) {   
            $image = $this->file('image');
            $inputs['image'] = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/images'), $inputs['image']);
        }
        
        return $inputs;
    }
}