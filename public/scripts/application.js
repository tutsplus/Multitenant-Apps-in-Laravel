var toodoo = angular.module('toodoo', []);

toodoo.controller('TodosCtrl', function ($scope, todoStorage) {
    $scope.currentUser = window.currentUser;
    $scope.newTodo     = '';
    $scope.editedTodo  = null;
    $scope.todos       = [];

    $scope.canEdit = function(todo) {
        return $scope.currentUser.id == todo.user_id || !$scope.currentUser || $scope.currentUser.admin;
    };

    $scope.todos = todoStorage.all().then(function(todos) {
        $scope.todos = todos;
    });

    $scope.addTodo = function() {
        var newTodo = $scope.newTodo.trim();
        if (newTodo.length) {
            todoStorage.create({name: newTodo}).then(function(todo) {
                $scope.todos.push(todo);
            });

            $scope.newTodo = '';
        }
    };

    $scope.isTodoBeingEdited = function(todo) {
        return $scope.editedTodo === todo;
    };

    $scope.editTodo = function(todo) {
        if ($scope.canEdit(todo)) {
            $scope.editedTodo = todo;
            $scope.originalTodo = angular.extend({}, todo);
        }
    };

    // Completion
    $scope.completeTodo = function(todo) {
        todo.completed = !todo.completed;

        todoStorage.update(todo).then(function(todo) {
        }, function(err) {
            todo.completed = !todo.completed;
        });

    };

    $scope.completeEditing = function (todo) {
        $scope.editedTodo = null;
        return true;
    };

    $scope.doneEditing = function (todo) {
        todo.name = todo.name.trim();

        if (!todo.name) {
            $scope.removeTodo(todo);
        } else {
            todoStorage.update(todo).then(function(todo) {
            }, function(err) {
                $scope.revertEditing(todo);
            });
        }
        $scope.editedTodo = null;
    };

    $scope.revertEditing = function(todo) {
        $scope.todos[$scope.todos.indexOf(todo)] = $scope.originalTodo;
        $scope.editedTodo = null;
    };

    $scope.removeTodo = function (todo) {
        if (todo.id && $scope.canEdit(todo)) {
            todoStorage.delete(todo).then(function(response) {
                $scope.todos.splice($scope.todos.indexOf(todo), 1);
            });
        }
    };

    $scope.authorIsCurrentUser = function(todo) {
        return !todo.user_id || $scope.currentUser.id == todo.user_id;
    };

    $scope.userNameFor = function(todo) {
        return $scope.authorIsCurrentUser(todo) ? "Me" : todo.user.name;
    };

    $scope.todoAuthorClass = function(todo) {
        return $scope.authorIsCurrentUser(todo) ? "label-primary" : "label-default";
    };
});

toodoo.directive('todoEscape', function () {
    var ESCAPE_KEY = 27;

    return function (scope, el, attrs) {
        el.bind('keydown', function (event) {
            if (event.keyCode === ESCAPE_KEY) {
                scope.$apply(attrs.todoEscape);
            }
        });
    };
});

toodoo.directive('todoFocus', function todoFocus($timeout) {
    return function (scope, el, attrs) {
        scope.$watch(attrs.todoFocus, function (newVal) {
            if (newVal) {
                $timeout(function () { el[0].focus(); }, 0, false);
            }
        });
    };
});

toodoo.factory('todoStorage', function($http) {
    var url = window.todosRoute + '/';
    var todoStorage = {
        all: function() {
            return $http.get(url).then(function(response) {
                return response.data;
            });
        },
        create: function(todo) {
            var promise = $http({
                url: url,
                method: "POST",
                data: JSON.stringify(todo),
                headers: {'Content-Type': 'application/json'}
            }).then(function (response) {
                return response.data;
            });
            return promise;
        },
        update: function(todo) {
            var promise = $http({
                url: url + todo.id,
                method: "PUT",
                data: JSON.stringify(todo),
                headers: {'Content-Type': 'application/json'}
            }).then(function (response) {
               return response.data;
            });
            return promise;
        },
        delete: function(todo) {
            var promise = $http({
                url: url + todo.id,
                method: "DELETE",
                headers: {'Content-Type': 'application/json'}
            }).then(function (response) {
                return response;
            });
            return promise;
        }
    };
    return todoStorage;
});

angular.bootstrap(document.getElementById("toodoo"), ["toodoo"]);

(function() {
    var linkHandler = {
        start: function() {
            $(document).on('click', 'a[data-method]', this.processLink());
            $(document).on('click', 'a.destroy', function(e) {
                return confirm('Are you sure?');
            });
        },
        processLink: function() {
            var self = this;

            return function(e) {
                var link   = $(this),
                    method = link.data('method').toUpperCase();

                if (method === 'PUT' || method === 'DELETE') {
                    self.createForm(link).submit();
                    e.preventDefault();
                }
            };
        },
        createForm: function(link) {
            var form       = document.createElement('form'),
                input      = document.createElement('input'),
                tokenInput;

            form.setAttribute('method', 'POST');
            form.setAttribute('action', link.attr('href'));

            input.setAttribute('name', '_method');
            input.setAttribute('type', 'hidden');
            input.setAttribute('value', link.data('method'));

            if (link.data('token')) {
                tokenInput = document.createElement('input');
                tokenInput.setAttribute('name', 'csrf_token');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('value', link.data('token'));
                form.appendChild(tokenInput);
            }

            form.appendChild(input);
            document.body.appendChild(form);

            return form;
        }
    };

    linkHandler.start();
}());
