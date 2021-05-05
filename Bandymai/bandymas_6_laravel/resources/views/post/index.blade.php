@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6"><h1>Posts made by {{ $user->name }}</h1></div>
            
            <div class="col-md-6 d-flex justify-content-end" class="mb-0">
                <a href="/{{ $user->id }}/posts/create"><h1>Create Post</h1></a>
            </div>
        </div>

        @forelse($posts as $post)
        
        <div class="pt-5 border border-top-primary">

        </div>

        @empty

        <p class="border-top border-dark pt-3 mb-3">No posts currently created</p>

        @endforelse
    </div>
@endsection
