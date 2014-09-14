<section class="organizations-edit">
    <h1 class="title">Organizations Settings</h1>

    <form class="form-horizontal" role="form" action="{{ tenantRoute('settings') }}" method="post">
        <input type="hidden" name="_method" value="put">

        @include('shared._errors')

        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $currentOrg->name }}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Subdomain</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" readonly value="{{ $currentOrg->slug }}">
                <span class="help-block">You cannot change your subdomain at this time</span>
            </div>
        </div>

        <fieldset>
            <legend>Custom CSS</legend>

            <div class="form-group">
                <label for="css[nav_bar_bg_color]" class="col-sm-2 control-label">Navbar Background Color</label>
                <div class="col-sm-10">
                    <input type="text" name="css[nav_bar_bg_color]" class="form-control" placeholder="Enter color" value="{{ $currentOrg->css->nav_bar_bg_color }}">
                </div>
            </div>
        </fieldset>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ tenantRoute('organizations.show', $currentOrg->slug) }}" class="btn btn-default">Cancel</a>
            </div>
        </div>
    </form>
</section>
