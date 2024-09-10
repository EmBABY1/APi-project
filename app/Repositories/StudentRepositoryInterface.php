<?php
namespace App\Repositories;

interface StudentRepositoryInterface
{
    public function getAll();
    public function get_student_subject();
    public function create_student_subject(array $data);
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}