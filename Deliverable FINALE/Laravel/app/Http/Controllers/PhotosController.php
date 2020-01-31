<?php

namespace App\Http\Controllers;

use App\Http\Resources\Photo as PhotoResource;
use App\Photo;
use App\Http\Resources\Marker as MarkerResource;
use App\Marker;

use Illuminate\Http\Request;

class PhotosController extends Controller
{
    public function index(){
        return response (PhotoResource::collection(Photo::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function indexbuildings($photo){
        $search = Photo::findOrFail($photo);
        $building = $search->markers_id;
        return response (new MarkerResource(Marker::findOrFail($building)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function show($photo){
        return response (new PhotoResource(Photo::findOrFail($photo)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function showbuilding($photo, $building){
        $search = Photo::findOrFail($photo);
        $id = $search->markers_id;
        if ($id==$building) {
            return response (new MarkerResource(Marker::findOrFail($building)), 200)
                ->header('Content-Type', 'application/json');
        }
        else abort(404);
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'link' => 'required|string|max:255',
            'markers_id' => 'required|integer',
        ]);

        $data = new Photo;

        $data->link = $request->link;
        $buildings_id = $request->markers_id;
        Marker::findOrFail($buildings_id);
        $data->markers_id = $request->markers_id;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function destroy($photo){
        Photo::findOrFail($photo);
        if (Photo::destroy($photo)) return response (null, 200);
        else abort (500);
    }
}
