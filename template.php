<?php
function phptemplate_image_gallery($galleries, $images) {
  return _phptemplate_callback('image_gallery', array('galleries' => $galleries, 'images' => $images));
}

/**
 * Define regions for block placement
 */
function support2008_regions() {
  return array(
       'special_content' => t('special content'),
       'left' => t('left sidebar'),
       'right' => t('right sidebar'),
       'content' => t('content'),
       'features' => t('features'),
       'header' => t('header'),
       'footer' => t('footer'),
  );
}

function phptemplate_menu_item($mid, $children = '', $leaf = TRUE) {
  if (file_exists($image_path = drupal_get_path('theme','ccidtheme')."/images/menu_item/$mid.png")) {
    $menu_image = theme('image',$image_path);
  }
  return '<li class="'. ($leaf ? 'leaf' : ($children ? 'expanded' : 'collapsed')) .'">'.$menu_image. menu_item_link($mid) . $children ."</li>\n";
} 

function _phptemplate_variables($hook, $variables) {
  if ($hook == 'node') {
    foreach (array('special_content') as $region) {
      $variables[$region] = theme('blocks', $region);
    }
  }

  return $variables;
}

function phptemplate_maintenance_page($content, $messages = TRUE, $partial = FALSE) {
  drupal_set_header('Content-Type: text/html; charset=utf-8');
  drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() . path_to_theme() .'/maintenance.css";</style>');
  drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() . drupal_get_path('module', 'system') .'/defaults.css";</style>');
  drupal_set_html_head('<style type="text/css" media="all">@import "'. base_path() . drupal_get_path('module', 'system') .'/system.css";</style>');
  drupal_set_html_head('<link rel="shortcut icon" href="'. base_path() .'misc/favicon.ico" type="image/x-icon" />');

  $output = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n";
  $output .= '<html xmlns="http://www.w3.org/1999/xhtml">';
  $output .= '<head>';
  $output .= ' <title>'. strip_tags(drupal_get_title()) .'</title>';
  $output .= drupal_get_html_head();
  $output .= drupal_get_js();
  $output .= '</head>';
  $output .= '<body>';
  $output .= '<h1>' . drupal_get_title() . '</h1>';

  if ($messages) {
    $output .= theme('status_messages');
  }
  
  $output .= "\n<!-- begin content -->\n";
  $output .= $content;
  $output .= "\n<!-- end content -->\n";
    if (!$partial) {    $output .= '</body></html>';
  }
  
  return $output;
}

?>
