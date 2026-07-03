# Laravel V.13

How to build a Multi-Component File with Livewire

First of all you create a project.

In the terminal you write this:

```terminal
php artisan make:livewire task.create --mfc
```
>[!NOTE]
> --mfc steht für Multi-file component

Remove the dashboard.blade.php

Depending on which one you want (either header or sidebar) you would need to change the routing.
As a example look at sidebar.blade.php.

In web.php you would also need to change the routing.
In this case like so:

```php
Route::livewire('task/create', 'task.create')->name('task.create');
```

After that you can run:
```terminal
php artisan view:clear
```
<b>Why?</b>
To make sure the new version of (in this case) create.blade.php is loaded and not an old one.

>[!IMPORTANT]
> This is now VERY important!!!
> After the User registers or logs they will still be redirected to /dashboard.
> To change it you would need to go to config/fortify.php.
> In there search for `home`.
> This is the default:
> ```php
> 'home' => '/dashboard',
> ```
> This is how you would need to change it to:
> ```php
> 'home' => '/task/create',
> ```