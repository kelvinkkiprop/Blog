<?php

namespace App\Menu;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description',
    ];
}
