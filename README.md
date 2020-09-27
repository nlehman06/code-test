Hello James,

My name is Nathan Lehman and this is my coding exercise submission.  Thanks for taking the time to review this and thanks for your consideration.  If you have any questions, please don't hesitate to get in touch with me at [nathan@nlehman.dev](mailto:nathan@nlehman.dev).

## Install, configure and run
1. Clone the [repository](https://github.com/nlehman06/code-test) from Github
2. Run `composer install`
3. Create the .env and setup your database
4. Run `php artisan migrate`
5. Run `php artisan db:seed`
6. Run `php artisan key:generate`
7. Run `npm install && npm run prod`
8. Serve up the application using `php artisan serve` or however you prefer to serve your local web apps
9. To run the tests: `php artisan test`

## A bit about the app
Obviously there are a ton of different directions I could have went with to make this app.  I ended up going with the new [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum) package for handling api authentication.  It is able to handle cookies and tokens simultaneously and seemed like a great choice for this type of app.  This way I could use the regular Laravel way of logging in to the app but still be able to access the api within my Vue components.

If you are unable to get my app to work with your setup, it might be because you're using a domain I didn't add to the Sactum configuration.  For example, I use [Laravel Valet](https://laravel.com/docs/8.x/valet) to serve up my local applications and so my domain is automatically set to the folder name (i.e. http:://lawline.test).  So you may need to add yours if you are doing something similar.

I also chose to use Laravel for my site/web routing.  In real life, I might have went with an SPA approach and used [Vue Router](https://router.vuejs.org/) and even seperated the frontend Vue app into it's own repository.  Or another route that I would prefer is to use [Laravel Livewire](https://laravel-livewire.com/) and get all the frontend goodness of a javascript app but keep all the code in the backend.  But those wouldn't have been the correct paths for this exercise.

I did choose to do the *bonus* of writing the frontend in Vue JS and [Tailwind CSS](https://tailwindcss.com/).  This was somewhat thrown together so that it does the minimum to work.  There is plenty more that could be done that I just didn't have time to do (error messages and validation, frontend testing, cleaner handling of axios, etc.).

Well, I hope you enjoy the app.  I had fun building it.  Again, let me know if you have any questions at [nathan@nlehman.dev](mailto:nathan@nlehman.dev).
