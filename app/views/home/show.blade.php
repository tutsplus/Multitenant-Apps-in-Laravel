<section id="organizations">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h1>Toodoo</h1>
            <h3>Choose an organization</h3>

            <ul>
                @foreach ($orgs as $org)
                    <li>
                        <a href="{{ tenantRoute('organizations.show', $org->id) }}">{{ $org->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</section>
