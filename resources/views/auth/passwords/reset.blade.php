@extends("layouts.guest")

@section("title") Reset Password @endsection

@section("content")
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>{{ env("APP_NAME") }}</b></a>
        </div>
        @include("includes.errors")
        <div class="login-box-body">
            <p class="login-box-msg">Reset Password</p>

            <form action="{{ route('password.request') }}" method="post">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required>
                    <span class="glyphicon glyphicon-email form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="New Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm New Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">Reset Password</button>
                </div>

            </form>

            <a href="{{ route('login') }}">Login to your account</a><br>
            <a href="{{ route("register") }}" class="text-center">Apply for an account</a>

        </div>
        <!-- /.login-box-body -->
    </div>
@endsection