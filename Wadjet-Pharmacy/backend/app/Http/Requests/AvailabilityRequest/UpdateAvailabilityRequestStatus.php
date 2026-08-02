<?php

namespace App\Http\Requests\AvailabilityRequest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvailabilityRequestStatus extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => 'required|in:pending,fulfilled,cancelled',
        ];
    }
}
