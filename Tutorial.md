# Tutorial

Example installation of a portfolio type website. Take a look at the repo commit's

__Disclaimer__  
The template is a free HTML5 Theme from https://freehtml5.co/

## Getting started

To get started install a fresh copy of ProcessWire (preferably [2.8](https://github.com/ryancramerdesign/pw28)). Then install the [Migrations module](https://lostkobrakai.github.io/Migrations/installation/) (so it's installed in the db) and copy the git repo files in the root of your installation.

## Step 1 

> `git checkout 62fcd5e91b31503a81547c15775fa61a3701d8c2 .`

This commit does only add the theme's files to the repo in `site/templates/`. As the `site/config.php` is not part of the repo, please add this to the end manually.

```php
$config->appendTemplateFile = '_main.php';
```

## Step 2

> `git checkout be518c0022e0e0f457e1573eab2f0794881a0943 .`

After taking a look at the project's page of the theme I defined the need for the following fields.

- A title field (already available)
- A textarea to hold the "stylized" title with the <span> to change the font.s
- A summary textarea (without markup) for the homepage summary paragraph.
- A markup textarea for the description and one for the process part
- A images field to hold all the images displayed in various places.
- A field to store the testimony
- A field to store the roles
- A url field for the weblink
- A pagefield to allow for manual selection of related projects

In the first set of migrations the bulk creation of those fields are covered, as well as the creation of the accompanied template. Take a look at the migrations and run them on by one either via the Backend or the CLI. You can also rollback any of those to see their changes being revoked/reversed. 

In the end you can go ahead and create your first (dummy) project and see the data being reflected on the frontend. 

## Step 3

> `git checkout 9854aa3d6c955c3bd318ac4ab60b66f3443e821b .`

As you may have noticed, there where some errors in my first batch of migrations. I cloned the description field to create the process field. I changed the name, but left the label and description unchanged. 
Now as the migration file is already run on differnt systems I cannot simply fix them in place and hope everybody does notice the change and remigrate. The better option is simply to fix those in new migrations, which is the only thing new in this commit. A change to the field and some column width change to nicely put the url and role field side by side.

## Step 4

> `git checkout 119096fe047992a6c02f6166311d525488a8874c .`

Now we've already have limited the CKEditor fields quite a bit, but I'll add special "Styles" dropdowns to specifically cater the styles to the requirements of my theme and additionally also add custom styles to make those visible in the backend as well.
So the changes where again mostly in new migration files, but also the files in `site/modules/InputfieldCKEditor/`.

## Step 5

> `git checkout 92fc0b952a5f957a8c2feaba1759d46507ee40ba .`

And again I missed something, which I only catched after pushing (and deploying for testing purposes). So it'll be a new migrations again, which does edit the mystyles setting of the textareas and I also added a special styling for the `<span>` in the styled title field.

## Step 6

> `git checkout 3077daae0ce9f5aa0d56d59008228e00c848919c .`

As I've by now only implemented a subset of the project's information display by the theme it's now time to add an image field.
It's mostly a straight forward integration, but somehow one does need to manually save the image field in the backend before it's usable.

I just wanted to add this here. At all time your custom dummy project was never deleted or overwritten, which is exactly how migrations will behave if you run them on a live website, where content will be created, while you're developing features.

## Step 7

> `git checkout 0ded2f63f41fa5a0d8e23ef4c0daceb75fb5d9d8 .`

And the last missing piece of data for the projects, the testimonial. After a bit of thought on how to best implement it here, without getting to far I decided on a simple textarea devided by a line of 3 dashes. 

## Step 8

> `git checkout 92bcc603f4514323be2730438fd8e61b3e149e39 .`

Implemented the bio page.