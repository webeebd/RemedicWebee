<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoGenerator extends Model {

    protected $table = 'no_generator';
    protected $fillable = ['no','type'];

}
