{{-- Home sẽ kế thừ viiew master --}}
@extends('layout.master')
{{-- section sẽ thay đổi phần yeild trong master --}}
@section('title', 'USER PAGE')
@section('content-title', 'USER PAGE')
@section('content')
<div>
    <a href="{{route('users.create')}}">
        <button class="btn btn-primary">Create</button>
    </a>
</div>
<table class="table table-hover">   
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>password</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Actions</th>    
    </thead>
    <tbody>
     @foreach ($users as $user)             
        <tr>
            <th>{{$user->id}}</th>
            <th>{{$user->name}}</th>
            <th>{{$user->email ?: 'N/A'}}</th>
            <th>{{$user->password ?: 'N/A'}}</th>          
            <th>{{$user->created_at ?: 'N/A'}}</th>
            <th>{{$user->updated_at ?: 'N/A'}}</th>  
            <th>
                <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning">
                    Edit
                </a>
                    <form
                    action="{{route('users.delete', $user->id)}}"
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
{{ $users->links() }}
@endsection