<?php

function phptemplate_menu_item($link, $has_children, $menu = '', $in_active_trail = FALSE, $extra_class = NULL) {
  $class = ($menu ? 'expanded' : ($has_children ? 'collapsed' : 'leaf'));
  if (!empty($extra_class)) {
    $class .= ' '. $extra_class;
  }
  if ($in_active_trail) {
    $class .= ' active-trail';
  }
  return '<li class="'. $class .'">'. $link . $menu ."</li>\n";
}

function support2009_theme($existing, $type, $theme, $path) {
  return array(
    // tell Drupal what template to use for the user register form
    'user_register' => array(
      'arguments' => array('form' => NULL),
      'template' => 'user_register', // this is the name of the template
    ),
  );
}

?>
