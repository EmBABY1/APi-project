<?php
namespace App\Http\Controllers;

use App\Services\SchoolService;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    protected $service;

    public function __construct(SchoolService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json($this->service->getAll());
    }

    public function show($id)
    {
        return response()->json($this->service->getById($id));
    }

    public function store(Request $request)
    {

        return response()->json($this->service->create($request->all()));
    }

    public function update(Request $request, $id)
    {
        return response()->json($this->service->update($id, $request->all()));
    }

    public function destroy($id)
    {
        return response()->json($this->service->delete($id));
    }
}