<?php

class OrganizationSetup
{
    protected $name;
    protected $slug;
    protected $org;

    public static function create($params)
    {
        $instance = new static($params['name'], $params['slug']);
        $instance->run();

        return $instance;
    }

    public function __construct($name, $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
    }

    public function run()
    {
        $this->createOrganization();
        $this->createDatabaseAndConnection();
        $this->runMigrations();

        return $this->org;
    }

    protected function createOrganization()
    {
        $this->org = Organization::create([
            'name' => $this->name,
            'slug' => $this->slug
        ]);
    }

    protected function createDatabaseAndConnection()
    {
        // Non-sqlite
        // DB::statement('CREATE DATABASE ?', [$this->slug]);

        // Sqlite
        $tenantDir = app_path().'/database/tenants/';
        $tenantDb  = $tenantDir.$this->slug.'.sqlite';

        if (! File::isDirectory($tenantDir)) {
            File::makeDirectory($tenantDir);
        }

        touch($tenantDb);

        App::make('setDbConnection', $this->slug);
    }

    protected function runMigrations()
    {
        return Artisan::call('migrate', [
            '--database' => $this->slug,
            '--path'     => 'app/database/migrations/tenants'
        ]);
    }
}
