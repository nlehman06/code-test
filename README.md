Hello James,

My name is Nathan Lehman and this is my coding exercise submission.  Thanks for taking the time to review this and thanks for your consideration.  If you have any questions, please don't hesitate to get in touch with me at [nathan@nlehman.dev](mailto:nathan@nlehman.dev).

### Install, configure and run
1. Clone the [repository](https://github.com/nlehman06/code-test) from Github
2. Run `composer install`
3. Create the .env and setup your database
4. Run `php artisan migrate`
5. Run `php artisan db:seed`
6. Run `php artisan key:generate`
7. Run `npm install && npm run prod`
8. Serve up the application using `php artisan serve` or however you prefer to serve your local web apps
9. To run the tests: `php artisan test`

### A bit about the app
Obviously there are a ton of different directions I could have went with to make this app.  I ended up going with the new Laravel Sanctum package for handling api authentication.  It is able to handle cookies and tokens simultaneously and seemed like a great choice for this type of app.  This way I could use the regular Laravel way of logging in to the app but still be able to access the api within my Vue components.

If you are unable to get my app to work with your setup, it might be because you're using a domain I didn't add to the Sactum configuration.  For example, I use Laravel Valet to serve up my local applications and so my domain is automatically set to the folder name (i.e. http:://lawline.test).  So you may need to add yours if you are doing something similar.

I also chose to use Laravel for my site/web routing.  In real life, I might have went with an SPA approach and used Vue Router and even seperated the frontend Vue app into it's own repository.  But that wouldn't have been the correct path for this exercise.

Hello Nathan Lehman! Thank you for considering joining the Lawline team. Below is a coding exercise that will allow you
to highlight your skills.

You have up to 48 hours to submit, however, we respect your time and expect this to only take a few hours. Please make
commits reguarly so we can track your progress.

### Getting Started

1. Fork the [code challenge](https://github.com/furthered/code-test) repository on Github
2. Run composer install
3. Perform the configuration for a [fresh install of Laravel](https://laravel.com/docs/7.x)
4. Update the first line of this README with your name (so that it reads "Hello, YOUR NAME!"). Commit this change. This
will serve as a starting timestamp.
5. Complete the exercise below.
6. Commit progress regularly.
7. When your're done, upload your code.
8. Email James [james.terrono@furthered.com](mailto:james.terrono@furthered.com) with any questions/issues

### Requirements

- You have up to 48 hours to submit.
- Create a simple RESTful API written in Laravel/PHP.
    - All responses should be JSON
    - All requests should be JSON
- **Bonus:** UI Interface implemented in a JS Framework

## The Exercise

The exercise consists of **users**, **subscriptions** and **products**. A user will have the ability to add & remove
products within their account. A user must have an active subscription to add a product to their account.

#### Users

Each user must have, but is not limited to:

- ID
- First Name
- Last Name
- Email (unique)

**Please note:**

- These users are the only users that are able to make requests via the API.
- User creation/maintenance is not done through the API (see Database section below).
- Users can own many products

#### Products

Each product must have, but is not limited to:

- ID
- Name
- Description
- Price
- Image

#### Database

- MySQL
- All tables in the database must be created programatically
- The user table should be seeded with at least five users

#### Authentication

You must implement an authentication system so that the API knows which of the users is making the request. All requests should ensure that an authorized user is making the request. In the event of an unauthorized user, an error should be thrown.

#### Requests

The following requests should be implemented:

- Add product
    - All fields required except ID and image
- Update product
    - All fields required except image
- Delete product
- Get product
- Upload product image
- Get list of all products
- Attach product to requesting user
- Remove product from requesting user
- List products attached to requesting user

#### Tests

You must write tests to back up your code. You are free to use any testing tools or frameworks you like.

### UI (Bonus)

Create a simple ui interface, written in your favorite JS Framework (Preferred: VueJS) for a user to

- Authenticate
- View all avaliable products
- Add/Remove products


## Completion

When you are finished you will push up the application to a personal git repo. Then please notify James via email
[james.terrono@furthered.com](mailto:james.terrono@furthered.com?subject=Lawline%20Code%20Challenge) with the subject Lawline Code Challenge and the link to the github repo. Please include:

- Instructions on how to create and seed database tables
- Instructions on how authentication works
- Instructions on how to compile assets (if anything)
- Anything else you think James should know to run the application (if anything)

James is available for any questions you may have via email at james.terrono@furthered.com.

![Good Luck](http://www.reactiongifs.us/wp-content/uploads/2014/01/good_luck_morgan_freeman.gif)
