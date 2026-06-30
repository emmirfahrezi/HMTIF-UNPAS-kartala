<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'email'    => "required|email|max:255|unique:users,email,{$user->id}",
            'role'     => 'required|string|in:admin,bph,koordinator,staff',
            'staff_id' => 'nullable|exists:staffs,id',
        ];
    }
}
