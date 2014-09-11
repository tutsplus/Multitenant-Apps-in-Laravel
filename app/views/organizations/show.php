<section id="toodoo">
    <h1>Toodoo List</h1>
    <div class="tasks" ng-controller="TodosCtrl">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form id="todo-form" ng-submit="addTodo()" role="form">
                    <div class="form-group">
                        <input class="form-control" id="new-todo" type="text" ng-model="newTodo" autofocus placeholder="What do you need to do?">
                    </div>
                </form>
            </div>
        </div>

        <ul class="todos">
            <li class="todo" ng-repeat="todo in todos" ng-class="{ mine: todo.user_id == currentUser.id, completed: todo.completed, editing: isTodoBeingEdited(todo)}">
                <div class="row">
                    <div class="col-md-1">
                        <input type="checkbox" ng-show="canEdit(todo)" ng-click="completeTodo(todo)" ng-model="todo.completed">
                    </div>
                    <div class="col-md-1">
                        <span class="label block {{todoAuthorClass(todo)}}">{{userNameFor(todo)}}</span>
                    </div>
                    <div class="col-md-9">
                        <p class="task task-name" ng-hide="isTodoBeingEdited(todo)" ng-dblclick="editTodo(todo)">
                            {{ todo.name }}
                        </p>
                        <form ng-submit="doneEditing(todo)">
                            <input class="task task-edit" ng-show="isTodoBeingEdited(todo)"
                                                          ng-model="todo.name"
                                                          ng-blur="completeEditing(todo)"
                                                          todo-escape="revertEditing(todo)"
                                                          todo-focus="todo == editedTodo">
                        </form>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-danger btn-xs" ng-show="canEdit(todo)" ng-click="removeTodo(todo)">&times;</button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</section>
