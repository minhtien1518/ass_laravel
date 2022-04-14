<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // Eloquent
        // all: lay ra toan bo cac ban ghi
        // $products = Product::all();
        // get: lay ra toan bo cac ban ghi, ket hop dc cac dieu kien #
        // get se nam cuoi cung cua doan truy van
        // lay danh sach va kem ban ghi quan he
        // with() ngay trong cau truy van
        $productsGet = Product::select('*')
            // ->with('category', function ($query) {
            //     $query->select('id', 'name');
            // })
            ->orderBy('id', 'desc')
            ->paginate(10);
                // dd($productsGet);
        return view('product.index', ['products' => $productsGet]);
        // dd('Danh sach category', $categories, $categoriesGet);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // Tao ban ghi product moi
    public function create()
    {   
        $categories = Category::where('parent_id', 0)->with('chilldrentCate')->get();
        return view('product.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $product = new Product();
        $product->fill($request->all());
        $product->image_url = $this->storeImage($request);
        $product->save();
        return redirect(route('products.index'))->with('msg','Thêm mới thành công');
    }
    public function edit(Product $id){
        $categories = Category::where('parent_id', 0)->with('chilldrentCate')->get();
        return view('product.update', [
        'product' => $id,
        'categories' => $categories]);
        
    }

    public function update(ProductRequest $request, Product $id)
    {
        $cateUpdate = $id;
        $cateUpdate->name=$request->name;
        $cateUpdate->description =$request->description;
        $cateUpdate->price =$request->price;
        if ($request->hasFile('image_url')) {
            $cateUpdate->image_url =  $this->storeImage($request);
        }
        $cateUpdate->status =$request->status;
        $cateUpdate->save();
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Xoa 1 ban ghi product
    public function delete(Product $pro, $id)
    {
        
        $productDelete = Product::destroy($id);
        if ($productDelete) {
            return redirect()->route('products.index');
        }
        return redirect()->route('products.index');
        // dd($categoryDelete);

        // Cach 2: delete, tra ve true hoac false
        // $category = Category::find($id);
        // $category->delete();
    }

    protected function storeImage(Request $request) {
        $path = $request->file('image_url')->store('public/images');
        return substr($path, strlen('public/'));
    }
}