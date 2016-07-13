<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
