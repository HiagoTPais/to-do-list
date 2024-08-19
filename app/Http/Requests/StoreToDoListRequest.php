<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreToDoListRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'task' => 'required',
            'description' => 'required',
            'due_date' => 'required|date'
        ];
    }

    public function messages(): array
    {
        return [
            'task.required' => "O nome da tarefa é obrigatorio",
            'description.required' => "A descrição da tarefa é obrigatoria",
            'due_date.required' => "A data de entrega da tarefa é obrigatoria",
            'due_date.date' => "A data de entrega não esta o formato correto"
        ];
    }
}
