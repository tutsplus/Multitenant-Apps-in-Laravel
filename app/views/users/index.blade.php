<section class="users-index">
    <header class="title">
        <div class="row">
            <div class="col-sm-10">
                <h1>Users</h1>
            </div>
            <div class="col-sm-2">
                @if($canI('manage', 'User'))
                    <nav class="pull-right">
                        <a class="btn btn-primary" href="{{ URL::route('users.create') }}">Add New User</a>
                    </nav>
                @endif
            </div>
        </div>
    </header>
    @if ($users)
        <table class="table table-striped table-bordered users">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th></th>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr class="user">
                        <td>{{ $user->id }}</td>
                        <td><a href="{{ URL::route('users.edit', $user->id) }}">{{ $user->name }}</a></td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            @if($canI('manage', $user))
                                @include('shared._table_actions', ['resource' => 'users', 'key' => $user->id])
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</section>
