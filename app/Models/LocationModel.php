<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class LocationModel extends Model
{
    use HasFactory;

    protected $table = 'locations';
    protected $fillable = ['name'];
    public $timestamps = false;

}
