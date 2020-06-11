@extends('layouts.app')

@section('content')
<section class="testimonial py-5" id="testimonial">
    <div class="container">
        <div class="row " style="margin: 0 auto;width: 800px;">
            <div class="col-md-6 py-5 bg-dark text-white text-center ">
                <div class=" ">
                    <div class="card-body">
                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg" style="width:30%">
                        <h2 class="py-3"> Registration</h2>
                        <p>Tation argumentum et usu, dicit viderer evertitur te has. Eu dictas concludaturque usu, facete detracto patrioque an per, lucilius pertinacia eu vel.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 py-5 border">
                @if (session()->has("error"))
                <div class="alert alert-danger" role="alert">
                    <strong>Failed </strong> {{session()->get("error")}}
                </div>
                @endif
                <div class="text-center">
                        <a class="site-btn btn-register" href="{{ route('registeration.form','designer') }}">Sign Up As A Designer</a>
                    </div>
                <div class="text-center">
                    <a class="btn company btn-register " href="{{ route('registeration.form','company') }}">Sign Up As A Company</a>
                </div>
                <div class="text-center">
                    <a class="btn-register btn-dark" href="{{ route('registeration.form','user') }}">Sign Up As A User</a>
                    <p > Or sign up as a user using</p>
                    <div class="login100-form-social flex-c-m">
                        <a href="{{ route('social.oauth', 'facebook') }}" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>

                        <a href="{{ route('social.oauth', 'google') }}" class="login100-form-social-item flex-c-m bg3 m-r-5">
                            <i class="fa fa-google" aria-hidden="true"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
