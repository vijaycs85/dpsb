[![Build Status](https://travis-ci.org/vijaycs85/dpsb.svg?branch=master)](https://travis-ci.org/vijaycs85/dpsb)

## Synopsis

Drupal Projects Status Board is a way to monitor modules & themes used in your project. All data retrieved from [Drupal.org](https://www.drupal.org) using available [APIs](https://www.drupal.org/drupalorg/docs/api).


## Design

![Drupal Projects Status Board Control flow](https://cloud.githubusercontent.com/assets/1220029/24326684/84151eac-11ab-11e7-9157-e15ffdf89fc3.png)

## Motivation

Typical small/medium size Drupal project has ~30 to 50 contributed modules and it is hard to know them all to validate around times like security updates and keep up with the development / new versions of them. It is certainly harder when managing more than one site.


## Installation

Simply clone this repository and update `data/projects.csv` file with modules used on your site(s).

### Generate project.csv

The projects CSV file provides list of projects to monitor. This can be generated by below drush command on your Drupal installation

```
(echo "Project,Version" &&  drush pmpi --format=csv --fields=label,version) > ../dpsb/data/projects.csv
```

Note:
> The echo command is to add header to CSV. Makes sure the label/name field is represented as Project. The CSV can have addition fields(like version number) just to display on the table but make sure you are not adding them with reserved header keys (Maintainers, Versions, Details) and add the fields as <th> in index.html.

## Screenshot

![Drupal Projects Status Board Screenshot](https://cloud.githubusercontent.com/assets/1220029/24326705/3d97dfea-11ac-11e7-88a4-8c25ccd7383d.png)


## Demo

Checkout [gh-pages](https://vijaycs85.github.io/dpsb/) of this repository for sample output. Check generated [metadata](https://vijaycs85.github.io/dpsb/project-metadata.json) file for additional details available.

## Refresh
Integrated with [TravisCI](https://travis-ci.org/vijaycs85/dpsb) to refresh daily and every push to master.

## Contributors

Feel free to open an [issue](https://github.com/vijaycs85/dpsb/issues/new) or [pull request](https://github.com/vijaycs85/dpsb/pulls) to improve, add new features and bug fixes.


## License

This project is distributed under the terms of the [GNU General Public License version 2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
