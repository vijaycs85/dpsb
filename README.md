## Synopsis

Drupal Projects Status Board is a way to monitor modules & themes used in your project. All data retrieved from [Drupal.org](https://www.drupal.org) using [APIs](https://www.drupal.org/drupalorg/docs/api).


## Design

![Drupal Projects Status Board Control flow](https://cloud.githubusercontent.com/assets/1220029/23928254/a7450d94-0916-11e7-91ef-b6574a50737e.png)

## Motivation

Typical small/medium size Drupal projects have ~30 to 50 contributed modules and it is hard to know them all to validate around times like security updates and keep up with the development / new versions of them. It is certainly very helpful for managing multi site and multi environment situations.


## Installation

Simply clone this repository and update `data/projects.csv` file with modules used on your site(s).

## Screenshot

![Drupal Projects Status Board Screenshot](https://cloud.githubusercontent.com/assets/1220029/23928352/2de8a522-0917-11e7-863d-4479c909d0b5.png)


## Demo

Checkout [gh-pages](https://vijaycs85.github.io/dpsb/) of this repository for sample output. It is possible to get additional details as well. Check generated [metadata](https://vijaycs85.github.io/dpsb/project-metadata.json) file for additional details available.  


## Contributors

Feel free to open an [issue](https://github.com/vijaycs85/dpsb/issues/new) or [pull request](https://github.com/vijaycs85/dpsb/pulls) to improve, add new features and bug fixes.

## Future

- Integrate with TravisCI/CircleCI to generate & commit assets to `gh-pages` branch automatically.

## License

This project is distributed under the terms of the [GNU General Public License version 2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
