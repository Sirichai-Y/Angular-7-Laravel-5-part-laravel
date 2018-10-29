<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
// เพิ่ม Post model กับ Comment model เพื่อให้ง่ายต่อการเรียกใช้

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request) { // ฟังก์ชันสร้าง Post ส่วน Request $request คือ ข้อมูลที่มากับ request
        $validatedData = $request->validate([ // คำสั่ง validate คือคำสั่งตรวจข้อมูลตามเงื่อนไข
            'post' => 'required', // บรรทัดหมายความว่า ข้อมูลที่ชื่อ post ที่มากับ request เป็น required (คือต้องมี ห้าม null)
        ]);

        $post = Post::create([ // คำสั่ง create คือ สร้างและบันทึกข้อมูลลง table ที่เชื่อมต่อกับ model ของเรา
            'post_text' => $validatedData['post'], // บันทึกข้อมูลชื่อ post ที่ผ่านการ validate แล้วใน column ชื่อ post_text
        ]);

        return response()->json('Post created!'); // ส่งข้อความในรูปแบบ JSON
    }
    
    public function read(Request $request) { // ฟังก์ชันอ่าน Post ทั้งหมด
        $data = []; // ประกาศตัวแปรชื่อ data เป็น array

        $posts = Post::all(); // คำสั่ง all คือ เรียกข้อมูลทั้งหมดใน table ที่เชื่อมกับ model ของเรา
        foreach($posts as $post){ // คำสั่ง foreach เพื่อวนลูปโดย post มีค่าเท่ากับข้อมูลแต่ละตัวใน posts ในแต่ละรอบ
            $data[] = [ // ให้ข้อมูลแต่ละตัวมีค่าตามด้านล่าง
                'id' => $post->id, // ข้อมูลชื่อ id เท่ากับข้อมูล id ของ post
                'post' => $post->post_text, // ข้อมูลชื่อ post เท่ากับข้อมูล post_text ของ post
                'comment' => Comment::select('id','comment_text')->where('post_id', $post->id)->get()
                // ข้อมูลชื่อ comment เท่ากับ ข้อมูลที่เลือกเฉพาะ column ชื่อ id กับ comment_text 
                // และ มีข้อมูลใน column ชื่อ post_id เท่ากับข้อมูล id ของ post
                // คำสั่ง get คือเรียกข้อมูลจาก table ที่เชื่อมกับ model ของเรา
            ];
        }
 
        return response()->json($data); // ส่งข้อมูลชื่อ data ในรูปแบบ JSON
    }

    public function update(Request $request , $id) { 
        // ฟังก์ชันแก้ไข Post ส่วน Request $request คือ ข้อมูลที่มากับ request และ $id คือ ข้อมูลทาง url
        $validatedData = $request->validate([
            'post' => 'required',
        ]);

        $post = Post::where('id',$id)->update([
            // คำสั่ง update คือ แก้ไขและบันทึกข้อมูลลง table ที่เชื่อมต่อกับ model ของเรา
            // ส่วน where คือ เลือกข้อมูลที่มีข้อมูลใน column ชื่อ id ตรงกับ id ที่ส่งมาทาง url
            'post_text' => $validatedData['post']
        ]);

        return response()->json('Post edited!');
    }

    public function delete($id) { // ฟังก์ชันลบ Post ส่วน $id คือ ข้อมูลทาง url
        $post = Post::where('id',$id)->delete(); // คำสั่ง delete คือ ลบข้อมูลออกจาก table ที่เชื่อมต่อกับ model ของเรา
        $comment = Comment::where('post_id',$id)->delete(); 

        return response()->json('Post deleted!');
    }
}
