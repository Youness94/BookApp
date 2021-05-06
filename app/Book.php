<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function image()
    {
        return $this->hasOne(Image::class);
    }


    public function getImageIdAttribute($value)
    {

        $book_image = Image::find($value)->url;
        return $_ENV['APP_URL'] . "/storage/" . $book_image;
    }
    
    public function getImageAttribute($value)
    {

        return $_ENV['APP_URL'] . "/storage/" . $value;
    }
    public function getTitleAttribute($value)
    {

        return "Title is: " . $value;
    }
    public function setTitleAttribute($value)
    {

        $this->attributes['title'] = "hi " . $value;
    }
}
