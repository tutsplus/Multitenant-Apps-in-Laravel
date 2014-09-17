<section class="users-edit">
    <h1 class="title">Invite User</h1>

    <form class="form-horizontal" role="form" action="{{ tenantRoute('users.store') }}" method="post">

        @include('shared._errors')
        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email to Invite</label>
            <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="email" placeholder="Email" value="">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ tenantRoute('users.index') }}" type="submit" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
</section>
