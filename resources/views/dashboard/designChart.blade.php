@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Likes Graph</h1>
    <div class="row">
        <div class="col">
            {!! $designsChart->container() !!}
        </div>
        <div class="col">
            {!! $designersChart->container() !!}
        </div>
    </div>
</div>

    {!! $designsChart->script() !!}
    {!! $designersChart->script() !!}
@endsection