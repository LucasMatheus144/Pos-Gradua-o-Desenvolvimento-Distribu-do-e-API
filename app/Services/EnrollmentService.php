<?php

namespace App\Services;

use App\Resources\EnrollmentRepositoryInterface;
use App\Models\Enrollment;
use App\Services\SendEnrollmentConfirmationJob;


class EnrollmentService {
  public function __construct(private EnrollmentRepositoryInterface $repo){}
  public function enroll(int $studentId, int $courseId): Enrollment {
    $enrollment = $this->repo->enroll($studentId,$courseId);
    dispatch(new SendEnrollmentConfirmationJob($enrollment->id));
    return $enrollment;
  }
}