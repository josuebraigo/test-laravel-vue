<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;


class Wish extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $guarded = ['id'];

    // public function setImageAttribute($value) {
    //     if(array_key_exists('image', $this->attributes) || $value == $this->attributes['image']) {
    //         return ;
    //     }
    //     // Storage::disk('public')->put($value->getClientOriginalName(), $value);
        
    //     $this->attributes['image'] = '/' . $path;
    // }

}
