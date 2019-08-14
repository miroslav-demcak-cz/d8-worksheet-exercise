# Worksheet (exercise)

This is Drupal 8 project with custom module to provide:
- Custom content entity representing a work with title, description, solver and dates of the start and the end,
- view (block) named Worksheet at homepage,
- finish operation (added to the Work entity).

It is based on [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project).

The entire development process is evident from separate commit messages (but feel free to ask anything).

## Branches
- Branch **extract** includes mainly files related to assignment to quickly browse my solution (or use some custom installation),
- in **master** branch are all files (as supposed in [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project)) added.

## Installation
- git clone https://github.com/miroslav-demcak-cz/d8-worksheet-exercise.git <your repository>
- cd <your directory>
- composer install
- drush si --existing-config
