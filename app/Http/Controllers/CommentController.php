<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function create(Request $request) {
        $validatedData = $request->validate([
            'comment' => 'required'
        ]);

        $comment = Comment::create([
            'comment_text' => $validatedData['comment'],
            'post_id' => $request->post_id

        ]);

        return response()->json('Comment created!');
    }

    public function update(Request $request , $id) {
        $validatedData = $request->validate([
            'comment' => 'required'
        ]);

        $comment = Comment::where('id',$id)->update([
            'comment_text' => $validatedData['comment'],
        ]);

        return response()->json('Comment edited!');
    }

    public function delete($id) {
        $comment = Comment::where('id',$id)->delete();

        return response()->json('Comment deleted!');
    }
}