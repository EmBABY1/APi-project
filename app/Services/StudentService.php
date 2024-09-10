<?php
namespace App\Services;

use App\Repositories\StudentRepositoryInterface;

class StudentService
{
    protected $repository;

    public function __construct(StudentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }
    public function get_student_subject()
    {
        return $this->repository->get_student_subject();
    }
    public function create_student_subject(array $data)
    {
        return $this->repository->create_student_subject($data);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}