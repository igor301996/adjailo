<?php

namespace App\Http\Requests\Message;

use App\Application;
use Illuminate\Foundation\Http\FormRequest;

class StoreMessage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $application = $this->route('application');

        return $application && $application->status !== Application::CLOSED;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|max:1000',
        ];
    }
}
