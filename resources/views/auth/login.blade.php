@extends('partials.layout')
@push('styles')
	<title>Login | Expense Manager</title>
    <link rel="stylesheet" type="text/css" href="/css/app.css"> 
    <link rel="stylesheet" type="text/css" href="/css/login.css"> 
@endpush


@section('content')
	<div class="container login-container">
		<div class="wrapper">
			<div class="w-50 col1">
				<img src="/images/expense.png" class="login-img">
			</div>
			<div class="w-50 col2">
				<div class="card">
                   	<div class="card-body">
                   		<form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                       	 	@csrf
	                       <img src="/images/logo.png" class="img-logo">
	                       <div class="input-container">
		                       <div class="input-wrapper">
			                       	<!-- <p>Email Address</p> -->
			                       	<input type="email" name="email" class="input-element {{ $errors->has('email') ? ' is-invalid' : '' }}"  placeholder="Email" autocomplete="off" required autofocus>
			                       	@if ($errors->has('email'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <small>{{ $errors->first('email') }}</small>
	                                    </span>
	                                @endif
		                       </div>

		                       <div class="input-wrapper">
			                       	<!-- <p>Password</p> -->
			                       	<input type="password" name="password" class="input-element {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" autocomplete="off" required>
			                       	@if ($errors->has('password'))
	                                    <span class="invalid-feedback" role="alert">
	                                        <small>{{ $errors->first('password') }}</small>
	                                    </span>
	                                @endif
		                       </div>

		                   <!--     <div class="input-wrapper">
		                       		<div class="form-check">
	                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

	                                    <label class="form-check-label" for="remember">
	                                        {{ __('Remember Me') }}
	                                    </label>
	                                </div>
		                       </div> -->

		                       <div class="input-wrapper">
		                       		<button class="btn btn-blue btn-login">Login</button>
		                       </div>
	                       </div>
                        </form>
                   	</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
@endpush







