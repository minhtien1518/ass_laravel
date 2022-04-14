
@extends('layout.master')
@section('title', 'Category PAGE')
@section('content-title', 'Category PAGE')
@section('content')
<div>
    <a href="{{route('categories.create')}}">
        <button class="btn btn-primary">Create</button>
    </a>
</div>
<table class="table table-hover">   
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Mô Tả</th>
        <th>Danh mục cha</th>
        <th>Trạng Thái</th>
        <th>Created at</th>
        <th>Updated at</th>
        {{-- <th>Product</th>   --}}
        <th>Actions</th>    
    </thead>
    <tbody>
     @foreach ($categories as $category)             
        <tr>
            <th>{{$category->id}}</th>
            <th>{{$category->name}}</th>
            <th>{{$category->description ?: 'N/A'}}</th>  
            <th>{{isset($category->parentCategory) ? $category->parentCategory->name: 'N/A'}}</th>  
            <td>{{$category->status == 1 ? 'Active' : 'Deactive' }}</td>
            <th>{{$category->created_at ?: 'N/A'}}</th>
            <th>{{$category->updated_at ?: 'N/A'}}</th>  
            {{-- <td>{{$category->products_count }}</td> --}}
            <th>
                <a href="{{route('categories.edit', $category->id)}}" class="btn btn-warning">
                    Edit
                </a>
                    <form
                    action="{{route('categories.delete', $category->id)}}"
                    method="POST">
                    @method('DELETE')                  
                    @csrf                  
                    <button type="submit" class="btn btn-danger">
                        Delete
                    </button>
                </form>
                </th>       
        </tr>             
     @endforeach          
    </tbody>
</table>
{{-- {{ $users->links() }} --}}
@endsection