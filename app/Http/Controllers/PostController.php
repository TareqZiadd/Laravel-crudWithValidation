<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;


class PostController extends Controller
{


public function index (){

$posts =Post::orderBy('id','desc')->paginate(8);


    return view('posts.index',['posts'=>$posts]);
}


public function create (){
    return view('posts.add');
}

public function edit ($id){
$post=Post::findOrFail($id);
return view('posts.edit',compact('post'));

}


public function destroy($id){

$obj=Post::findOrFail($id);
$obj->delete();
return back()->with('success','post is deleted');
}


public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|min:3',
        'description' => 'required|string|max:1500',
        'user_id' => 'required|exists:users,id',
    ]);

    $post = Post::findOrFail($id);
    $post->title = $request->title;
    $post->description = $request->description;
    $post->user_id = $request->user_id;
    $post->save();

    return redirect('posts')->with('success', 'Post updated successfully');
}



public function store(Request $request)
{

    $request->validate([
        'title' => 'required|string|min:3',
        'description' => 'required|string|max:1500',
        'user_id' => 'required|exists:users,id',
    ]);

    $obj = new Post();
    $obj->title=$request->title;
    $obj->description=$request->description;
    $obj->user_id=$request->user_id;
    $obj->save();
    return back()->with('success','Post Added Successfuly');

}






}
