<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class SendEnrollmentConfirmationJob implements ShouldQueue {
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
  public function __construct(public int $enrollmentId) {}
  public function handle(): void {
    $enr = Enrollment::with(['student','course'])->find($this->enrollmentId);
    if(!$enr) return;
    // Exemplo: log (ou Mail::to($enr->student->email)->send(...))
    \Log::info("Matrícula confirmada", [
      'student'=>$enr->student->email,
      'course'=>$enr->course->title,
      'enrolled_at'=>$enr->enrolled_at,
    ]);
  }
}