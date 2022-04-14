{{-- Home se ke thua view master --}}
@extends('layout.master')

{{-- section se thay doi
    phan yield trong master
    voi ten tuong ung --}}
@section('title', 'Product page')

@section('content-title', 'Product page')

@section('content')
    <div>
        <a href="{{route('products.create')}}">
            <button class="btn btn-primary">Create</button>
        </a>
    </div>
    <table class="table table-hover">
        <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Image</th>
            
            <th>Price</th>
            <th>Status</th>
            <th>Category</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <th>{{$product->description ?: 'N/A'}}</th>    
                    <td><img src="{{ asset("storage/$product->image_url") }}" alt="{{ $product->image_url}}" width="100" ></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->status == 1 ? 'Active' : 'Deactive' }}</td>
                    <td>{{ $product->category_id}}</td>                   
                    
                    
                    <td>
                        <a
                            href="{{route('products.edit', $product->id)}}"
                            class="btn btn-warning"
                        >Edit</a>
                        <form
                            action="{{route('products.delete', $product->id)}}"
                            method="POST"
                        >
                            @method('DELETE')
                            {{-- <input type="text" name="_method" value="DELETE"> --}}
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{ $products->links() }} --}}
@endsection