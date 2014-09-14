<section class="dashboard">
    <h1>Toodoo Dashboard</h1>

    <h2>The Basics</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center bg-info">
                <h4>Number of Organizations</h4>
                <p class="lead">{{ $counts['organizations'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center bg-info">
                <h4>Number of Users</h4>
                <p class="lead">{{ $counts['users'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center bg-info">
                <h4>Number of Todos</h4>
                <p class="lead">{{ $counts['todos'] }}</p>
            </div>
        </div>
    </div>

    <h2>More Interesting Info</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="text-center bg-info">
                <h4>Number of Users in Multiple Organizations</h4>
                <p class="lead">{{ $counts['mt_users'] }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center bg-info">
                <h4>Organization with the Most Todos</h4>
                <p class="lead">{{ $orgWithMostTodos->name }} with {{ $orgWithMostTodos->total }} todos!</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="text-center bg-info">
                <h4>Newest Organization</h4>
                <p class="lead">{{ $newestOrg->name }} at {{ $newestOrg->created_at->format('c') }}</p>
            </div>
        </div>
    </div>
</section>
