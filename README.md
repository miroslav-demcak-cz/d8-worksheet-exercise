# Worksheet (exercise)

This is Drupal 8 project with custom module to provide:
- Custom content entity representing a work with title, description, solver and dates of the start and the end,
- view (block) named Worksheet at homepage,
- finish operation (added to the Work entity).

It is based on [drupal-composer/drupal-project](https://github.com/drupal-composer/drupal-project).

The entire development process is evident from separate commit messages (but feel free to ask anything).

## Installation
```
git clone https://github.com/miroslav-demcak-cz/d8-worksheet-exercise.git _your-directory_
cd _your-directory_
composer install
drush si --existing-config
```
