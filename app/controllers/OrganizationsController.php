<?php

class OrganizationsController extends BaseController
{
    protected $viewBase = 'organizations';

    public function __construct()
    {
        $this->beforeFilter('@authorize', ['only' => ['edit', 'update']]);
    }

    public function show()
    {
        $this->view('show');
    }

    public function edit()
    {
        $this->view('edit');
    }

    public function update(Organization $org)
    {
        $name = trim(Input::get('name'));

        $redirect = Redirect::route('settings', $org->slug);

        if ($name) {
            $org->name = $name;
            $org->css = Input::get('css', []);
            $org->save();

            return $redirect->withSuccess('Organization updated successfully');
        } else {
            return $redirect->withError('Name may not be blank');
        }
    }

    public function authorize()
    {
        if (CanI::cannot('manage', $this->currentOrg())) {
            return App::abort(401);
        }
    }
}
