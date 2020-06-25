@extends('layouts.app')

@section('content')
<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row ">
            <div class="col-md-4 py-5 bg-dark text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                        <h2 class="py-3">{{ ucfirst(trans($role)) }} Profile Update</h2>
                        {{-- <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-8 py-5 border">
                <h4 class="pb-4">Please fill with your details</h4>
                <form method="POST" action="{{ route($route,$edit_user) }}" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="Name" class="text-info">{{ ucfirst(trans($role)) }} Name</label>
                            <input id="Full Name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $edit_user->name }}" autocomplete="name" placeholder="Full Name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group col-md-6">
                          <input id="inputEmail4" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $edit_user->email }}" autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="phone" class="text-info">{{ ucfirst(trans($role)) }} Mobile No.</label>
                            <input id="phone Mobile No." type="text" placeholder="Mobile No." class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $edit_user->phone }}" autocomplete="phone">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-9">
                            <label for="address" class="text-info">{{ ucfirst(trans($role)) }} Address</label>
                            <input id="address" placeholder="Adress" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $edit_user->address }}" autocomplete="address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                        <label for="image" class="text-info">{{ ucfirst(trans($role)) }} Image</label>
                        <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image"> 
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        @if($role === 'company' || $role ==='designer')
                            <div class="form-group col-md-12">
                                <label for="website" class="text-info">{{ ucfirst(trans($role)) }} Website</label>
                                <input id="website" name="website" placeholder="{{ ucfirst(trans($role)) }} Website" type="text" class="form-control @error('website') is-invalid @enderror" value="{{ old('website') ?? $edit_user->profile->website }}" autocomplete="website">
                                @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="about" class="text-info">About The {{ ucfirst(trans($role)) }}</label>
                                <textarea id="about" name="about" placeholder="About Your {{ ucfirst(trans($role)) }}" cols="40" rows="5" class="form-control @error('about') is-invalid @enderror" autocomplete="about">{{ old('about') ?? $edit_user->profile->about }}</textarea>
                                @error('about')
                                <span class="invalid-feedback" role="alert">    
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                                <label class="form-check-label" for="invalidCheck2">
                                <small>By clicking Submit, you agree to our Terms & Conditions, Visitor Agreement and Privacy Policy.</small>
                                </label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <button type="submit" class="btn btn-danger">{{ __('Update') }} {{ ucfirst(trans($role)) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
