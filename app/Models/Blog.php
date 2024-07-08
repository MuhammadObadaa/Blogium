<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $with = ['media'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'text',
        'media_type_id',
        'media_url',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function media(){
        return $this->hasMany(Media::class);
    }
}
