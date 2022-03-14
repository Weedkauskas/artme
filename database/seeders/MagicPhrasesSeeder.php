<?php

namespace Database\Seeders;

use App\Models\MagicPhrase;
use Illuminate\Database\Seeder;

class MagicPhrasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $phpPhrases = [
            ['Laravel', 'Open-sourced PHP framework with expressive, elegant syntax, robust and easy to understand'],
            ['Dependency injection', 'A design pattern in which a class requests dependencies from external sources rather than creating them'],
            ['Traits', 'Traits are a mechanism for code reuse'],
            ['Repository pattern', 'A bridge between models and controllers.'],
            ['Provider pattern', 'Extend framework by registering service provider'],
            ['Factory design pattern', 'Facade is a class which provides a static-like interface to services inside the container. '],
            ['Builder / Manager pattern', 'The builder pattern is a design pattern designed to provide a flexible solution to various object creation problems in object-oriented programming.'],
            ['Facade pattern', 'Facades provide a "static" interface to classes that are available in the application\'s service container'],
            ['Strategy pattern', 'A behavioral software design pattern that enables selecting an algorithm at runtime.'],
            ['Observers, Events and listeners', 'Behavioral design pattern that allowing you to subscribe and listen for various events that occur within your application'],
            ['Singleton pattern', 'Used to restrict the instantiation of a class to a single object, which can be useful when only one object is required across the system.'],
            ['Service container', 'A powerful tool for managing class dependencies and performing dependency injection'],
            ['Mysql', 'Common used database management system'],
            ['Eloquent', 'An object-relational mapper (ORM) that makes it enjoyable to interact with your database'],
            ['Caching', 'Strategies for optimizing your app by storing data instead of accessing slower data layers'],
            ['Notifications', 'Notifications can be seen as a short and straightforward message deliver to a user for giving vital info, events or to evoke action in the application.'],
            ['Task Scheduling', 'The scheduler allows you to fluently and expressively define your command schedule within your Laravel application itself. When using the scheduler, only a single cron entry is needed on your server.'],
            ['Queue', 'Allow you to defer the processing of a time consuming task, such as sending an e-mail, until a later time which drastically speeds up web requests to your application.'],
            ['Routing', 'Allows you to route all your application requests to its appropriate controller'],
            ['Middlewares', 'Middleware provide a convenient mechanism for inspecting and filtering HTTP requests entering your application'],
            ['Blade', 'Simple, yet powerful templating engine that is included with Laravel'],
            ['Macros', 'Laravel Macros allow you to add custom functionality to internal Laravel components.'],
            ['Telescope', 'Handy tool to debug your Laravel application'],
            ['Passport', 'Powerful tool for authentification'],
            ['Unit tests', 'Type of software testing where individual units or components of a software are tested'],
        ];

        $javascriptPhrases = [
            ['React', 'Modern JS library for building UI'],
            ['Three.js', 'JavaScript library and application programming interface (API) used to create and display animated 3D computer graphics in a web browser using WebGL.'],
            ['Webpack', 'JavaScript module bundler'],
            ['Babel', 'Javascript ES6+ transcompiler'],
            ['Typescript', 'TypeScript is a strongly typed programming language that builds on JavaScript, giving you better tooling at any scale'],
            ['ES6', 'Javascript standard'],
            ['NodeJS', 'Javascript runtime environment that executes Javascript code outside a web browser'],
            ['Npm', 'A package manager for the JavaScript programming language'],
            ['Gulp', 'JavaScript toolkit used as a streaming build system'],
            ['Redux', 'JavaScript library for managing and centralizing application state'],
            ['Fetch API', 'JavaScript interface for accessing and manipulating parts of the HTTP pipeline, such as requests and responses'],
            ['Promises', 'Commonly defined as a proxy for a value that will eventually become available.'],
            ['jQuery', 'JavaScript library designed to simplify HTML DOM tree traversal and manipulation'],
            ['Vue.js', 'Another JavaScript framework for building user interfaces and single-page applications'],
        ];

        $solidPhrases = [
            ['Single responsibility principle', 'Every module, class or function should have responsibility over a single part of that program\'s functionality,'],
            ['Open/closed principle', 'Objects or entities should be open for extension but closed for modification. Goal: get to a point where you can never break the core of you system.'],
            ['Liskov substitution principle', 'Objects of a superclass shall be replaceable with objects of its subclasses without breaking the application'],
            ['Interface segregation principle', 'Clients should not be forced to depend upon interfaces that they do not use'],
            ['Dependency inversion principle', 'High level modules should not depend on low level modules, both should depend on abstractions'],
        ];

        foreach($phpPhrases as $phrase) {
            MagicPhrase::create([
                'magic_id' => 1,
                'title' => $phrase[0],
                'description' => isset($phrase[1]) ? $phrase[1] : null,
            ]);
        }

        foreach($javascriptPhrases as $phrase) {
            MagicPhrase::create([
                'magic_id' => 2,
                'title' => $phrase[0],
                'description' => isset($phrase[1]) ? $phrase[1] : null,
            ]);
        }

        foreach($solidPhrases as $phrase) {
            MagicPhrase::create([
                'magic_id' => 3,
                'title' => $phrase[0],
                'description' => isset($phrase[1]) ? $phrase[1] : null,
            ]);
        }
    }
}
