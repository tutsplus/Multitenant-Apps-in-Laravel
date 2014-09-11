<!doctype html>
<html>
    <head>
        <title>Toodoo</title>
        <link rel="stylesheet" type="text/css" href="/styles/normalize.css">
        <link rel="stylesheet" type="text/css" href="/styles/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/styles/application.css">
    </head>

    <body>
        @include('shared._top_nav_bar')

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @include('shared._notifications')
                    {{ $content }}
                </div>
            </div>

        </div>

        <script>
            window.currentUser = {{ json_encode($currentUser) }};
            window.currentOrg  = {{ json_encode($currentOrg) }};
            window.todosRoute  = "{{ tenantRoute('todos.index') }}";
        </script>
        <script type="text/javascript" src="/scripts/vendor/jquery.min.js"></script>
        <script type="text/javascript" src="/scripts/vendor/bootstrap.min.js"></script>
        <script type="text/javascript" src="/scripts/vendor/angular.min.js"></script>
        <script type="text/javascript" src="/scripts/application.js"></script>
    </body>
</html>
