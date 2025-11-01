<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSession extends Model {
  use HasFactory;
  protected $fillable = ['course_id','starts_at','ends_at','room'];
  public function course(){ return $this->belongsTo(Course::class); }
}