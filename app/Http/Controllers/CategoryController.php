<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{

    public function index()
    {   
        $data=Category::all();
        return view('admin.category.index',[
            'data'=>$data,
            'title'=>'Tüm Kategoriler',
            'meta_desc'=>'Açıklama'
        ]);
    }

    public function create()
    {
        return view('admin.category.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);

        if($request->hasFile('cat_image')){
            $image=$request->file('cat_image');
            $reImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest,$reImage);
        }else{
            $reImage='na';
        }

        $category=new Category;
        $category->title=$request->title;
        $category->detail=$request->detail;
        $category->image=$reImage;
        $category->save();

        return redirect('admin/category/create')->with('success','Kategori eklendi');
    }

    public function edit($id)
    {
        $data=Category::find($id);
        return view('admin.category.update',['data'=>$data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required'
        ]);

        if($request->hasFile('cat_image')){
            $image=$request->file('cat_image');
            $reImage=time().'.'.$image->getClientOriginalExtension();
            $dest=public_path('/imgs');
            $image->move($dest,$reImage);
        }else{
            $reImage=$request->cat_image;
        }

        $category=Category::find($id);
        $category->title=$request->title;
        $category->detail=$request->detail;
        $category->image=$reImage;
        $category->save();

        return redirect('admin/category/'.$id.'/edit')->with('success','Kategori güncellendi');
    }

    public function destroy($id)
    {
        Category::where('id',$id)->delete();
        return redirect('admin/category');
    }
}
