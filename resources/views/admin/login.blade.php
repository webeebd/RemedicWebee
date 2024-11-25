@extends('layouts.app')
@section('content')
<div class="page-body">
    <div class="container-fluid">
        <div class="row g-0 mt-lg-4">
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center">
                <div style="max-width: 25rem;">
                    <div class="mb-4">
                        <!-- App Logo -->      
                    </div>
                    <div class="mb-5">
                        <h2 class="color-900">Welcome Back!</h2>
                    </div>
                    <ul class="list-unstyled mb-5">
                        <li class="mb-4">
                            <span class="d-block mb-1 fs-4 fw-light">All-in-one tool</span>
                            <span class="color-600">Amazing Features to make your life easier & work efficient</span>
                        </li>
                    </ul>
                    <div class="mb-2">
                        <a href="#" class="me-3 color-600"><u>Home</u></a>
                        <a href="#" class="me-3 color-600"><u>About Us</u></a>
                        <a href="#" class="me-3 color-600"><u>FAQs</u></a>
                    </div>
                    <div>
                        <a href="#" class="me-3 color-400"><i class="fa fa-facebook-square fa-lg"></i></a>
                        <a href="#" class="me-3 color-400"><i class="fa fa-twitter-square fa-lg"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center">
				<div class="card shadow p-4 p-md-5" style="max-width: 32rem;">
					<form action="{{url('admin/login')}}" method="post">
						@csrf
						<div class="col-12 text-center mb-4">
							<img src="/assets/img/remedic-logo.png" alt="Image Description" style="width: 150px;">
						</div>  
						<div class="col-12 text-center mb-4">
							<h4>Admin Login</h4>
							<span class="text-muted">Enter email address and password to view your dashboard.</span>
						</div>
						<div class="col-12">
							<div class="mb-2">
								<label class="form-label">Email Address</label>
								<input type="email" class="form-control form-control-lg" placeholder="name@example.com" name="email" value="{{ old('email') }}" required autofocus>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-2">
								<div class="form-label">
									<span class="d-flex justify-content-between align-items-center">Password
										<a class="text-primary" href="">
											Forgot Password?
										</a>
									</span>
								</div>
								<input type="password" name="password" class="form-control form-control-lg" placeholder="***************" required>
							</div>
						</div>
						@if ($errors->has('email'))
						<div role="alert" class="alert alert-danger">{{ $errors->first('email') }}</div>
						@endif
						@if ($errors->has('password'))
						<div role="alert" class="alert alert-danger">{{ $errors->first('password') }}</div>
						@endif
						<div class="col-12">
							<div class="form-check">
								<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" v-model="checked">
								<label class="form-check-label" for="flexCheckDefault">Remember Me</label>
							</div>
						</div>
						<div class="col-12 text-center mt-4">
							<button type="submit" class="btn btn-primary btn-lg btn-dark text-uppercase form-control" >Login</button>
						</div>
					</form>
				</div>
			</div>     
        </div> 
    </div>
 </div>
@endsection
