@extends('layout')

@section('content')

    <div class="container">
        <div class="content">
            <div class="title">Correctarium</div>
        </div>

        @foreach ($persons as $person)
          <li>{{ $person }}</li>
        @endforeach

    </div>

@stop
