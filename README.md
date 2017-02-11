# Local Art

###### A Symfony project created on January 26, 2017, 8:23 pm. <br>
 A place to discover art markets in your area or an area you're looking to visit.

<br>

## Index

- [Project Notes](#user-content-project-notes)

- [Initializing Project](#user-content-initializing-project)

- [Use: Important Directories](#user-content-use-important-directories)

- [MVC](#user-content-mvc)



- [Resources](#user-content-resources)

---
<br>

## Project Notes

This project makes us of several global installations. The instructions for each global dependency is a link at the bottom of this README file.

This project's work flow uses **feature branch work flow** by utilizing `git`.

---
<br>


## Initializing Project

In a new directory preform a `git init` and a `git pull` request:
```bash
$ cd path/to/new/root/directory
$ git init
$ git pull https://github.com/Maumasi/local_art.git
```
<br>

After pulling down the project the dependencies need to be installed and configured. <br>

Install dependencies:
```bash
$ npm install
$ composer install
```
After these lines are executed you will be promoted with `Creating the "app/config/parameters.yml" file` where you will configure the project credentials. All the credentials requested have defaults, you will have to provide the credentials you intend to use. The only default parameter that should not be changed is `image_upload_directory`. Also, the `mailer_*` parameters are not being used in this project but have been left in for future expansion.

---
<br>

## Use: Important Directories

The directories that are going to be worked in the most, in the order your IDE will likely order them, are:

- `ROOT/app`

- `ROOT/devAssests`

- `ROOT/src`

- `ROOT/web`

<br>

## MVC

### Models
Models are known as **Entities** in Symfony. All entity classes are defined in **`ROOT/src/AppBundle/Entity/`** <br>
Every entity class makes efficient use of *Annotations*. If you're not familiar with Annotations and how to use them check out Annotations in the [Resources](#user-content-resources) section.
<br>

Entity example:

```java

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArtistRepository")
 * @UniqueEntity(fields={"email"}, message="An artist account already exists with this email")
 * @ORM\Table(name="artist")
 */
class Artist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(type="string", unique=true)
     */
    private $email;


    // getters and setters
    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->email;
    }

    public function setFirstName($email)
    {
        $this->email = $email;
    }
```
<br>

### Views
Views are build in components using Twig as the front-end framework. If you're not familiar with Twig check it out in the [Resources](#user-content-resources) section. 

























## Resources

### Installations

- [Install Git globally](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

- [Install Symfony 2.8.x](https://symfony.com/download)

- [Install Composer](https://getcomposer.org/download/)

- [Install Node.js / NPM](https://nodejs.org/en/)

- [Install Gulp.js globally](https://gulp.readme.io/docs)

### Miscellaneous

- [Twig: HTML templating](http://twig.sensiolabs.org)

- [Annotations: Routes](https://www.sitepoint.com/getting-started-symfony2-route-annotations/)

-[Annotations: Models](http://symfony.com/doc/2.8/doctrine/reverse_engineering.html)

- [Doctrine ORM: Models and Database Queries](http://symfony.com/doc/current/doctrine.html)

- [Fixture Methods](https://github.com/fzaninotto/Faker)

- [Gulp.js: Productivity Automation](https://gulp.readme.io/docs)

- [NPM Modules For Gulp.js](https://www.npmjs.com/search?q=gulp&page=1&ranking=optimal)

- [ES6 features](http://es6-features.org/#Constants)

- [SASS: A Better Work Flow For CSS](http://sass-lang.com/documentation/file.SASS_REFERENCE.html)

---
<br>
