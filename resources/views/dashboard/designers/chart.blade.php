@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Designer Likes Graph</h1>
    <div class="row">
            {!! $designerChart->container() !!}
    </div>
</div>

    {!! $designerChart->script() !!}
@endsection