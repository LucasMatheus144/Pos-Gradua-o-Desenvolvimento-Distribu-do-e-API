<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use App\Services\EnrollmentService;
use App\Resources\CourseResource;
// use App\Requests\CourseService;

class CourseController extends Controller {
  public function __construct(private CourseService $service, private EnrollmentService $enrollService) {}
  public function index(){ return CourseResource::collection($this->service->list()); }
  public function store(StoreCourseRequest $r){
    $m = $this->service->create($r->validated());
    return (new CourseResource($m->load('teacher')))->response()->setStatusCode(201);
  }
  public function show(int $id){
    $m = $this->service->get($id) ?? abort(404);
    $m->load(['teacher','sessions','students']);
    return new CourseResource($m);
  }
  public function update(UpdateCourseRequest $r, int $id){
    $m = $this->service->update($id,$r->validated());
    return new CourseResource($m->load('teacher'));
  }
  public function destroy(int $id){
    $this->service->delete($id);
    return response()->noContent();
  }

  public function enroll(Request $r, int $courseId){
    $data = $r->validate(['student_id'=>'required|exists:students,id']);
    $enrollment = $this->enrollService->enroll($data['student_id'],$courseId);
    return response()->json(['enrollment_id'=>$enrollment->id],201);
  }
}