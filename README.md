## About Package
To decompose the system, it is proposed to identify bounded business logic contexts and separate them into individual modules

Each module should be responsible for one related context and have a defined directory structure that determines the core layers

This package is built on top of [nwidart/laravel-modules](https://github.com/nWidart/laravel-modules) and builds the following module structure:

**Domain - Domain layer**

* Src
* Entity
* UseCase
* Repository
* Service

**Application - Application layer**

* Api
* Service
* Console
* Listener
* Provider

**Infrastructure - Infrastructure layer**

* Config
* Database
* Repository
* ReadModel

**Presentation - Presentation layer**

* Http
  * Controller
  * Request
  * Middleware

**Testing**

## Installation

#### Require packages
```shell
composer require enfil/laravel-ddd-cqrs-modules codeception/codeception codeception/module-asserts codeception/module-phpbrowser
```
#### Publish the package's configuration

```shell
php artisan vendor:publish --provider="Enfil\Laravel\DddCqrs\Modules\LaravelModulesServiceProvider"
```

#### Add this line to composer.json autoload
```json
"autoload": {
  "psr-4": {
    ...
    "Modules\\": "modules/",
    ...
  }
},
```

## Usage

As an example, let's take the **Comments** module for comments.

Let's assume that the list of main entities will be as follows:

* **Comment**
* **Author**

### Module generation and CRUD
```shell
module:make-structure {MODULE_NAME} {ENTITY_NAMES*}
```

Let's call the command.

#### Creating a new module
```shell
php artisan module:make-structure Comments Resource Comment Author
```
The command should generate the module structure, create the main entities, repository interfaces, read models, services, controllers, requests, configs, migrations, and one route

Now you can go to the endpoint http://localhost/comments/v1/ and see this message:

```json
{"data":{"message":"Blog - module index"}}
```
