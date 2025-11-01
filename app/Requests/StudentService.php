<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest {
  public function authorize(): bool { return true; }
  public function rules(): array {
    return [
      'name' => 'required|string|min:3',
      'email' => 'required|email|unique:students,email',
      'birth_date' => 'nullable|date'
    ];
  }
}

class UpdateStudentRequest extends FormRequest {
  public function authorize(): bool { return true; }
  public function rules(): array {
    $id = $this->route('student');
    return [
      'name' => 'sometimes|string|min:3',
      'email' => "sometimes|email|unique:students,email,{$id}",
      'birth_date' => 'sometimes|date'
    ];
  }
}