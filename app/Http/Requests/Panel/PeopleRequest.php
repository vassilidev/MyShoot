<?php

namespace App\Http\Requests\Panel;

use App\Enums\GenderEnum;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PeopleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): true
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'role_id' => [
                'required',
                Rule::exists(Role::class, 'id'),
            ],
            'gender'  => [
                'nullable',
                Rule::in(array_column(GenderEnum::cases(), 'value')),
            ],
            'name'    => [
                'required',
                'string',
                'max:191',
            ],
            'surname' => [
                'required',
                'string',
                'max:191',
            ],
            'bip'     => [
                'nullable',
                'string',
                'max:191',
            ],
            'phone'   => [
                'nullable',
                'string',
                'max:191',
            ],
            'email'   => [
                'nullable',
                'string',
                'max:191',
            ],
        ];
    }
}
