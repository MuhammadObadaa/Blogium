<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $with = ['media','owners:name'];

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

    public function owners(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function media(){
        return $this->hasMany(Media::class);
    }

    public function ownedBy(User $user){
        return $this->owners()->where('user_id',$user->id)->exists();
    }
}
