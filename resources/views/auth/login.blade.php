@extends("layouts.guest")

@section("title") Login @endsection

@section("content")
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>{{ env("APP_NAME") }}</b></a>
        </div>
        @include("includes.errors")
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="/login" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Vendor ID" name="vendor_id" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{ route('password.request') }}">I forgot my password</a><br>
            <a href="{{ route("register") }}" class="text-center">Apply for an account</a>

        </div>
        <!-- /.login-box-body -->
    </div>
@endsection

@section("scripts")
    <script src="/css/iCheck/icheck.min.js"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '15%' // optional
            });
        });
    </script>
@endsection
