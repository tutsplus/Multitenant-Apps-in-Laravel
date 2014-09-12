<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ tenantRoute('organizations.show', $currentOrg->slug) }}">Toodoo | {{ $currentOrg->name }}</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if ($isLoggedIn)
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ $currentUser }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('home') }}">Organizations</a></li>
                        <li><a href="{{ tenantRoute('users.index') }}">Users</a></li>
                        <li><a href="{{ tenantRoute('users.edit', $currentUser->id) }}">Edit Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ tenantRoute('sign-out') }}" data-method="delete">Sign out</a></li>
                    </ul>
                    </li>
                @else
                    <li><a href="{{ tenantRoute('sign-in') }}">Sign in</a></li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
