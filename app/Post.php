<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    //protected $slugKeyName = 'alternate';

    /**
     * Sluggable configuration.
     *
     * @var array
     */
    public function sluggable() {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    protected $fillable = [
        'user_id', 'category_id', 'photo_id', 'title', 'body'
    ];

    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function photo ()
    {
        //return $this->hasOne('App\Photo'); // Edwin said that a post has one photo but used the function belongsTo, check if it works or change it.
        return $this->belongsTo('App\Photo');
    }

    public function category ()
    {
        //return $this->hasOne('App\Photo'); // Edwin said that a post has one category but used the function belongsTo, check if it works or change it.
        return $this->belongsTo('App\Category');
    }

    public function comments ()
    {
        return $this->hasMany('App\Comment');
    }
}
