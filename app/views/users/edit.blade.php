<section class="users-edit">
    <h1 class="title">Edit User</h1>

    <form class="form-horizontal" role="form" action="{{ URL::route('users.update', $user->id) }}" method="post">
        <input type="hidden" name="_method" value="put">
        @include('users._form')
    </form>
</section>
