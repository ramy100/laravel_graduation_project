@extends('layouts.app')

@section('content')
	{{$company->name}}
	{{$company->email}}
	{{$company->address}}
	<img class="img-fluid" src="{{asset('storage/'.$company->image)}}" alt="">
	@forelse($company->company_designs as $design)
		{{$design->id}}
	@empty
		<div class="alert alert-danger">No Companies Yet!</div>
	@endforelse

@endsection