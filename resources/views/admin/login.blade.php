@extends("layouts.guest")

@section("title") AdminCP Login @endsection

@section("content")
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>{{ env("APP_NAME") }} Admin</b></a>
        </div>
        @include("includes.errors")
        <div class="login-box-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form action="/admin/login" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Admin Username" name="username" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div>
@endsection
