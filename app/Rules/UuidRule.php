<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Ramsey\Uuid\Uuid;

class UuidRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Uuid::isValid($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given UUID is not valid. Use v4.';
    }
}
