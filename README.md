# FuelPHP 2.0-dev

This is the development of the next generation of FuelPHP. As the Kernel package is now considered feature complete
we are moving towards a first beta release. It is still not recommended for production usage.  
While this is written anew from the ground up, much of the code was ported from v1.x.

## How to install

Clone or download this repository and run `composer.phar install` from the commandline in the directory where you put
Fuel. That will clone the "fuel/kernel", "fuel/core", "fuel/oil", "doctrine/dbal" packages into the fuelphp directory.  
If you want to keep using a static interface you need to add `"fuel/static" : "dev-master"` to the main 
*composer.json* file. You can also add `"fuel/legacy"` in the same way that should allow most of the 1.x API calls on
the new codebase.

## Important changes

Below I'll keep a list of important techniques/patterns implemented.

### Adoption of industry standards like Composer/Packagist and PSR-0 & PSR-1

Version 2.0 will include and have its packages setup to be installable using Composer. Also allowing you to easily
include packages from Packagist.

By default Fuel will now use the PSR-0 standard for classloading. Its implementation is actually a superset, but it is
fully compatible with PSR-0. For convenience and speed each Package can be given a base namespace that will be required
and stripped before any class to path conversion takes place. The same goes for modules inside the Package, those
will have subnamespaces that are required and stripped before conversion as well.

We also decided to adopt PSR-1, which means that instead of `snake_case` names the methods & variablenames are now
camelCased.

### Everything is a Package and they'll be routable

In v1.x the Application, Core and Oil packages weren't normal packages and didn't follow the same rules as other
packages. As of 2.0 the Core will be divided up into the absolute minimum one needs to run Fuel (the 'Kernel', without
any dependencies) and the Core that will contain important extensions and utility classes. The Kernel could be
considered a micro-framework upon which the Core is build.

Applications will have wrapper classes that get instantiated to work with the Package as an Application instead of a
normal package. All packages that are loaded into an Application may be routable within that application, but only
if you mark them as such.  
Defining of the routes has also been moved outside the config dir and into the Application class.

### Unified and Package based Class and File loading

Instead of separate loaders for classes and files have these been replaced by Package Loader objects. These will handle
both the classloading of the autoloader and the fileloads. But the Autoloader will also make all packages available you
installed through Composer as long as they follow PSR-0 and have their namespace registered.

### Dependency Injection Containers and 'inheritance injection'

First of all we'll keep the global namespace clean from now on (except when you load static/legacy support). But the
'inheritance injection' to the global namespace was very powerful. Allowing you, for example, to extend the base
Controller and have its extensions available in the `Controller_Template` and `Controller_Rest` as well (as those extend
the alias, not the original classname).  
For that reason we still provide these aliases but they're aliased to a `Classes\` namespace.

Next we implemented a DiC. This will be available globally and Application specific, where the Application DiC will
fallback to the environment DiC when something unknown is requested. Below are the most important methods relating to
the DiC:

    $session_classname = $dic->getClass('Session');

`getClass()` can return whatever you configure as the default Session driver, for example
'Fuel\\Core\\Session\\Cookie'. When the class is unknown it returns the given classname unmodified.

    $session = $dic->forge('Session');
    $session = $dic->forge(array('Session', 'mySession'));

`forge()` returns an instance of the class that getClass() returns on the first argument. You can also register &
name it as is done in the second example using `array($class, $name)`. Any additional arguments past the first one are
passed on to the constructor. When this method is called on an application's DiC instance it will automatically call a
`_setApp(Application\Base $app)` method on the new instance when available, to provide the parent Application reference.

    $session = $dic->getObject('Session', 'name');

`getObject()` retrieves an object from the DiC for a specific class, without the 'name' param it will create a
default instance when one isn't available yet (default instances are specific to the DiC instance and don't fallback).
Named objects must be registered or they'll throw an Exception.

    $dic->setObject('Session', 'name', $session)

`setObject()` allows you to register an object with the DiC if you didn't do it during forging.

### Environment superobject and Application objects

The initialization of Fuel has been divided up into setting up the Environment and only after that is the Application
initialized. The environment settings entail all those settings that should not or cannot be changed while an
Application is running but should instead be considered fixed.

Applications are normal packages that have an Application class, either named `Application\Main` within the package
namespace or has an Application classname registered with the environment. These classes are instantiated when an
application is loaded and are able to create other Applications to interact with with the environment. This is in some
ways similar to HMVC but on the application level instead of the Request level (HMVC would be another Request within
the same application).

### Simplified Modules and possible in all packages

The concept of Modules has been simplified into a way of structuring your files inside the Package directory. All Views,
Configs and Language files from a Module are considered the same as those from the parent Package (the latter taking
precedence). The concept of an 'active' Module has been removed (of which the filepath took precedence over the
Application).  
They're also no longer limited to the Application directory and can be put into any Package. They must be a
subnamespace inside that Package and be a subdirectory in the `modules` directory of that Package.

### Oil reimplemented as an Application with Tasks as specialized Controllers

Oil is now an Application within the new setup. This means it has an Application wrapper class and its own internal
routing. Its own Front Controller is still named `oil` (without extension) and has almost no differences with the
normal `index.php` FC.

Tasks have been reimplemented as specialized Controllers which means their methods require an 'action_' prefix and
they're inside a subnamespace of the Application. The routing to these Tasks works through normal routing means but
requires specialized Route objects that route to Tasks instead of Controllers.  
All Oil command-classes have been reimplemented as Tasks.

### File structure reordering

The number of subdirectories per package has been increasing and we felt this has become less clear. We have decided
to move the less edited/used files into a 'resources' subdirectory.

* In the package folder itself you'll find: classes, config, languages, modules, resources and views.
* In the resources folder you'll find: migrations, tests and vendor. In Application Packages you'll also have: cache,
  logs and tmp.

### Decentralized Config and Language

Even though both Config and Language had a concept of 'groups' they were just 1 massive container per Application. This
is no longer the case. Each Application will have a main Config object that can access its 'children' much like
before, but those children will be separate objects which can be accessed on their own and are part of the class that
loaded them.

The Config and Language classes have also both become extensions of the new Data superclass as they share a lot of
their functionality. Among which are a new default values convention and very basic settings validation.

### ViewModel becomes Presenter

As the name lead to much confusion and discussion about CamelCasing of the name we decided that it is time for a better
name. ViewModel is the name the concept has in MVVM (Model-View-ViewModel), but it is about as similar to the MVP
(Model-View-Presenter) concept and that provides better clarity about its function. They will remain very much optional
though and Fuel will remain MVC.  
The Presenter class has also become a superset of the View class instead of wrapping a View object.

### Parser package integrated into the Kernel/Core

As the parsing of strings is necessary throughout Fuel and not just in Views this needs to be available everywhere for
both files and free input. Because of this a new Parser concept was introduced. Though the Kernel has just PHP support,
the Core will add Markdown and Twig out of the box.

### Migrations as objects

Migrations will no longer be classes but instead they'll be objects. An example is given below:

```php
<?php

return $app->forge('Migration')
	->up(function() {
		// do some DB transactions
	})
	->down(function() {
		// undo some DB transactions
	});
```

### Query Builder and ORM removal

We needed to get 'back to basics'. Our business is that of creating a framework and developing a Query Builder and
an ORM alongside that is adding 2 full projects to our main one. There are already many awesome ORMs available that
are not framework specific and would integrate nicely with FuelPHP (Doctrine, RedBean, Propel, etc).

But the Query Builder also needed to go, we have been unsatisfied with it for some time - especially its lack of 
real platform independence. We ended up deciding to replace it with Doctrine's DBAL, a fully featured, heavily 
tested and widely used alternative that does everything we need. FuelPHP will not be tied to DBAL though, but for
libraries like Session there will be a DBAL-based driver available.

### The Static interface

The Kernel and Core packages will no longer contain any static classes at all as those break encapsulation. We are
however aware of how popular they are and how much they facilitate rapid development. For those who do not mind the
limitations (which will be no bigger than those currently imposed by them in 1.x) there is a static interface package
available. This will allow usage like `Validation::forge()` instead of `$this->app->forge('Validation')` but more
importantly they will support all methods available on an instance as a static interface. Thus any method available
on the `Fuel\Core\Validation\Base` object will be available on the `Validation` class through a singleton instance
of Validation inside it.  
This will be done using `__callStatic()` and thus always keep up with any changes to the Core, never lagging behind.

### Legacy support

We'll also provide as much backwards compatibility for 1.x as is possible. This is done by an extra package that
extends the Static package to mimic how they worked before where the interface changed. Some things will need a bit 
of search & replace, though doable project wide if your IDE/texteditor is capable of that. The legacy package should
get this to an absolute minimum though.  
Other things will require a little bit of rewriting, migrations are an example of that as mentioned. Any Core 
extensions will not and cannot be backwards compatible for the most part.

Once we go into beta we will provide two guides on updating:

1. With legacy package activated
2. Without the legacy features actived
