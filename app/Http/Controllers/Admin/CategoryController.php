<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Models\M3Result;

class CategoryController extends Controller
{
    public function toCategory()
    {
        $categories=Category::all();
        foreach ($categories as $category) {
            if($category->parent_id !=0 && $category->parent_id !=null){
                $category->parent=Category::find($category->parent_id);
            }
        }
        return view('admin.category')->with('categories',$categories);
    }

    public function toCategoryAdd()
    {
        $categories=Category::where('parent_id',0)->get();
        return view('admin.category_add')->with('categories',$categories);
    }

    public function toCategoryEdit(Request $request)
    {
        $id=$request->input('id','');
        $category=Category::find($id);
        $categories=Category::where('parent_id',0)->get();
        return view('admin.category_edit')->with('category',$category)
                                            ->with('categories',$categories);
    }

    /**************************service********************************************/
    public function categoryAdd(Request $request)
    {
        $name=$request->input('name','');
        $category_no=$request->input('category_no','');
        $parent_id=$request->input('parent_id','');
        $preview=$request->input('preview','');
        $m3_result=new M3Result;
        if($name == '' || $category_no==''){
            $m3_result->status=1;
            $m3_result->message='名称或者序号不能为空';
            return $m3_result->toJson();
        }
        if($parent_id == ""){
            $m3_result->status=2;
            $m3_result->message='请选择父类别';
            return $m3_result->toJson();
        }
        // if($preview == ''){
        //     $m3_result->status=3;
        //     $m3_result->message='预览不能为空';
        //     return $m3_result->toJson();
        // }
        $category=new Category;
        $category->name=$name;
        $category->category_no=$category_no;
        $category->preview=$preview;
        if($parent_id !=''){
            $category->parent_id=$parent_id;
        }
        $category->save();

        $m3_result->status=0;
        $m3_result->message='添加成功';
        return $m3_result->toJson();
    }

    public function categoryDel(Request $request)
    {
        $id=$request->input('id','');
        $m3_result=new M3Result;
        if($id == ''){
            $m3_result->status=3;
            $m3_result->message='请选择要删除的类别';
            return $m3_result->toJson();
        }

        Category::where('id',$id)->delete();

        $m3_result->status=0;
        $m3_result->message='删除成功';
        return $m3_result->toJson();
    }

    public function categoryEdit(Request $request)
    {
        $id=$request->input('id','');
        $m3_result=new M3Result;
        if($id == ''){
            $m3_result->status=3;
            $m3_result->message='请选择要修改的类别';
            return $m3_result->toJson();
        }
        $category=Category::find($id);

        $name=$request->input('name','');
        $category_no=$request->input('category_no','');
        $parent_id=$request->input('parent_id','');
        $preview=$request->input('preview','');
        if($name == ''){
            $m3_result->status=3;
            $m3_result->message='名称不能为空';
            return $m3_result->toJson();
        }
        if($category_no == ''){
            $m3_result->status=3;
            $m3_result->message='类别序号不能为空';
            return $m3_result->toJson();
        }
        if($parent_id == ''){
            $m3_result->status=3;
            $m3_result->message='请选择父级类别';
            return $m3_result->toJson();
        }
        if($preview == ''){
            $m3_result->status=3;
            $m3_result->message='预览不能为空';
            return $m3_result->toJson();
        }
        $category->name=$name;
        $category->category_no=$category_no;
        $category->preview=$preview;
        if($parent_id != 0){
            $category->parent_id=$parent_id;
        }
        $category->save();

        $m3_result->status=0;
        $m3_result->message='修改成功';
        return $m3_result->toJson();
    }
}
