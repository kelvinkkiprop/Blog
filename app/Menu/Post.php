<?php

namespace App\Menu;

use Illuminate\Database\Eloquent\Model;
//Add
use App\Other\PostCategory;
use App\Menu\PostComment;
use App\Menu\PostLike;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category', 'title', 'description', 'image',
    ];



    /**
    * Get Post Category
    */
    public function PostCategory() {
        return $this->hasOne(PostCategory::class, 'id', 'category');
    }


    /**
    * Get Post Comments
    */
    public function PostComments() {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }



    /**
    * Get Post Likes
    */
    public function PostLikes() {
        return $this->hasMany(PostLike::class, 'post_id', 'id')->where('status', 'Liked');
    }

    /**
    * Get Post DisLikes
    */
    public function PostDisLikes() {
        return $this->hasMany(PostLike::class, 'post_id', 'id')->where('status', 'Disliked');
    }

}
