<?php

namespace App\Http\Controllers;

use App\Http\Resources\Marker as MarkerResource;
use App\Http\Resources\Service as ServiceResource;
use App\Service;
use App\Http\Resources\Photo as PhotoResource;
use App\Photo;
use App\Marker;

use Illuminate\Http\Request;

class MarkersController extends Controller
{
    public function search(Request $request){}

    public function index(){
        return response (MarkerResource::collection(Marker::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexpoi(){
        return response (MarkerResource::collection(Marker::where('type', '!=', 'building')->get()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexservices($marker){
        $search = Marker::findOrFail($marker);
        $service = $search->services_id;
        return response (new ServiceResource(Service::findOrFail($service)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexphotos($building){
        $search = Marker::findOrFail($building);
        if ($search->type == 'building') {
            Photo::where('markers_id', $building)->firstOrFail();
            return response (PhotoResource::collection(Photo::where('markers_id', $building)->get()), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function indexbuildings(){
        return response (MarkerResource::collection(Marker::where('type', 'building')->get()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexteachers($building){}

    public function indexdepartments($building){}

    public function show($marker){
        return response (new MarkerResource(Marker::findOrFail($marker)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function showphoto($building, $photo){
        $search = Marker::findOrFail($building);
        if ($search->type == 'building') {
            $search = Photo::findOrFail($photo);
            if ($search->markers_id == $building) {
                return response (new PhotoResource(Photo::findOrFail($photo)), 200)
                    ->header('Content-Type', 'application/json');
            } else abort(404);
        } else abort(404);
    }

    public function showpoi($poi){
        $search = Marker::findOrFail($poi);
        if ($search->type != 'building') {
            return response (new MarkerResource(Marker::findOrFail($poi)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function showbuilding($building){
        $search = Marker::findOrFail($building);
        if ($search->type == 'building') {
            return response (new MarkerResource(Marker::findOrFail($building)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function showservice($marker, $service){
        $search = Marker::findOrFail($marker);
        $id = $search->services_id;
        if ($service == $id) {
            return response (new ServiceResource(Service::findOrFail($service)), 200)
                ->header('Content-Type', 'application/json');
        } else abort(404);
    }

    public function showteacher($building, $teacher){}

    public function showdepartment($building, $department){}

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'address' => 'required|string|max:60',
            'lat' => 'required|float',
            'lng' => 'required|float',
            'type' => 'required|string|max:30',
            'services_id' => 'required|integer',
        ]);

        $data = new Marker;

        $data->name = $request->name;
        $data->address = $request->address;
        $data->lat = $request->lat;
        $data->lng = $request->lng;
        $data->type = $request->type;
        $services_id = $request->services_id;
        Service::findOrFail($services_id);
        $data->services_id = $request->services_id;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $marker){
        $data = Marker::findOrFail($marker);

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
            $data->type = $request->type;
        };
        if ($request->has('services_id')) {
            $services_id = $request->services_id;
            Service::findOrFail($services_id);
            $data->services_id = $request->services_id;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function updateservice(Request $request, $marker, $service){
        $search = Marker::findOrFail($marker);
        $id = $search->services_id;
        if ($service == $id) {
            $data = Service::findOrFail($service);

            $validatedData = $request->validate([
                'important' => 'nullable|boolean',
                'category' => 'nullable|string|max:40',
            ]);

            if ($request->has('important')) {
                $data->important = $request->important;
            };
            if ($request->has('category')) {
                $data->category = $request->category;
            };

            if ($data->save()) return response (null, 200);
            else abort(500);
        } else abort(404);
    }

    public function updateteacher($building, $teacher){}

    public function updatedepartment($building, $department){}

    public function destroy($marker){
        Marker::findOrFail($marker);
        if (Marker::destroy($marker)) return response (null, 200);
        else abort (500);
    }

    public function destroyphoto($building, $photo){
        $search = Marker::findOrFail($building);
        if ($search->type == 'infrastructure') {
            $search = Photo::findOrFail($photo);
            if ($search->markers_id == $building) {
                if (Photo::destroy($photo)) return response (null, 200);
                else abort (500);
            } else abort(404);
        }else abort(404);
    }

    public function destroyteacher($building, $teacher){}
}
