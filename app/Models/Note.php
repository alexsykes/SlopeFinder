<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //
    protected $fillable = ['item_id', 'user_id', 'note', 'type', 'completed', 'accepted'];

    public function site() {
        return $this->belongsTo('App\Models\Site');
    }

}
