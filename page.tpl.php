<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php global $base_url; $theme_path = $base_url .'/'. path_to_theme(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language ?>" xml:lang="<?php print $language ?>">
 <head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <script src="http://creativecommons.org/includes/icommons.js" type="text/javascript"></script>
  <?php print $head ?>
  <?php print $styles ?>
  <link href="http://creativecommons.org/includes/progress.css?<?= rand()?>" rel="stylesheet" type="text/css" />
  <!--[if IE]><link rel="stylesheet" type="text/css" media="screen" href="<?php print $theme_path ?>/style-ie.css" />
   <style type="text/css">
    img { behavior: url("<?php print $theme_path ?>/pngie.htc"); }
   </style>	
  <![endif]-->
  
</head>
 <body class="yui-skin-sam" <?php print theme("onload_attribute"); ?>>

  <div id="header-wrapper">
    <div id="header" class="box">
      <a href="http://creativecommons.org/license/" class="cc-actions"><img src="<?php print $theme_path; ?>/images/publish.png" border="0" class="publish"/> <h4>License</h4>Your Work</a>
      <a href="http://search.creativecommons.org/" class="cc-actions"><img src="<?php print $theme_path; ?>/images/find.png" border="0"/> <h4>Search</h4>CC Licensed Work</a>
      <a href="http://creativecommons.org/"><img src="<?php print $theme_path; ?>/images/cc-title.png" alt="creative commons" id="cc-title" border="0"/></a>
    </div>
  </div>
  <div id="mainmenu">
    <ul id="navbar" class="box">
      <li class="inactive"><a href="http://creativecommons.org/" title="Home"><span>Home</span></a></li>
      <li class="inactive"><a href="http://creativecommons.org/about/" title="About"><span>About</span></a></li>      
      <li class="active"><a href="/" title="Support"><span>Support</span></a></li>
      <li class="inactive"><a href="http://creativecommons.org/projects/" title="Projects"><span>Projects</span></a></li>      
      <li class="inactive"><a href="http://creativecommons.org/participate/" title="Participate"><span>Participate</span></a></li>      
      <li class="inactive"><a href="http://creativecommons.org/international/" title="International"><span>International</span></a></li>      
      <li class="inactive"><a href="http://creativecommons.org/contact/" title="Contact"><span>Contact</span></a></li>        
    </ul>
    <div class="clear"></div>
  </div>

  <div class="clear"></div>
  <div class="box">
    <div id="content" >
     <!-- div id="splash">
      <?php if ($node->field_title_image[0]['fid']) { ?>
      <div class="title-image">
       <?php print theme('imagefield_view_image', $node->field_title_image[0], $node->field_title_image[0]['alt'], $node->field_title_image[0]['title']);  ?>
		  </div>
		  <?php } else if (($title != "") && ($title != "Support the Commons")){ ?>
		  <h2><?php print $title ?></h2>
      <?php } ?>
     </div -->
	 <div id="main-content" class="<?php $classary = explode(" ", $title); print strtolower($classary[0]); ?>">
         <div id="title" class="block">
           <div class="title-labels">
			 <h1><?php print $title ?></h1>
			 <h3><?php print $node->teaser ?></h3>
            <? if (strtolower($node->taxonomy[1]->name) == "gift") { ?>
             <h3><a href="/store">Store</a></h3>
            <? } ?>
           </div>
         </div>
       
<?php if ($features != "") { ?>
      <div id="main-content-primary" class="content-box">
<?php } ?>
<?php if ($tabs != ""): ?>
          <?php print $tabs ?>
<?php endif; ?>
        
       <?php if ($help != ""): ?>
       <p id="help"><?php print $help ?></p>
       <?php endif; ?>
        
       <?php if ($messages != ""): ?>
       <div id="message"><?php print $messages ?></div>
       <?php endif; ?>
        
       <!-- start main content -->
       <?php print($content) ?>
       <!-- end main content -->

<?php if ($features != "") { ?>
		  </div>
      <div id="main-content-secondary" class="content-box"><?php print $features ?></div>
<?php } ?> 
     </div>

	<!-- mainContent --> 
	   <?php if ($sidebar_right != ""): ?>
     <div class="content-box" id="sidebar-right"><?php print $sidebar_right ?></div>
     <?php endif; ?>
	  </div>
  </div>

  <div class="clear">&nbsp;</div>
  <div id="footer">
   <?php if ($footer_message) : ?>
   <?php print $footer_message;?>
   <?php endif; ?>
  </div>
<!-- footer -->
 <?php print $closure;?>
 </body>
</html>

