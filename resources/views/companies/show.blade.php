@extends('layouts.app')

@section('content')
	{{$company->name}}
	{{$company->email}}
	{{$company->address}}
	<img class="img-fluid" src="{{asset('storage/'.$company->image)}}" alt="">
@endsection