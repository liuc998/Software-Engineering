<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    protected $table = 'markers';

    protected $primaryKey = 'id';

    public $timestamps = false;
}
