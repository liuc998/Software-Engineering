<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdificiController extends Controller
{
    public function index(){}

    public function indexfoto(){}

    public function indexprofessori(){}

    public function show($edificio){}

    public function showfoto($edificio, $foto){}

    public function showprofessori($edificio, $professore){}

    public function store(){}

    public function update($edificio){}

    public function updateprofessori($edificio, $professore){}

    public function destroy($edificio){}

    public function destroyfoto($edificio, $foto){}

    public function destroyprofessori($edificio, $professore){}
}
