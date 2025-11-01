<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest {
  public function authorize(): bool { return true; }
  public function rules(): array {
    return [
      'title' => 'required|string|min:3',
      'description' => 'nullable|string',
      'teacher_id' => 'required|exists:teachers,id'
    ];
  }
}

class UpdateCourseRequest extends FormRequest {
  public function authorize(): bool { return true; }
  public function rules(): array {
    return [
      'title' => 'sometimes|string|min:3',
      'description' => 'sometimes|nullable|string',
      'teacher_id' => 'sometimes|exists:teachers,id'
    ];
  }
}