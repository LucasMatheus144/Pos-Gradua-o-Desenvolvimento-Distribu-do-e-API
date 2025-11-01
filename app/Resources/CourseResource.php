<?php

namespace App\Resources;

use App\Models\Course;
use Illuminate\Http\Resources\Json\JsonResource;


interface CourseRepositoryInterface {
  public function paginate(int $perPage = 15);
  public function find(int $id): ?Course;
  public function create(array $data): Course;
  public function update(int $id, array $data): Course;
  public function delete(int $id): void;
}

class CourseRepository implements CourseRepositoryInterface {
  public function paginate(int $perPage = 15){ return Course::with('teacher')->paginate($perPage); }
  public function find(int $id): ?Course { return Course::with(['teacher','students','sessions'])->find($id); }
  public function create(array $data): Course { return Course::create($data); }
  public function update(int $id, array $data): Course {
    $m = Course::findOrFail($id); $m->update($data); return $m;
  }
  public function delete(int $id): void { Course::findOrFail($id)->delete(); }
}

class CourseResource extends JsonResource {
  public function toArray($req){
    return [
      'id'=>$this->id,
      'title'=>$this->title,
      'description'=>$this->description,
      'teacher'=> $this->whenLoaded('teacher', fn()=>[
         'id'=>$this->teacher->id,'name'=>$this->teacher->name
      ]),
      'students_count'=>$this->whenCounted('students'),
      'sessions'=>$this->whenLoaded('sessions', fn()=> $this->sessions->map(fn($s)=>[
        'id'=>$s->id,'starts_at'=>$s->starts_at,'ends_at'=>$s->ends_at,'room'=>$s->room
      ])),
    ];
  }
}