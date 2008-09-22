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

?>
