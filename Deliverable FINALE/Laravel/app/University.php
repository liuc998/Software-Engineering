<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
