<?php

namespace App\Http\Requests\Channels;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateChannelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !is_null($this->user()->currentCompany);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('channels')
                    ->where('company_id', $this->user()->company_id),
            ],
        ];
    }
}
