<?php

namespace App\Http\Controllers;

use App\Marker;
use App\Http\Resources\Office as OfficeResource;
use App\Office;
use App\Http\Resources\Teacher as TeacherResource;
use App\Teacher;

use Illuminate\Http\Request;

class OfficesController extends Controller
{
    public function index(){
        return response (OfficeResource::collection(Office::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexteachers($office){
        return response (TeacherResource::collection(Teacher::where('offices_id', $office)->get()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function show($office){
        return response (new OfficeResource(Office::findOrFail($office)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function showteacher($office, $teacher){
        $search = Teacher::findOrFail($teacher);
        if ($search->offices_id==$office) {
            return response (new TeacherResource(Teacher::findOrFail($teacher)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'floor' => 'required|string|max:10',
            'number' => 'required|string|max:10',
            'markers_id' => 'required|integer',
        ]);

        $data = new Office;

        $data->floor = $request->floor;
        $data->number = $request->number;
        $buildings_id = $request->markers_id;
        Marker::findOrFail($buildings_id);
        $data->markers_id = $request->markers_id;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $office){
        $data = Office::findOrFail($office);

        $validatedData = $request->validate([
            'floor' => 'nullable|string|max:10',
            'number' => 'nullable|string|max:10',
            'markers_id' => 'nullable|integer',
        ]);

        if ($request->has('floor')) {
            $data->floor = $request->floor;
        };
        if ($request->has('number')) {
            $data->number = $request->number;
        };
        if ($request->has('markers_id')) {
            $buildings_id = $request->markers_id;
            Marker::findOrFail($buildings_id);
            $data->markers_id = $request->markers_id;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function updateteacher(Request $request, $office, $teacher){
        $search = Teacher::findOrFail($teacher);
        if ($search->offices_id==$office) {
            $data = Teacher::findOrFail($teacher);

            $validatedData = $request->validate([
                'name' => 'nullable|string|max:30',
                'surname' => 'nullable|string|max:30',
                'offices_id' => 'nullable|integer',
            ]);

            if ($request->has('name')) {
                $data->name = $request->name;
            };
            if ($request->has('surname')) {
                $data->surname = $request->surname;
            };
            if ($request->has('offices_id')) {
                $offices_id = $request->offices_id;
                Office::findOrFail($offices_id);
                $data->offices_id = $request->offices_id;
            };

            if ($data->save()) return response (null, 200);
            else abort(500);
        }
        else abort(404);
    }

    public function destroy($office){
        Office::findOrFail($office);
        if (Office::destroy($office)) return response (null, 200);
        else abort (500);
    }
}
