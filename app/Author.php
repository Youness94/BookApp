<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // use HasFactory;
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
