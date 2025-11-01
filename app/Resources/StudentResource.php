<?php

namespace App\Resources;

use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;

interface StudentRepositoryInterface {
  public function paginate(int $perPage = 15);
  public function find(int $id): ?Student;
  public function create(array $data): Student;
  public function update(int $id, array $data): Student;
  public function delete(int $id): void;
}

class StudentRepository implements StudentRepositoryInterface {
  public function paginate(int $perPage = 15){ return Student::query()->paginate($perPage); }
  public function find(int $id): ?Student { return Student::find($id); }
  public function create(array $data): Student { return Student::create($data); }
  public function update(int $id, array $data): Student {
    $m = Student::findOrFail($id); $m->update($data); return $m;
  }
  public function delete(int $id): void { Student::findOrFail($id)->delete(); }
}


class StudentResource extends JsonResource {
  public function toArray($req){
    return [
      'id'=>$this->id,
      'name'=>$this->name,
      'email'=>$this->email,
      'birth_date'=>$this->birth_date?->toDateString(),
      'courses'=>$this->whenLoaded('courses', fn()=> $this->courses->pluck('id'))
    ];
  }
}