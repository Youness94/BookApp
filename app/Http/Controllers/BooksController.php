<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Cache\NullStore;
use Illuminate\Http\Request;
use App\Author;
use App\Image;

class BooksController extends Controller
{
    //
    function getBooksById($id){
        
        return  preg_match("/^[0-9]+$/", $id) ? Book::find($id) : Book::where("title",$id)->get();
    }
    function index()
    {
        return Book::all();
    }

    // function getById($id){
    //     return Book::find($id);
    // }
    function searchBook($word){
        return Book::where("title","like","%".$word."%")->get();
    }
    function add (Request $req){
        $book_image = new Image;
        
        $book_image->url = explode("/", $req->file('image')->store('public'))[1];
        $result_img = $book_image->save();

        if ($result_img) {
            $book = new Book;
            $img = Image::where("url", explode("/", $req->file('image')->store('public'))[1])->get()[0]->id;
            $book->image_id = $img;
            $author = Author::find(1);
            $book->author()->associate($author);
            $book->title = $req->title;
            $book->description = $req->description;
            $result = $book->save();

            if ($result) {
                return ["result" => "book has been created successfuly"];
            } else {
                return ["result" => "book not updated"];
            }
        } else {
            return ["result" => "book not updated Img error"];
        }
    }
    function update (Request $req, $id){
        $book =  Book::find($id);
        $book->title=$req->title;
        $book->description=$req->description;
        
        if ($req->image) {
            $img_url_list = explode("/", $book->image_id);
            $img =  Image::where('url', $img_url_list[sizeof($img_url_list) - 1])->get()[0];
            $img->url = explode("/", $req->file('image')->store('public'))[1];
           $img->save();
        }

        $result=$book->save();
        if($result){
            return ["result"=>"book has been updated successfuly"];
        }
        else{
            return ["result"=>"book not updated"];
        }
    }

    function delete ($id){
        $book =  Book::find($id);

        $result=$book->delete();
        if($result){
            return ["result"=>"book has been deleted successfuly"];
        }
        else{
            return ["result"=>"book not deleted"];
        }
    }

    function getAuthor($id)
    {

        return Book::find($id)->author;
        
    }

}
