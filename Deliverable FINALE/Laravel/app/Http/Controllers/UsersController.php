<?php

namespace App\Http\Controllers;

use App\Http\Resources\User as UserResource;
use App\User;
use App\Degreecourse;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(){
        return response (UserResource::collection(User::paginate()), 200)
            ->header('Content-Type', 'application/json');
    }

    public function show($user){
        return response (new UserResource(User::findOrFail($user)), 200)
            ->header('Content-Type', 'application/json');
    }

    public function store(Request $request){

        $validatedData = $request->validate([
            'fiscalcode' => 'nullable|string|max:16',
            'name' => 'required|string|max:30',
            'surname' => 'nullable|string|max:30',
            'email' => 'required|string|unique:users|max:30',
            'password' => 'required|string|max:255',
            'adminpassword' => 'nullable|string|max:255',
            'degreecourse_id' => 'required|integer',
        ]);

        $data = new User;

        $data->fiscalcode = $request->fiscalcode;
        $data->name = $request->name;
        $data->surname = $request->surname;
        $data->email = $request->email;
        $password = $request->password;
        $data->password = Hash::make($password);
        $adminpassword = $request->adminpassword;
        $data->adminpassword = Hash::make($adminpassword);
        $degreecourses_id = $request->degreecourses_id;
        $search = Degreecourse::find($degreecourses_id);
        if ($search == null) abort(404);
        $data->degreecourses_id = $request->degreecourses_id;

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function update(Request $request, $user){
        $data = User::findOrFail($user);

        $validatedData = $request->validate([
            'fiscalcode' => 'nullable|string|max:16',
            'name' => 'nullable|string|max:30',
            'surname' => 'nullable|string|max:30',
            'email' => 'nullable|string|unique:users|max:30',
            'password' => 'nullable|string|max:255',
            'adminpassword' => 'nullable|string|max:255',
            'degreecourse_id' => 'nullable|integer',
        ]);

        if ($request->has('name')) {
            $data->name = $request->name;
        };
        if ($request->has('fiscalcode')) {
            $data->fiscalcode = $request->fiscalcode;
        };
        if ($request->has('surname')) {
            $data->surname = $request->surname;
        };
        if ($request->has('email')) {
            $data->email = $request->email;
        };
        if ($request->has('password')) {
            $password = $request->password;
            $data->password = Hash::make($password);
        };
        if ($request->has('adminpassword')) {
            $adminpassword = $request->adminpassword;
            $data->adminpassword = Hash::make($adminpassword);
        };
        if ($request->has('degreecourses_id')) {
            $degreecourses_id = $request->degreecourses_id;
            $search = Degreecourse::find($degreecourses_id);
            if ($search == null) abort(404);
            $data->degreecourses_id = $request->degreecourses_id;
        };

        if ($data->save()) return response (null, 200);
        else abort(500);
    }

    public function destroy($user){
        User::findOrFail($user);
        if (User::destroy($user)) return response (null, 200);
        else abort (500);
    }
}
