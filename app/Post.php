<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['post_text'];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    // ฟังก์ชัน comments จะเชื่อม post table กับ comment table เข้าด้วยกัน 
    // ทำให้ Post 1 post จะมีได้หลาย comment เป็นความสัมพันธ์แบบ 1-to-Many
}
