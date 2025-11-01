<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\StudentService;
use App\Resources\StudentResource;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;

class StudentController extends Controller{
    public function __construct(private StudentService $service)
    {
    }
    public function index()
    {
        return StudentResource::collection($this->service->list());
    }
    public function store(StoreStudentRequest $r)
    {
        $m = $this->service->create($r->validated());
        return (new StudentResource($m))->response()->setStatusCode(201);
    }
    public function show(int $id)
    {
        $m = $this->service->get($id) ?? abort(404);
        $m->load('courses');
        return new StudentResource($m);
    }
    public function update(UpdateStudentRequest $r, int $id)
    {
        $m = $this->service->update($id, $r->validated());
        return new StudentResource($m);
    }
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->noContent();
    }
}
