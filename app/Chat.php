<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $timestamps = false;

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class)->orderBy('id', 'desc');
    }

    public function user()
    {
        return $this->belongsTo(User::class)->select(['id', 'name']);
    }

    public function addMessage(Message $message)
    {
        return $this->messages()->save($message);
    }
}
