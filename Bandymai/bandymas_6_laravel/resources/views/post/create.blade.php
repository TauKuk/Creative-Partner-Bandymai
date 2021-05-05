@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit post</h1>

        <div>
            <form action="/{{ $user->id }}/posts" method="post">

            <div class="form-group">
                <label for="title">Post`s title</label>
                <input type="text" title="title" class="form-control" autocomplete="off" placeholder="Enter the post`s title" style="width: 40%;">
                @error('title') <div class="error"><p>{{ $message }}</p></div> @enderror 
            </div>
            
            <div class="form-group">
                <label for="description">Post`s description</label>
                <input type="text" description="description" class="form-control" autocomplete="off" placeholder="Enter the post`s description" style="height:5em;">
                @error('description') <div class="error"><p>{{ $message }}</p></div> @enderror 
            </div>

            <div class="form-group">
                <label for="post_date">Post`s date</label>
                <input type="datetime" description="post_date" class="form-control" autocomplete="off">
                @error('post_date') <div class="error"><p>{{ $message }}</p></div> @enderror 
            </div>
            
            <!--
                <div class = "mb-2">
                    <label for="password">Password</label>
                    <input type="password" id="password" autocomplete="off" style="color: grey;">
                    @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
                </div>
                    
                <div class = "mb-2">
                    <label for="password">Confirm password</label>
                    <input type="password" id="confirm_password" autocomplete="off" style="color: grey;">
                    @error('email') <div class="error"><p>{{$message}}</p></div> @enderror
                </div>
            -->  
            @csrf
            <button class="btn btn-primary">Submit </button>

            </form>

            <form id="deleteForm" action="/users/{{ $user->id }}" method="post">

                @method('DELETE')
                @csrf
                
            </form>
        </div>
    </div>
@endsection
