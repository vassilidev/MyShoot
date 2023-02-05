<?php

namespace App\Http\Requests\Panel;

use App\Models\Shooting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShootingRequest extends FormRequest
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
            'name'          => [
                'required',
                Rule::unique(Shooting::class)->ignore($this->shooting ?? ''),
                'max:191',
            ],
            'shooting_date' => [
                'required',
                'date',
            ],
            'nbr_people'    => [
                'required',
                'int',
                'min:0',
            ],
        ];
    }
}
