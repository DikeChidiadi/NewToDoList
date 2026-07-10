# Laravel V.13

How to build a Multi-Component File with Livewire

First of all you create a project.

In the terminal you write this:

```terminal
php artisan make:livewire todo.create --mfc
```
>[!NOTE]
> --mfc steht für Multi-file component

Remove the dashboard.blade.php

Depending on which one you want (either header or sidebar) you would need to change the routing.
As a example look at sidebar.blade.php.

In web.php you would also need to change the routing.
In this case like so:

```php
Route::livewire('todo/create', 'todo.create')->name('todo.create');
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
> 'home' => '/todo/create',
> ```

If you notice that you would like to rename the folder for example:
I named it Task but I wanted to change it to Todo.
You would need to create it with livewire again with the name you want to change to.
Then the things you have (in this case) in create.blade.php and create.php inside the task folder you just copy and paste it into the todo folder.

## Foreach vs Forelse
`foreach` und `forelse` machen beide eine Schleife über eine Collection/Array, aber `forelse` hat einen eingebaut "leer"-Fall:

**`foreach`** - iteriert (wiederholt) einfach über die Eleente. Ist die Collection leer, passiert einfach nichts (keine Ausgabe), du musst den "leer"-Fall selbst mit einem `if`/`else` davor oder danach abfangen:

```php
@if($todos->isEmpty())
    <p class="text-center">No Todos to do!</p>
@else
    @foreach($todos as $todo)
        <p>{{ $todo->content }}</p>
    @endforeach
@endif
```
**`forelse`** - macht genau das in einem Utsch mit `empty` als eingebautem Else-Zweig:

```php
@forelse($todos as $todo)
    <p>{{ $todo->content }}</p>
@empty
    <p class="text-center">No Todos to do!</p>
@endforelse

```

## Erklärung zu diesem Code

```php
public function createTodo()
{
    auth()->user()->todos()->create(['content' => $this->addContent]);
    $this->todos = auth()->user()->todos;
    $this->addContent = '';
}
```

- `auth()user()->todos()->create(['content'=> $this->addContent]);`
  `auth()->user()` holt den geraden eingeloggten User.
  <br>
  <br>
- `->todos()` greift auf alle Todos zu, die zu diesem User gehören (die Beziehung, die ich vorhin eingerichtet habe.)
  <br>
  <br>
- `->create(['content' => $this->addContent])` legt ein neues Todo in der Datenbank an mit dem Text den der User ins Eingabefeld getippt hat (`$this->addContent`). Das ist die eigentliche Speicherzeile - hier landet der Text in der DB.
  `$this->todos = auth()->user()->todos` holt **alle** Todos des Users **erneut** aus der Datenbank (jetzt inklusive des gerade neu erstellten) und speichert sie in der Property `$todos`. Das sorgt dafür, dass die Liste im Template (`(@forelse ($todos as $todo)`) sich aktualisiert und das neue Todo sofort angezeigt wird.
  `$this->addContent = '';` setzt das Eingabefeld wieder auf leer zurück, damit der User nicht seinen alten Text sieht, sondern ein leeres Feld für den nächsten Eintrag.

## Codeverständnis

```php
public function mount()
{
    $this->todos = auth()->user()->todos;
}

```

_Erklärung:_
 Dieser Code läuft einmal beim ersten Laden der Komponente und lädt alle Todos, die dem eingeloggten User gehören aus der Datenbank in die Eigenschaft (Property) `$todos`. Ohne dem wäre `$todos` beim Seitenaufruf leer egal was in der Datenbank steht.

 ```php
 <flux:button class="w-38">{{ $todo->content }}</flux:button>
 ```
Das ist der Teil, der den Text jedes einzelnen Todos (also `content` aus der Datenbank) tatsächlich auf dem Bildschirm anzeigt - für jedes Element über das die `@forelse`-Schleife läuft. Ohne diese Zeile würde die Schleife zwar korrekt durchlaufen, aber es wäre kein Text sichtbar.
`Mount` sorgt dafür, dass die Todos geladen werden.