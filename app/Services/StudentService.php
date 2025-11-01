<?php

namespace App\Services;

use App\Resources\StudentRepositoryInterface;

class StudentService {
  public function __construct(private StudentRepositoryInterface $repo){}
  public function list(int $perPage = 15){ return $this->repo->paginate($perPage); }
  public function get(int $id){ return $this->repo->find($id); }
  public function create(array $data){ return $this->repo->create($data); }
  public function update(int $id, array $data){ return $this->repo->update($id,$data); }
  public function delete(int $id){ $this->repo->delete($id); }
}