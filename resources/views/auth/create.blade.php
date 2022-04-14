@extends('layout.master')

@section('title', 'USER PAGE')

@section(
    'content-title',
    isset($user) ? 'USER Edit' : 'USER Create'
)

@section('content')
    <form 
    action="{{isset($user)
     ?route('users.update', $user->id)
     :route('users.store')}}"
     class="form" 
     method="POST"
>
     @if(isset($user))
        @method('PUT')
    @endif
        {{-- Bat buoc trong form se phai co token bang @csrf --}}
        @csrf
        @if($errors->any())
        <ul class="text-danger">
            @foreach($errors->all() as $error)
              <li>{{$error}}</li>
            @endforeach
        </ul>
        @endif
        <div class="form-group">
            <label for="name">Name</label>
            <input
                name="name"
                class="form-control"
                id="name"
                value="{{isset($user) ? $user->name : ''}}"
            />
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input
                name="email"
                class="form-control"
                id="email"
                value="{{isset($user) ? $user->email : ''}}"
            />
        </div>
        <div class="form-group">
            <label for="password">password</label>
            <input
                name="password"
                class="form-control"
                id="password"
                value="{{isset($user) ? $user->password : ''}}"
            />
            
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Sumit</button>
            <a href="{{route('users.index')}}" class="btn btn-warning">
                Cancel
            </a>
        </div>
    </form>

@endsection