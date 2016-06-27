<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller{

    public function getBlogIndex(){
        $posts = Post::paginate(5);
        foreach ($posts as $post){
            $post->body = $this->shortenText($post->body, 20);
        }
        return view('frontend.blog.index', ['posts' => $posts]);
    }

    public function getSinglePost($post_id, $end='frontend'){
        return view($end.'.blog.single');
    }

    public function getCreatePost(){
        return view('admin.blog.create_post');
    }

    public function postCreatePost(Request $request){

        $this->validate($request, [
           'title' => 'required|max:120|unique:posts',
            'author' => 'required|max:120',
            'body' => 'required'
        ]);

        $post = new Post();
        $post->title = $request['title'];
        $post->author = $request['author'];
        $post->body = $request['body'];
        $post->save();

        return redirect()->route('admin.index')->with([
            'success' => 'Post successfully created!'
        ]);

    }

    private function shortenText($text, $word_count){
        if(str_word_count($text,0) > $word_count){
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$word_count]). '...';

        }
        return $text;
    }


}