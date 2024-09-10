<?php
namespace App\Repositories\Eloquent;

use App\Models\School;
use App\Repositories\SchoolRepositoryInterface;

class SchoolEloquentRepository implements SchoolRepositoryInterface
{
    public function getAll()
    {
        return School::paginate(10);
    }

    public function getById($id)
    {
        return School::find($id);
    }

    public function create(array $data)
    {
        return School::create($data);
    }

    public function update($id, array $data)
    {
        $school = School::find($id);
        if ($school) {
            $school->update($data);
        }
        return $school;
    }

    public function delete($id)
    {
        return School::destroy($id);
    }
}