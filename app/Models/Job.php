<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    // this line is added to link the job model to the table Jobs 
    // By default the model links to the table that is the plural of it's name
    protected $table = 'Jobs';
    // the fillable variable is used when calling the create method of a class
    protected $fillable = ['email','command','location_id','status'];

    protected $casts = [
        'email' => 'string',
        'command' => 'string',
        'location_id' => 'string',
        'status' => 'string'
    ];
}