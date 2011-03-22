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

function phptemplate_user_picture($account, $size = 'depiction') {
  if (variable_get('user_pictures', 0)) {
    // Display the user's photo if available
    if ($account->picture && file_exists($account->picture)) {
      $picture = theme('imagecache', $size, $account->picture);
    }
    return '<div class="picture">'.$picture.'</div>';
  }
}

function support2010_theme($existing, $type, $theme, $path) {
  return array(
    // tell Drupal what template to use for the user register form
    'user_register' => array(
      	'arguments' => array('form' => NULL),
      	'template' => 'user-register', // this is the name of the template
    ),
    'user_login' => array(
      'template' => 'user-login',
      'arguments' => array('form' => NULL),
    ),
    'user_login_block' => array (
	    'template' => 'user-login-block',
        'arguments' => array('form' => NULL)
    ),
  );
}

?>
