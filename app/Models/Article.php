<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory; 

    //protected $fillable =['title','body','excerpt'];  // all mass assignment for these fields 
    protected $guarded = [];  // or don't gaurd any field, allow mass assignment 

    public function user()
    {
        return $this->belongsTo(User::class);  // default key for belongsTo is user_id
    }

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');  // pass foreign key 'user_id'
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class) ;  // get all tages that belong to current article->id
    }

    
}
