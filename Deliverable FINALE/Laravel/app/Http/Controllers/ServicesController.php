<?php

namespace App\Http\Controllers;

use App\Http\Resources\Service as ServiceResource;
use App\Service;
use App\Http\Resources\Marker as MarkerResource;
use App\Marker;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index(){
        return response(ServiceResource::collection(Service::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexpoi($service){
            $search = Service::findOrFail($service);
            if ($search->category == 'Infrastructure') abort(404);
            Marker::where('services_id', $service)->firstOrFail();
            return response (MarkerResource::collection(Marker::where('services_id', $service)->get()), 200)
                ->header('Content-Type', 'application/json');
    }

    public function indexbuildings($service){
        $search = Service::findOrFail($service);
        if ($search->category != 'Infrastructure') abort(404);
        Marker::where('services_id', $service)->firstOrFail();
        return response (MarkerResource::collection(Marker::where('services_id', $service)->get()), 200)
            ->header('Content-Type', 'application/json');
    }

    //public function authindexpoi($service){}

    public function show($service){
        return response (new ServiceResource(Service::findOrFail($service)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function showpoi($service, $poi){
        $search = Marker::findOrFail($poi);
        if ($search->type == 'building') abort(404);
        if ($search->services_id==$service) {
            return response (new MarkerResource(Marker::findOrFail($poi)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function showbuilding($service, $building){
        $search = Marker::findOrFail($building);
        if ($search->type != 'building') abort(404);
        if ($search->services_id == $service) {
            return response (new MarkerResource(Marker::findOrFail($building)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'important' => 'nullable|boolean',
            'category' => 'required|string|max:40',
        ]);

        $data = new Service;

        $data->important = $request->important;
        $data->category = $request->category;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $service){
        $data = Service::findOrFail($service);

        $validatedData = $request->validate([
            'important' => 'nullable|boolean',
            'category' => 'nullable|string|max:40',
        ]);

        if ($request->has('important')) {
            $data->important = $request->important;
        };
        if ($request->has('category')) {
            $data->surname = $request->category;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function updatemarker(Request $request, $service, $marker){
        $search = Marker::findOrFail($marker);
        if ($search->services_id==$service) {
            $data = $search;

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
                if($request->type != 'building') {
                    $data->type = $request->type;
                }
                else abort(404);
            };
            if ($request->has('services_id')) {
                $services_id = $request->services_id;
                $search = Service::find($services_id);
                if ($search == null) abort(404);
                $data->services_id = $request->services_id;
            };

            if ($data->save()) return response (null, 200);
            else abort(500);
        }
        else abort(404);
    }

    public function destroy($service){
        Service::findOrFail($service);
        if (Service::destroy($service)) return response (null, 200);
        else abort (500);
    }

    public function destroymarker($service, $marker){
        $search = Marker::findOrFail($marker);
        if ($search->services_id==$service) {
            if (Marker::destroy($marker)) return response (null, 200);
            else abort (500);
        }
        else abort(404);
    }
}
