<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    public function authorize(): bool{
        $credentials = $this->only(
            'data.email',
            'data.password'
        )['data'];
        return auth()
            ->claims(['csrf-token' => str_random(32)])
            ->attempt($credentials);
    }

    public function rules(): array{
        return [
          'email' => 'required',
          'password' => 'required'
        ];
    }
}
