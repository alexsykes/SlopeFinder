<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = ['site_id', 'user_id', 'note', 'type', 'completed', 'accepted'];

}
