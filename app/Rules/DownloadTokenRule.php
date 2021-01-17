<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DownloadTokenRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        //需為零到九英文大小寫A-F還有6-10個字
        return preg_match('/^[0-9a-fA-f]{6,10}$/i', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The download key is invalided';
    }
}
