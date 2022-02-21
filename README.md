# Amazed Blog SiteOrigin Widgets

Amazed Blog SiteOrigin Widgets is a WordPress widgets collection curated for Amazed Blog.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/amazed-blog-so-widgets` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through 'Plugins' screen in WordPress.

## Building

This will compile CSS through PostCSS using TailwindCSS. It watches changes and rebuilds the CSS file accordingly.

1. Install [NodeJS](https://nodejs.org)
2. Browse to plugin folder
3. Run `npm install` & `npm run build`

## Updating

The plugin uses [WP GitLab Updater](https://github.com/krafit/wp-gitlab-updater) to handle automatic update checks. The script pulls the most recent tag from the repository.

1. Edit plugin version e.g. `Version: 1.0.4` in the plugin header under `amazed-blog-so-widgets.php` & commit with a message e.g. `Version bump`
2. List commits & check the commit hash for Step #1 by running `git log --pretty=oneline`. Get/copy the first 7 character from the string e.g. `f52a237`.
3. Run `git tag -a 1.0.4 f52a237 -m "Version updated to 1.0.4"`.
4. Run `git push -u origin master`.
5. Run `git push origin --tags`.

## Notes

1. To be able to use or display category images install [Categories Images](https://wordpress.org/plugins/categories-images/).
2. To be able to update to the latest version, please ensure that the plugin folder name is `amazed-blog-so-widgets` not `amazed-blog-so-widgets-master` or `amazed-blog-so-widgets-1.0.4`. The updater seems to have an issue when the folder structure doesn't match the ones indicated in `includes/updater.php` file.
