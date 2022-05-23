<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
class PostController extends Controller
{

    public function index()
    {
        $data=Post::all();
        return view('admin.post.index',[
            'data'=>$data,
        ]);
    }


    public function create()
    {
        $cats=Category::all();
        return view('admin.post.add',['cats'=>$cats]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'detail'=>'required',
        ]);



        // Post Full Image
        if($request->hasFile('post_image')){
            $image2=$request->file('post_image');
            $reFullImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/full');
            $image2->move($dest2,$reFullImage);
        }else{
            $reFullImage='na';
        }

        $post=new Post;
        $post->cat_id=$request->category;
        $post->title=$request->title;
        $post->full_img=$reFullImage;
        $post->detail=$request->detail;
        $post->save();

        return redirect('admin/post/create')->with('success','Post eklendi');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $cats=Category::all();
        $data=Post::find($id);
        return view('admin.post.update',['cats'=>$cats,'data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'detail'=>'required',
        ]);

        // Post Full Image
        if($request->hasFile('post_image')){
            $image2=$request->file('post_image');
            $reFullImage=time().'.'.$image2->getClientOriginalExtension();
            $dest2=public_path('/imgs/full');
            $image2->move($dest2,$reFullImage);
        }else{
            $reFullImage=$request->post_image;
        }

        $post=Post::find($id);
        $post->cat_id=$request->category;
        $post->title=$request->title;
        $post->full_img=$reFullImage;
        $post->detail=$request->detail;
        $post->save();

        return redirect('admin/post/'.$id.'/edit')->with('success','Post Güncellendi');
    }


    public function destroy($id)
    {
        Post::where('id',$id)->delete();
        return redirect('admin/post');
    }
}
