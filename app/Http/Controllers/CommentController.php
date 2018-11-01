<?php

namespace App\Http\Controllers;

use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{

    public function create(Request $request) {
        $validatedData = $request->validate([
            'comment_text' => 'required'
        ]);

        $comment = Comment::create([
            'comment_text' => $validatedData['comment_text'],
            'post_id' => $request->post_id

        ]);

        return response()->json(Comment::select('id','comment_text')->latest()->first());
    }

    public function update(Request $request , $id) {
        $validatedData = $request->validate([
            'comment_text' => 'required'
        ]);

        $comment = Comment::where('id',$id)->update([
            'comment_text' => $validatedData['comment_text'],
        ]);

        return response()->json($comment);
    }

    public function delete($id) {
        $comment = Comment::where('id',$id)->delete();

        return response()->json($comment);
    }
}