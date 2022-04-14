@extends('layout.master')

@section('title', 'Product PAGE')

@section(
    'content-title',
    isset($product) ? 'Product Edit' : 'Product Create'
)

@section('content')
    <form 
    action="{{route('products.store')}}"
     class="form" 
     method="POST"
     enctype="multipart/form-data"
>
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value=""/>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" name="description" class="form-control"  value=""/>
        </div>
        <div class="form-group">
            <label for="image_url">Image</label>
            <input
                type="file"
                name="image_url"
                class="form-control"
                id="image_url"
            />
        </div>
        <div class="form-group">
            <label for="price">price</label>
            <input type="number" name="price" class="form-control"  value=""/>
        </div>
        <div class="form-group">
            <label for="category_id">Category</label>
            <select name="category_id"  class="form-control">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @if (count($category->chilldrentCate) > 0)
                        @foreach ($category->chilldrentCate as $cate)
                            <option value="{{ $cate->id }}"> &nbsp &nbsp &nbsp {{ $cate->name }}</option>
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="radio" 
                name="status" 
                id="status" 
                value="0">
            <label for="status">Deactive</label>
        </div>
        <div class="form-group">
            <input type="radio" 
                name="status" 
                id="status" 
                value="1"}>
            <label for="status">Active</label>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Sumit</button>
            <a href="{{route('products.index')}}" class="btn btn-warning">
                Cancel
            </a>
        </div>
    </form>

@endsection