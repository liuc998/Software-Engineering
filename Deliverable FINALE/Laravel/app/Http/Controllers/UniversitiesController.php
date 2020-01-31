<?php

namespace App\Http\Controllers;

use App\Http\Resources\University as UniversityResource;
use App\University;

use Illuminate\Http\Request;

class UniversitiesController extends Controller
{
    public function index(){
        return response (UniversityResource::collection(University::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function show($university){
        return response (new UniversityResource(University::findOrFail($university)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
        ]);

        $data = new University;

        $data->name = $request->name;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $university){
        $data = University::findOrFail($university);

        $validatedData = $request->validate([
            'name' => 'nullable|string|max:60',
        ]);

        if ($request->has('name')) {
            $data->name = $request->name;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function destroy($university){
        University::findOrFail($university);
        $result = University::destroy($university);
        if ($result) return response (null, 200);
        else abort (500);
    }
}
