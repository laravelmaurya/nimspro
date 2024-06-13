@extends('auth.master-auth')
@section('content')
<main class="login-form mt-5">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <h3 class="card-header text-center">Login</h3>
                    <span class="text-center mt-3">
                        @if ($errors->has('error'))
                        <span class="text-danger">{{ $errors->first('error') }}</span>
                        @endif
                    </span>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.custom') }}">
                            @csrf
                            <div class="form-group mb-3">
                                <input type="text" placeholder="Email" id="email" class="form-control" name="nims_wp_user_email" required
                                    autofocus>
                                @if ($errors->has('nims_wp_user_email'))
                                <span class="text-danger">{{ $errors->first('nims_wp_user_email') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" placeholder="Password" id="password" class="form-control" name="nims_wp_user_password" required>
                                @if ($errors->has('nims_wp_user_password'))
                                <span class="text-danger">{{ $errors->first('nims_wp_user_password') }}</span>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="d-grid mx-auto">
                                <button type="submit" class="btn btn-dark btn-block">Signin</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection