<?php
namespace App\Repositories\Eloquent;

use App\Models\Subject;
use App\Repositories\SubjectRepositoryInterface;

class SubjectEloquentRepository implements SubjectRepositoryInterface
{
    public function getAll()
    {
        return Subject::paginate(10);
    }

    public function getById($id)
    {
        return Subject::find($id);
    }

    public function create(array $data)
    {
        return Subject::create($data);
    }

    public function update($id, array $data)
    {
        $subject = Subject::find($id);
        if ($subject) {
            $subject->update($data);
        }
        return $subject;
    }

    public function delete($id)
    {
        return Subject::destroy($id);
    }
}