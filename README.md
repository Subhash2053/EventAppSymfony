Symfony Event Application
========================

Requirements
------------

  * PHP 8.0.2 or higher;
  * node version(v12.10+)
  * PDO_PGSQL PHP extension enabled;
  * and the [usual Symfony application requirements][2].

Installation
------------

[Download Symfony][4] to install the `symfony` binary on your computer


```bash
$ git clone git@github.com:Subhash2053/EventAppSymfony.git
$ cd EventAppSymfony
$ composer install
$ npm install
$ npm run build
$ cp .env.example .env
$ symfony serve
```

Then access the application in your browser at the given URL (<https://localhost:8000> by default).

If you don't have the Symfony binary installed, run `php -S localhost:8000 -t public/`
to use the built-in PHP web server or [configure a web server][3] like Nginx or
Apache to run the application.


# Code overview
Event(url="/event")
-----
- `templates/event/` - Contains all the Event CRUD File
- `src/Controller/EventController` - Contains all the  functions that handles requests     and return a Response object for  Event CRUD  
- `src/Entity/Event` - Contains all the  object of Event data 
-  `src/Form/EventType` - Contains  the  form type for Event along with validation 
-  `src/Repository/EventRepository` - Contains all the  method used in Event
 
AuthEvent(url="/login" and "register")
-----
- `templates/login/` - Contains Login view
- `templates/register/` - Contains Regsiter view
- `src/Controller/LoginController` - Handles login  
-  `src/Controller/RegisterController` - Handles Register  
-   `src/Entity/User` - Contains all the  object of Event data 
-  `src/Form/RegistrationFormType` - Contains  the  form type for User register along with validation 
-  `src/Repository/UserRepository` - Contains all the  method used in User


##  Dependencies
-`jquery`- For ajax call
-`bootstrap`- For design
-`sweetalert2` - For showing messages
> #### Please check the composer.json and package.json file for other dependencies.


[1]: https://symfony.com/doc/current/best_practices.html
[2]: https://symfony.com/doc/current/setup.html#technical-requirements
[3]: https://symfony.com/doc/current/setup/web_server_configuration.html
[4]: https://symfony.com/download
