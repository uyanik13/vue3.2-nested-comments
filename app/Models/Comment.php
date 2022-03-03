<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
//    protected $table = 'comments';
    protected $fillable = ['post_id', 'parent_id', 'sub_parent_id', 'name', 'comment'];

    public function replies() {
        return $this->hasMany(self::class, 'parent_id','id')
        ->with('sub_replies')
        ->whereNull('sub_parent_id')
        ->orderBy('created_at', 'desc');
    }
    public function sub_replies() {
        return $this->hasMany(self::class, 'sub_parent_id','id')
        ->orderBy('created_at', 'desc');
    }

}
