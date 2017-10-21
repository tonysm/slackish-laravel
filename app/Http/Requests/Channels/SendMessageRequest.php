<?php

namespace App\Http\Requests\Channels;

use App\Rules\UuidRule;
use Illuminate\Foundation\Http\FormRequest;

class SendMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->currentChannel->is($this->route('channel'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|string|max:255',
            'uuid' => [
                'required',
                'string',
                new UuidRule(),
            ],
        ];
    }
}
