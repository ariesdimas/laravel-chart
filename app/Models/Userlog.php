<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model;

class Userlog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'userlogs';
}
