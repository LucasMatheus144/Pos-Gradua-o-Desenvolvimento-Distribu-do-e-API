<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Course extends Model {
  use HasFactory;
  protected $fillable = ['title','description','teacher_id'];
  public function teacher(){ return $this->belongsTo(Teacher::class); }
  public function enrollments(){ return $this->hasMany(Enrollment::class); }
  public function students(){ return $this->belongsToMany(Student::class,'enrollments')->withTimestamps(); }
  public function sessions(){ return $this->hasMany(ClassSession::class); }
}