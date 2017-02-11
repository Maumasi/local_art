# Local Art

###### A Symfony project created on January 26, 2017, 8:23 pm. <br>
 A place to discover art markets in your area or an area you're looking to visit.



<br>

## Index

- [Project Notes](#user-content-project-notes)

- [Getting Started](#user-content-getting-started)

- [Use: Important Directories](#user-content-use-important-directories)

- [MVC](#user-content-mvc)

- [Development](#user-content-development)

- [Resources](#user-content-resources)

---
<br>

## Project Notes

This project makes us of several global installations. The instructions for each global dependency is a link at the bottom of this README file.

This project's work flow uses **feature branch work flow** by utilizing `git`.

---
<br>

## Getting Started
### Initializing Project

In a new directory preform a `git init` and a `git pull` request:
```bash
$ cd path/to/new/root/directory
$ git init
$ git pull https://github.com/Maumasi/local_art.git
```
<br>

After pulling down the project the dependencies need to be installed and configured. <br>

### Install dependencies:
```bash
$ npm install
$ composer install
```
After these lines are executed you will be promoted with `Creating the "app/config/parameters.yml" file` where you will configure the project credentials. All the credentials requested have defaults, you will have to provide the credentials you intend to use. The only default parameter that should not be changed is `image_upload_directory`. Also, the `mailer_*` parameters are not being used in this project but have been left in for future expansion.
<br>

### Create the Database and Tables
Using the parameters provided from the installation enter the following commands to build the database and configure tables:
```bash
$ app/console doctrine:database:create
$ app/console doctrine:schema:update --force
```
**Note:**<br>
If there are errors creating a database, carefully read the error message(s), make sure your database port is running, and check your parameters you provided during installation in `ROOT/app/config/parameters.yml`
<br>

### Starting the Built in Server
To start the built in server execute the following command:
```bash
$ app/console server:run
```
<br>
You can run the server on any IP:port of your choosing by declaring it with the `server:run` command like so:
```bash
# run on localhost with port: 8908
$ app/console server:run 127.0.0.1:8908
```
<br>
At this point the project should be up and running without any errors.

---
<br>

## Use: Important Directories

The directories that are going to be worked in the most, in the order your IDE will likely order them, are:

- `ROOT/app`

- `ROOT/devAssests`

- `ROOT/src`

- `ROOT/web`

---
<br>

## MVC

### Models
Models are known as **Entities** in Symfony. All entity classes are defined in **`ROOT/src/AppBundle/Entity/`** <br>
Every entity class makes efficient use of *Annotations*. If you're not familiar with Annotations and how to use them check out Annotations in the [Resources](#user-content-resources) section.
<br>

Some entities have custom database query methods. These methods are located in `ROOT/src/AppBundle/Repository`<br>
If there is a need to create complex database queries make a class for the query methods that extends a base class of `EntityRepository` if one does not already exist. If you are not familiar with Symfony's Doctrine/ORM queries, check it out in the [Resources](#user-content-resources).
<br>

### The Form Builder
Symfony's form classes are located in `ROOT/src/AppBundle/Form`<br>
Forms can be mapped to an entity class for processing using the configureOptions() method in the form class:
```java
class ArtistRegitration extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('profileImage', FileType::class, [
                'required' => true,
            ])
            ->add('email', EmailType::class)
            ->add('nakedPassword', RepeatedType::class, [
                'type' => PasswordType::class,

            ])
            ->add('businessName', TextType::class, [
                'empty_data' => null,
                'required' => false,
            ])

            ->add('website', UrlType::class, [
                'empty_data' => null,
                'required' => false,
            ])
            ->add('bio', TextType::class, [
                'empty_data' => null,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Artist::class,// <-- form mapped to the Artist entity
            'validation_groups' => ['Default', 'registration'],
        ]);
    }
}
```
**Note:**<br>
If you're not familiar with Symfony's form builder check it out in the [Resources](#user-content-resources) section.

---
<br>

### Views
Views are found in **`ROOT/app/Resources/views/`**<br>
In this directory there are a few subdirectories that help organize the Twig components.
Views are build in components using Twig as the front-end framework. If you're not familiar with Twig check it out in the [Resources](#user-content-resources) section.<br>

`base.html.twig`<br>
This file holds the base HTML wrapper for every view.
<br>

`common/`<br>
This directory holds all the components that will be used across multiple pages such as the `<header>` or the `<footer>`.

`main/`<br>
This directory holds all the views that a site visitor can see

`secure/`<br>
This directory holds all the components that will require an `HTTPS` protocol. These are the views that deal with user credentials.
<br>

---

### Controllers
Controllers are found in **`ROOT/src/AppBundle/Controller/`**<br>
The `MainController.php` manages all the routes and data the site visitor uses.<br>

Secure controllers are in the subdirectory `Secure/`<br>
These controllers manage the routes and data for the account holders.

---
<br>


## Development

### Fixtures
Fixtures provide fake data to the database to aid with development and testing.<br>
To add or edit the fixtures go to `ROOT/src/AppBundle/DataFixtures/ORM/fixtures.yml`<br>
When creating a fixture or editing a fixture, only parameters defined in the entity can be used.<br>
YAML uses a tab deliniated scope, so be carefule with white space.<br>
```yml
AppBundle\Entity\User:    # Entity
  user_{1..10}:   # number of instances (10 users)
    email (unique): <freeEmail()>   
    nakedPassword: '123qwe'
    createdAt: <dateTime()>
    # roles: 'ROLE_USER' <-- commented out
```

**Note:**<br>
If your note familiar with fixtures check it out in the [Resources](#user-content-resources) section.
<br>

### SASS
SASS provides a way for CSS to be dynamic and DRY (Don't Repeat Yourself)<br>
SASS files are located in `ROOT/devAssets/sass`<br>
There are several subdirectory in this path to help keep the styles organized but all SASS files are imported into one single SASS file.<br>

```SASS
// styles.sass

// Google fonts
// =================================================
@import url('https://fonts.googleapis.com/css?family=Lato|Open+Sans|Raleway|Roboto|Slabo+27px')


// base settings
// =================================================
@import "util/reset"
@import "util/base"
@import "util/mixin"
@import "util/var"
```
Any new SASS files need to be imported to the `styles.sass` file.<br>
If you're not familiar with SASS, check it out in the [Resources](#user-content-resources) section.
<br>

### ES6
In this project the one of the main jobs of Javascript is to handle the Google Maps API<br>
ES6 scripts are located in `ROOT/devAssets/Javascript/ES6`.<br>
The main scripts are located at the directory, all supporting scripts are in the subdirectory `lib`. Inside `lib` are several more subdirectories to help organize scripts by what they are or what they do.
Example:

```bash
ES6/
  - app.js
  - lib/
      - classes/
        - Map.js
      - functions/
        - mapOptions.js
      - types/
        - constants.js
```
these scripts do not have to be written in ES6, but if you would like to get up to date with what you can do with ES6 check it out in the [Resources](#user-content-resources) section.
<br>

### Gulp
Gulp is a great and easy to use productivity tool.<br>
The grunt script is located at `ROOT/gulpfile.js`<br>
In this project Gulp is being used to trans-pile SASS into CSS and sends it to the `ROOT/web/css` public directory. It also trans-piles ES6 into legacy Javascript, concatenating all trans-piled Javascript files and then *uglifing* Javascript and creating a file in the `ROOT/web/js` public directory.
<br>

Example:
```Javascript
const gulp = require('gulp'),
    sass = require('gulp-sass'),
    babel = require('gulp-babel'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat');

// compile SASS files
gulp.task('sass', () => {
  // ... some gulp logic ...
});

// compile ES6 to legacy Javascript
gulp.task('compileES6', () => {
  // ... some gulp logic ...
});

// compress all js files into one file
gulp.task('compressAllJS', ['compileES6'], () => {
  // ... some gulp logic ...
});

// uglify the compiled ES6
// This gives us a chance to make changes to the compiled ES6 if we need to
gulp.task('uglyJS', ['compressAllJS'], () => {
  // ... some gulp logic ...
});

// watch for sass file changes on save
gulp.task('watch', () => {
  gulp.watch(['./devAssets/sass/**/*.sass', './devAssets/Javascript/ES6/**/**/*.js'], ['sass', 'uglyJS']);
});

gulp.task('default', ['sass', 'uglyJS', 'watch']);
```
Some of the gulp tasks have a dependency on another task finishing first, so those dependent tasks are called in an array before the self-evoking anonymous function. The `watch` task monitors an array of file paths for changes when they are saved.The `default` task calls the tasks that end up running all the defined tasks.<br>
To run the default gulp task execute the following command:<br>
```bash
# yup, that's it
$ gulp
```
**Note:**
If you're not familiar with Gulp.js, check it out in the [Resources](#user-content-resources) section.

---
<br>

## Resources

### Installations
- [Install Git globally](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

- [Install Symfony 2.8.x](https://symfony.com/download)

- [Install Composer](https://getcomposer.org/download/)

- [Install Node.js / NPM](https://nodejs.org/en/)

- [Install Gulp.js globally](https://gulp.readme.io/docs)

### Miscellaneous

- [Twig: HTML templating](http://twig.sensiolabs.org)

- [Twig: Form Widgets](https://symfony.com/doc/current/form/form_customization.html)

- [Annotations: Routes](https://www.sitepoint.com/getting-started-symfony2-route-annotations/)

- [Annotations: Models](http://symfony.com/doc/2.8/doctrine/reverse_engineering.html)

- [Symfony's Form Builder](http://symfony.com/doc/current/forms.html)

- [Doctrine ORM: Models and Database Queries](http://symfony.com/doc/current/doctrine.html)

- [Fixture Methods](https://github.com/fzaninotto/Faker)

- [Gulp.js: Productivity Automation](https://gulp.readme.io/docs)

- [NPM Modules For Gulp.js](https://www.npmjs.com/search?q=gulp&page=1&ranking=optimal)

- [ES6 features](http://es6-features.org/#Constants)

- [SASS: A Better Work Flow For CSS](http://sass-lang.com/documentation/file.SASS_REFERENCE.html)

---
<br>
