@extends('layouts.app')

@section('content')
    <div class="container">

        <div id="event_box" class="border border-dark">

            <div id="image">
                
            </div>

            <div id="info">
                <div id="title_date">
                    <div id="title">
                    {{ $event->title }} 
                    </div>
                    
                    <div id="date">{{ $event->start_date }} - {{ $event->end_date }}</div>
                </div>

                    
                <p id="description">{{ $event->description }}  </p>
            </div>
        </div>
    
        <a class="btn btn-primary mt-2" href="/{{ $user->id }}/events/{{ $event->id }}/edit">Change event info</a>
    </div>
@endsection
