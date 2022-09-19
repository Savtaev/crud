<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\Input;

class PostController extends Controller
{
    public function editPost(Request $request){
        $post = Post::find($request['id']);
        if ($post->author_id != Auth::user()->id) die('Error');
        $post->title = $request['title'];
        $post->content = $request['content'];
        if ($request['image']){
            $post->image = $this->storeImage($request);
        }
        return $post->save();
    }
    public function delete(Request $request){
        $post = Post::find($request['id']);
        if ($post->author_id != Auth::user()->id) die('Error');
        return $post->delete();
    }
    public function __invoke(Request $request)
    {
        $posts = Post::with('comments', 'author')->orderBy('created_at', 'DESC')->get();

        return $posts->toArray();
    }
    public function create(Request $request)
    {
        $post = new Post();
        $post->author_id = Auth::user()->id;
        $post->title = $request['title'];
        $post->content = $request['content'];
        if ($request['image']){
            $post->image = $this->storeImage($request);
        }
        return $post->save();
    }
    public static function storeImage(Request $request)
    {
        $image_64 = $request['image'];
        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($image_64, 0, strpos($image_64, ',')+1);
        $image = str_replace($replace, '', $image_64);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10).'.'.$extension;
        Storage::disk('public')->put($imageName, base64_decode($image));
        return asset("storage/$imageName");
    }
}
