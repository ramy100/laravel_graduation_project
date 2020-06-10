@extends('layouts.app')

@section('content')	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					@csrf
					<span class="login100-form-title p-b-43">
						Login to continue
					</span>
					
					@if (session()->has("error"))
					<div class="alert alert-danger" role="alert">
						<strong>Failed </strong> {{session()->get("error")}}
					</div>
					@endif
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
					</div>
					
					@if($errors->any())
						<div class="alert alert-danger" role="alert">
							<strong>Failed </strong> {{$errors->first()}}
						</div>
					@endif
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
							<label class="label-checkbox100" for="ckb1">
								{{ __('Remember Me') }}
							</label>
						</div>

						<div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="txt1">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
						</div>
					</div>
			

					<div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            {{ __('Login') }}
                        </button>
                        
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						<span class="txt2">
							or sign up using
						</span>
					</div>

					<div class="login100-form-social flex-c-m">
						<a href="{{ route('social.oauth', 'facebook') }}" class="login100-form-social-item flex-c-m bg1 m-r-5">
							<i class="fa fa-facebook-f" aria-hidden="true"></i>
						</a>

						<a href="{{ route('social.oauth', 'google') }}" class="login100-form-social-item flex-c-m bg3 m-r-5">
							<i class="fa fa-google" aria-hidden="true"></i>
						</a>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>

@endsection
