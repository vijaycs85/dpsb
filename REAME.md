## Synopsis

Drupal Projects Status Board is a way to monitor modules & themes by generating metadata of them to keep up-to-date with them. We are using [APIs](https://www.drupal.org/drupalorg/docs/api) exposed by [Drupal.org](https://www.drupal.org)


## Design

![Drupal Projects Status Board Control flow](https://cloud.githubusercontent.com/assets/1220029/23928254/a7450d94-0916-11e7-91ef-b6574a50737e.png)

## Motivation

Typical small/medium size Drupal project has ~30 to 50 contributed modules and it's always hard to knowing all (times like when security updates come) & keep up with the development work of them.
This page allows to know current status and also providing version used on a site, gives the latest version available in Drupal.org and used on a site. It certainly helps on multi-site and/or multi-environment projects.


## Installation

Simply clone this repository and update `data/projects.csv` file with modules used on your site(s).

## Screenshot

![Drupal Projects Status Board Screenshot](https://cloud.githubusercontent.com/assets/1220029/23928352/2de8a522-0917-11e7-863d-4479c909d0b5.png)


## Contributors

Feel free to open an [issue](https://github.com/vijaycs85/dpsb/issues/new) and/or [pull request](https://github.com/vijaycs85/dpsb/pulls) to improve, add new features and bug fixes. 

## Future

- Integrate with TravisCI/CircleCI to generate & commit assets to `gh-pages` branch automatically.

## License

This project is distributed under the terms of the [GNU General Public License version 2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
