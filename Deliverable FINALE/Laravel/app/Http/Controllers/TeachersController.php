<?php

namespace App\Http\Controllers;

use App\Http\Resources\Teacher as TeacherResource;
use App\Teacher;
use App\Service;
use App\Http\Resources\Office as OfficeResource;
use App\Office;
use App\Http\Resources\Marker as MarkerResource;
use App\Marker;

use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index(){
        return response (TeacherResource::collection(Teacher::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexoffices($teacher){
        $search = Teacher::findOrFail($teacher);
        $office = $search->offices_id;
        return response (new OfficeResource(Office::findOrFail($office)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexdepartments($teacher){}

    public function indexbuildings($teacher){
        $search = Teacher::findOrFail($teacher);
        $id = $search->offices_id;
        $office = Office::findOrFail($id);
        $building = $office->markers_id;
        return response (new MarkerResource(Marker::findOrFail($building)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function show($teacher){
        return response (new TeacherResource(Teacher::findOrFail($teacher)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function showdepartment($teacher, $department){}

    public function showoffice($teacher, $office){
        $search = Teacher::findOrFail($teacher);
        $id = $search->offices_id;
        if ($id==$office) {
            return response (new OfficeResource(Office::findOrFail($office)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function showbuilding($teacher, $building){
        $search = Teacher::findOrFail($teacher);
        $id = $search->offices_id;
        $office = Office::findOrFail($id);
        $id = $office->markers_id;
        if ($id==$building) {
            return response (new MarkerResource(Marker::findOrFail($building)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:30',
            'offices_id' => 'required|integer',
        ]);

        $data = new Teacher;

        $data->name = $request->name;
        $data->surname = $request->surname;
        $offices_id = $request->offices_id;
        $search = Office::find($offices_id);
        if ($search == null) abort(400);
        $data->offices_id = $request->offices_id;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $teacher){
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
            $search = Office::find($offices_id);
            if ($search == null) abort(404);
            $data->offices_id = $request->offices_id;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function updateoffice(Request $request, $teacher, $office){
        $search = Teacher::findOrFail($teacher);
        $id = $search->offices_id;
        if ($id == $office) {
            $data = Office::findOrFail($office);

            $validatedData = $request->validate([
                'floor' => 'nullable|string|max:10',
                'number' => 'nullable|string|max:10',
                'buildings_id' => 'nullable|integer',
            ]);

            if ($request->has('floor')) {
                $data->floor = $request->floor;
            };
            if ($request->has('number')) {
                $data->number = $request->number;
            };
            if ($request->has('buildings_id')) {
                $buildings_id = $request->buildings_id;
                $search = Building::find($buildings_id);
                if ($search == null) abort(404);
                $data->buildings_id = $request->buildings_id;
            };

            if ($data->save()) return response (null, 200);
            else abort(500);
        }
        else abort(404);
    }

    public function updatebuilding(Request $request, $teacher, $building){
        $search = Teacher::findOrFail($teacher);
        $id = $search->offices_id;
        $office = Office::findOrFail($id);
        $id = $office->markers_id;
        if ($id==$building) {
            $data = Marker::findOrFail($building);

            $validatedData = $request->validate([
                'name' => 'nullable|string|max:60',
                'address' => 'nullable|string|max:60',
                'lat' => 'nullable|float',
                'lng' => 'nullable|float',
                'type' => 'nullable|string|max:30',
                'services_id' => 'nullable|integer',
            ]);

            if ($request->has('name')) {
                $data->name = $request->name;
            };
            if ($request->has('address')) {
                $data->address = $request->address;
            };
            if ($request->has('lat')) {
                $data->lat = $request->lat;
            };
            if ($request->has('lng')) {
                $data->lng = $request->lng;
            };
            if ($request->has('type')) {
                if($request->type != 'infrastructure') abort(404);
            };
            if ($request->has('services_id')) {
                $id = $request->services_id;
                $search = Service::findOrFail($id);
                if($search->category != 'infrastructure') abort(404);
                $data->services_id = $request->services_id;
            };

            if ($data->save()) return response (null, 200);
            else abort(500);
        }
        else abort (404);
    }

    public function destroy($teacher){
        Teacher::findOrFail($teacher);
        $result = Teacher::destroy($teacher);
        if ($result) return response (null, 200);
        else abort (500);
    }

    public function destroyoffice($teacher, $office){
        $search = Teacher::findOrFail($teacher);
        $id = $search->offices_id;
        if ($id==$office) {
            Office::findOrFail($office);
            $result = Office::destroy($office);
            if ($result) return response (null, 200);
            else abort (500);
        }
        else abort(404);
    }
}
