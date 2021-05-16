<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailInstitucion implements Rule
{
    public function __construct()
    {
        //
    }

    public function passes($attribute, $value)
    {
        //
        $regla = "/^[L]{1}[0-9]{8}(@acapulco.tecnm.mx)$/";
        return preg_match($regla, $value);
    }

    public function message()
    {
        return 'Deber ser un correo institucional o revisa que este escrito corretamente.';
    }
}
