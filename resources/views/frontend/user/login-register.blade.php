<?php
use App\Models\Product;
?>
@extends('frontend.layouts.app')
@section('title','Login Register')
@section('content')
<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>Login/Register</h3>
	</div>
</div>

<!-- typography -->
<div class="typrography">
	 <div class="container">	
		<div class="grid_3 grid_4 wow fadeInLeft animated" data-wow-delay=".5s">
		    <div class="login-grids">
                <div class="login">

				   @if (Session::has('success_message'))
				   <div class="alert alert-success" role="alert">
						{{Session::get('success_message')}}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif

					@if (Session::has('error_message'))
					<div class="alert alert-danger" role="alert">
						{{Session::get('error_message')}}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					</div>
					@endif
                    <div class="login-bottom">
                        <h3>Sign Up</h3>
                        <form id="registerForm" action="{{ route('user.register')}}" method="post">
                            @csrf
                            <div class="sign-up">
                                <h4 style="margin-top: 5px;">Name :</h4>
                                <input type="text"  class="@error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" placeholder="Enter Name">	
                            </div>

                            <div class="sign-up">
                                <h4 style="margin-top: 5px;">Email :</h4>
                                <input type="email" id="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                            </div>
                            <div class="sign-up">
                                <h4 style="margin-top: 5px;">Password :</h4>
                                <input type="password" id="password" name="password" placeholder="Enter Password">
								
                            </div>
                            <div class="sign-up">
                                <h4 style="margin-top: 5px;">Confirm Password :</h4>
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Enter confirm Password">     
                            </div>
                            <div class="sign-up">
                                <input type="submit" value="REGISTER NOW" >
                            </div>
                            
                        </form>
                    </div>
                    <div class="login-right">
                        <h3>Sign In </h3>
                        <form id="loginForm" action="{{ route('user.login') }}" method="post">
                            @csrf
                            <div class="sign-in">
                                <h4>Email :</h4>
                                <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter Email">	
							
                            </div>
                            <div class="sign-in">
                                <h4>Password :</h4>
                                <input type="password" id="password" name="password" placeholder="Enter Password"><br>
                            </div>
                           
                            <div class="sign-in">
                                <input type="submit" value="SIGNIN" >
                            </div>
                        </form>
                    </div>
                    <div class="clearfix"></div>
                </div>
               
            </div>
	    </div>
		<div class="clearfix"></div>
	</div>
</div>


<div class="coupons">
	<div class="container">
		<div class="coupons-grids text-center">
			<div class="col-md-3 coupons-gd">
				<h3>Buy your product in a simple way</h3>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				<h4>LOGIN TO YOUR ACCOUNT</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				<h4>SELECT YOUR ITEM</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="col-md-3 coupons-gd">
				<span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span>
				<h4>MAKE PAYMENT</h4>
				<p>Neque porro quisquam est, qui dolorem ipsum quia dolor
			sit amet, consectetur.</p>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
    <script>
        $( document ).ready(function() {
            // validate signup form on keyup and submit
		$("#registerForm").validate({
			rules: {
				name: "required",
				password: {
					required: true,
					minlength: 6
				},
                email: {
					required: true,
					email: true,
                    romote: "/user/check-email"
				},

				confirm_password: {
					required: true,
					minlength: 6,
					equalTo: "#password"
				},
				
			},
			messages: {
				name: "Please enter your name",
				email: {
					required: "Please enter your email",
					email: "Please enter a valid email address",
                    romote: "Email already exits"
				},
				password: {
					required: "Please choose a password",
					minlength: "Your password must be at least 6 characters long"
				},
				confirm_password: {
					required: "Please choose a password",
					minlength: "Your password must be at least 6 characters long",
				},
				
			}
		});


        $("#loginForm").validate({
			rules: {
                email: {
					required: true,
					email: true,
				},

				password: {
					required: true,
					minlength: 6
				},
				
			},
			messages: {
				email: {
					required: "Please enter your email",
					email: "Please enter a valid email address",
				},
				password: {
					required: "Please choose a password",
					minlength: "Your password must be at least 6 characters long"
				},
				
				
			}
		});

        });
    </script>
@endpush

@push('css')
    <style>
        form.cmxform label.error, label.error {
            color: red;
            font-style: italic;
        }
    </style>
@endpush
