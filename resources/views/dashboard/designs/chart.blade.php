@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Design Likes Graph</h1>
    <div class="row">
            {!! $designChart->container() !!}
    </div>
</div>

    {!! $designChart->script() !!}
@endsection