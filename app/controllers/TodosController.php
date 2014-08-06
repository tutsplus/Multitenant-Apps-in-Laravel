<?php

class TodosController extends BaseController
{
    protected $viewBase = 'todos';

    public function index()
    {
        return Response::json(Todo::allForUser(Auth::user()));
    }

    public function store()
    {
        $form = new TodoForm(Input::only('name', 'completed'), Auth::user(), new Todo());

        if ($form->save()) {
            return Response::json($form->getTodo(), 201);
        } else {
            return Response::json($form->getErrors(), 409);
        }
    }

    public function update(Todo $todo)
    {
        $form = new TodoForm(Input::only('name', 'completed'), Auth::user(), $todo);

        if ($form->save()) {
            return Response::json($form->getTodo(), 200);
        } else {
            return Response::json($form->getErrors(), 409);
        }
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return Response::json(null, 204);
    }
}
