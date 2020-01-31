<?php

namespace App\Http\Controllers;

use App\Http\Resources\Department as DepartmentResource;
use App\Department;
use App\University;
use App\Http\Resources\Degreecourse as DegreecourseResource;
use App\Degreecourse;

use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index(){
        return response (DepartmentResource::collection(Department::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexbuildings($department){}

    public function indexteachers($department){}

    public function indexphotos($department, $building){}

    public function indexoffices($department, $teacher){}

    public function show($department){
        return response (new DepartmentResource(Department::findOrFail($department)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function showbuilding($department, $building){}

    public function showteacher($department, $teacher){}

    public function showphoto($department, $building, $photo){}

    public function showoffice($department, $teacher, $office){}

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'universities_id' => 'required|integer',
        ]);

        $data = new Department;

        $data->name = $request->name;
        $universities_id = $request->universities_id;
        University::findOrFail($universities_id);
        $data->universities_id = $request->universities_id;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $department){
        $data = Department::findOrFail($department);

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:50',
            'universities_id' => 'nullable|integer',
        ]);

        if ($request->has('name')) {
            $data->name = $request->name;
        };
        if ($request->has('universities_id')) {
            $universities_id = $request->universities_id;
            University::findOrFail($universities_id);
            $data->universities_id = $request->universities_id;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function updatebuilding($department, $building){}

    public function destroy($department){
        Department::findOrFail($department);
        if (Department::destroy($department)) return response (null, 200);
        else abort (500);
    }

    public function destroybuilding($department, $building){}
}
