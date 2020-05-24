<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'code'=> 'required|min:3|max:255|unique:categories,code',
            'name'=>'required|min:3|max:255',
            'description'=>'required|min:5|max:1000'
        ];

        if($this->route()->named('categories.update')){
            $rules['code'] .= ',' . $this->route()->parameter('category')->id;
        }
//        dd(get_class_methods($this->route()));

        return $rules;
    }

    public function messages()
    {
       return [
         'required'=>'Поле :attribute обязательно для заполнения',
           'code.min'=>'Поле код должно содержать не менее :min символа',
           'min'=>'минимальное количество символов :min',
           'max'=>'Максимальное число символов :max'
       ];
    }
}
