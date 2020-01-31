<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degreecourse extends Model
{
    protected $table = 'degreecourses';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
