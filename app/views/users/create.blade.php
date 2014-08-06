<section class="users-edit">
    <h1 class="title">New User</h1>

    <form class="form-horizontal" role="form" action="{{ URL::route('users.store') }}" method="post">
        @include('users._form')
    </form>
</section>
