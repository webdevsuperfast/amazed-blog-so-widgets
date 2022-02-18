<?php

// Include the file with PluginUpdater class.
if ( ! class_exists( 'Moenus\GitLabUpdater\PluginUpdater' ) ) :
  require_once plugin_dir_path(__FILE__ ) . 'includes/updater/plugin-updater.php';
endif;

use Moenus\GitLabUpdater\PluginUpdater as Updater;

// Init the plugin updater with the plugin basename.
new Updater( [
  'slug' => 'amazed-blog-so-widgets',
  'plugin_base_name' => 'amazed-blog-so-widgets/amazed-blog-so-widgets.php',
  'access_token' => 'VeyVxZr6E8y7tze2o5L3',
  'gitlab_url' => 'https://gitlab.com', // GitLab URL
  'repo' => '33799149' // Project ID
] );
