<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'type'];
    public function tags()
    {
        return $this->belongsToMany(Tag::class, "post_tag", 'post_id', 'tag_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
 
