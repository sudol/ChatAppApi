<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $timestamps = false;
    
    public function Messages()
    {
        return $this->hasMany(Messages::class);
    }
}
