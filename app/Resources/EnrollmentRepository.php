<?php

namespace App\Resources;

use App\Models\Enrollment;


interface EnrollmentRepositoryInterface {
  public function enroll(int $studentId, int $courseId): Enrollment;
}

class EnrollmentRepository implements EnrollmentRepositoryInterface {
  public function enroll(int $studentId, int $courseId): Enrollment {
    return Enrollment::firstOrCreate(['student_id'=>$studentId,'course_id'=>$courseId]);
  }
}