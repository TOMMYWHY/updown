<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Updown extends Model
{
    //
    protected $table='files';
    protected $fillable = [ 'id','email', 'location','files_name','verify_code'];
}
