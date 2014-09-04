<form class="form-signin" role="form" method="post" action="{{ URL::route('sign-up') }}">
    <h1>Toodoo</h1>

    @include('shared._errors')

    <h3 class="form-signin-heading">Sign up your organization</h3>

    <input type="text" class="form-control" name="organization_name" placeholder="Organization Name" required autofocus>
    <input type="text" class="form-control" name="name" placeholder="Your Name" required>
    <input type="email" class="form-control" name="email" placeholder="Email Address" required>
    <input type="password" class="form-control" name="password" placeholder="Password" required>
    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
</form>
