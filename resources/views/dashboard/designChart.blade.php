@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Likes Graph</h1>
    <div class="flex">
        <div class="w-1/2">
            {!! $designsChart->container() !!}
        </div>
        <div class="w-1/2">
            {!! $designersChart->container() !!}
        </div>
    </div>
</div>

    {!! $designsChart->script() !!}
    {!! $designersChart->script() !!}
@endsection