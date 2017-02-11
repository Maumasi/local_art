# Local Art

###### A Symfony project created on January 26, 2017, 8:23 pm. <br>
 A place to discover art markets in your area or an area you're looking to visit.

<br>

## Index

- [Project Notes](#user-content-project-notes)

- [Initializing Project](#user-content-initializing-project)



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
<br>






































## Resources

- [Install Git globally](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)

- [Install Symfony 2.8.x](https://symfony.com/download)

- [Install Composer](https://getcomposer.org/download/)

- [Install Node.js / NPM](https://nodejs.org/en/)

- [Install Gulp.js globally](https://github.com/gulpjs/gulp/blob/master/docs/getting-started.md)



After installing `symfony` and `composer` go to your terminal and enter the following command to install project dependencies:
 ```bash
 $  composer install

 ```
<br>
