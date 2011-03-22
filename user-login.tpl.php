<?php if($_GET['destination'] == 'r/add/') : ?>
<p>
  Cataloging your work with the CC Network is not a requirement for applying a Creative Commons license to your work. In order to catalog your work, you must first have a Premium CC Network account by <a href="/donate">donating</a> at least $75. You can learn more about what it means to catalog a work and how to become a Premium member of the CC Network on our <a href="/h/about">About page</a>.
</p>
<?php endif; ?>

<div>
  <?php print drupal_render($form); ?>
</div>
