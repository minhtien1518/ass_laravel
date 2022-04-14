@extends('layout.master')

@section('title', 'Category page')

@section('content-title', 'Category Create')

@section('content')
<form class="form" method="POST" action="{{ route('categories.post-create') }}">
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
            <label for="description">Status</label>
            <select name="status"  class="form-control">
                <option value="0">Deactive</option>
                <option value="1">Active</option>
            </select>
        </div>
        <div class="form-group"> 
            <label for="description">Paren</label>
            <select name="parent_id"  class="form-control">
                @foreach($category as $cate)
                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Sumit</button>
        </div>
    </form>

@endsection