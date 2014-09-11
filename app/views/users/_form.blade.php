@include('shared._errors')

<div class="form-group">
    <label for="user[name]" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
        <input type="text" name="user[name]" class="form-control" id="name" placeholder="Name" value="{{ $user->name }}">
    </div>
</div>
<div class="form-group">
    <label for="user[email]" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
        <input type="text" name="user[email]" class="form-control" id="email" placeholder="Email" value="{{ $user->email }}">
    </div>
</div>
<div class="form-group">
    <label for="user[password]" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
        <input type="password" name="user[password]" class="form-control" id="password" placeholder="Password">
    </div>
</div>
<div class="form-group">
    <label for="user[confirm_password]" class="col-sm-2 control-label">Confirm Password</label>
    <div class="col-sm-10">
        <input type="password" name="user[password_confirmation]" class="form-control" id="password_confirmation" placeholder="Confirm Password">
    </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ tenantRoute('users.index') }}" type="submit" class="btn btn-default">Cancel</a>
    </div>
</div>
