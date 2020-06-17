@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Likes Graph</h1>
    <div class="row">
        <div class="col-6">
            {!! $designsChart->container() !!}
        </div>
        <div class="col-6">
            {!! $designersChart->container() !!}
        </div>
    </div>
</div>

    {!! $designsChart->script() !!}
    {!! $designersChart->script() !!}
@endsection