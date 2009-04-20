<?php

function support2008_preprocess_node (&$vars) {
		    foreach (array('special_content') as $region) {
		        $vars[$region] = theme('blocks', $region);
		    }
		    return $vars;
}

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

?>
