<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    public function index()
    {      
        $categoriesGet = Category::select('*')
            ->with('parentCategory')
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('category.index', ['categories' => $categoriesGet]);
        
    }

    public function create()
    {
        $category = Category::where('parent_id', 0)->with('chilldrentCate')->get();
        return view('category.create',compact('category'));
    }

    public function store(Request $request)
    {
        $category = new Category();
        $category->fill($request->all());
        $category->save();
        return redirect(route('categories.index'))->with('msg','Thêm mới thành công');
    }
    public function edit(Category $id){
        $parentCate = Category::where('parent_id', 0)->with('chilldrentCate')->get();
        return view('category.update', [
        'category' => $id, 
        'parentCate' => $parentCate]);
        
    }
    public function update(CategoryRequest $request, Category $id)
    {
        $cateUpdate = $id;
        $cateUpdate->name=$request->name;
        $cateUpdate->description =$request->description;
        $cateUpdate->status =$request->status;
        $cateUpdate->save();
        return redirect()->route('categories.index');
    }
    public function delete(Category $cate) {
        if ($cate->delete()) {
            return redirect()->route('categories.index');
        }
        $categoryDelete = Category::destroy($cate);
        if ($categoryDelete !== 0) {
            return redirect()->route('categories.index');
        }
    }
}
