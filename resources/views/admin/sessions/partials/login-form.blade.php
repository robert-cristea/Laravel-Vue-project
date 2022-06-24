<form action="{{route('login.post')}}" id="loginForm" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input type="text" class="form-control" name="email" placeholder="Enter Username/Email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Enter Password">
    </div>

    <div class="other-actions row">
        <div class="col-6">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>
        </div>

    </div>
    <button class="btn btn-full btn-success">Login</button>

</form>