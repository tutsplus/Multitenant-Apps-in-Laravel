
### Tuts+ Course: Building Multitenant Apps in Laravel
**Instructor: Matthew Machuga**

Multitenant apps are all over the web, but tackling your first one can be challenging.  This course walks you through developing a multitenant application in Laravel 4.2, covering both single-database and multi-database tenancy styles.  

Source files for the Tuts+ course: [Building Multitenant Apps in Laravel](https://code.tutsplus.com/courses/building-multitenant-apps-in-laravel)


---

### Using These Source Files

In this repository, you'll find a fully functioning Laravel 4.2 application.  To boot:

- Launch the web server via `php artisan serve --host=127.0.0.1`
- Run `rm app/database/production.sqlite && touch app/database/production.sqlite` to clear out the main database (multidb and singledb branches have incompatible structures)
- Use `git tag` to fetch a list of all available tags
- Use `git checkout <tagname>` to checkout a tag at a given point in the app
- Run `php artisan migrate --seed` to both migrate and seed the database for that point in the app.

If you'd like to look around, the `app/models` and `app/database/migrations` directories have the bulk of the interesting code.  Just checkout which branch you'd like to inspect.

If you are interested in front end code, the Angular app lives at `public/application.js`.  It isn't a pure example of how to write angular code, but it might be fun to look at.  Many of the concepts came from TodoMVC.

---

### Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

### Contributing To Laravel

**All issues and pull requests should be filed on the [laravel/framework](http://github.com/laravel/framework) repository.**

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
