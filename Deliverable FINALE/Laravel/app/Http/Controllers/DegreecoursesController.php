<?php

namespace App\Http\Controllers;

use App\Http\Resources\Degreecourse as DegreecourseResource;
use App\Degreecourse;
use App\Department;

use Illuminate\Http\Request;

class DegreecoursesController extends Controller
{
    public function index(){
        return response (DegreecourseResource::collection(Degreecourse::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function show($degreecourse){
        return response (new DegreecourseResource(Degreecourse::findOrFail($degreecourse)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'departments_id' => 'required|integer',
        ]);

        $data = new Degreecourse;

        $data->name = $request->name;
        $departments_id = $request->departments_id;
        Department::findOrFail($departments_id);
        $data->departments_id = $request->departments_id;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $degreecourse){
        $data = Degreecourse::findOrFail($degreecourse);

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:60',
            'departments_id' => 'nullable|integer',
        ]);

        if ($request->has('name')) {
            $data->name = $request->name;
        };
        if ($request->has('departments_id')) {
            $departments_id = $request->departments_id;
            Department::findOrFail($departments_id);
            $data->departments_id = $request->departments_id;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function destroy($degreecourse){
        Degreecourse::findOrFail($degreecourse);
        if (Degreecourse::destroy($degreecourse)) return response (null, 200);
        else abort (500);
    }
}
