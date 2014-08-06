<a href="{{ URL::route("{$resource}.edit", $key) }}" class="btn btn-default">
    <span class="glyphicon glyphicon-pencil"></span>
</button>
<a href="{{ URL::route("{$resource}.destroy", $key) }}" class="btn btn-danger destroy" data-method="delete">
    <span class="glyphicon glyphicon-trash"></span>
</a>

