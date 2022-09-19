<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PostController;

class CommentController extends Controller
{
    public function editComment(Request $request){
        $comment = Comment::find($request['id']);
        if ($comment->author_id != Auth::user()->id) die('Error');
        $comment->content = $request['content'];
        if ($request->image){
            $comment->image = PostController::storeImage($request);
        }
        return $comment->save();
    }
    public function delete(Request $request){
        $comment = Comment::find($request['id']);
        if ($comment->author_id != Auth::user()->id) die('Error');
        return $comment->delete();

    }
    public function __invoke()
    {
        //Comment::where('id')
    }
    public function createComment(Request $request){
        $comment = new Comment();
        $comment->content = $request['comment'];
        $comment->post_id = $request['post_id'];
        $comment->author_id = Auth::user()->id;
        if ($request->image){
            $comment->image = PostController::storeImage($request);
        }
        return $comment->save();
    }
}
