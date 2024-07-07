<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'blog_id',
        'media_type_id',
        'media_url',
    ];

    public function blog(){
        return $this->belongsTo(blog::class);
    }

    public function type(){
        return $this->belongsTo(MediaType::class,'media_type_id');
    }

    public function getURL(){
        return url('storage/'.$this->url);
    }

}
