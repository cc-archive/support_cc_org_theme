<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php global $base_url; $theme_path = $base_url .'/'. path_to_theme(); ?>
<?php 
// extract path, remove naything after the first slash so we can use the toplevel 
// name as a css class for the body
$path_as_class = current(explode("/", $node->path));
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>">
 <head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <script src="http://creativecommons.org/includes/icommons.js" type="text/javascript"></script>

<?php /* removing YUI 
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/container/assets/skins/sam/container.css" /> 
  <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
  <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/animation/animation-min.js"></script> 
  <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container-min.js"></script> 
*/ ?>

	<?php /*<script type="text/javascript" charset="utf-8" src="<?php print $theme_path; ?>/site.js"></script>*/ ?>
  
  <?php if (($node->nid == 50) || (strpos($_SERVER["REQUEST_URI"], "pcp"))) { ?>
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/ui-lightness/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />
  <?php } ?>

  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts;  ?>
  
  <?php if (($node->nid == 50) || (strpos($_SERVER["REQUEST_URI"], "pcp"))) { ?>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.ba-url.min.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/oneclick.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.marquee.js"></script>
  <?php } 
//  if (strpos($_SERVER["REQUEST_URI"], "pcp")) { print $scripts; } 
  ?>
  <script type="text/javascript" src="<?php print $theme_path; ?>/support.js"></script>
  
  <!-- Fancybox - http://fancybox.net -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/fancybox/jquery.fancybox-1.2.1.CC.pack.js"></script> 
  <script type="text/javascript" src="<?php print $theme_path; ?>/fancybox/fancybox-go.js"></script>
  <link rel="stylesheet" href="<?php print $theme_path; ?>/fancybox/jquery.fancybox.css" type="text/css" media="screen" />

  <?php if ($node->nid == 61) /* FIXME: Add nid for live site */ { ?>
  <?php /* Sparklines for the analytics/facts and figures page */ ?>
  <script type="text/javascript" src="<?php print $theme_path;?>/js/jquery.sparkline.min.js"></script>
  <?php } ?>

  <link href="<?php print $theme_path; ?>/print.css" rel="stylesheet" media="print" type="text/css" />
  <link href="http://creativecommons.org/includes/total.css?<?= rand()?>" rel="stylesheet" type="text/css" />
  <!--[if IE]><link rel="stylesheet" type="text/css" media="screen" href="<?php print $theme_path ?>/style-ie.css" />
   <style type="text/css">
    img { behavior: url("<?php print $theme_path ?>/pngie.htc"); }
   </style>	
  <![endif]-->
  <script type="text/javascript" src="http://creativecommons.org/wp-content/themes/cc5/site.js"></script> 
</head>
 <body class="yui-skin-sam <?php echo $path_as_class; ?>" <?php print theme("onload_attribute"); ?>>
   <div id="globalWrapper">
     <div id="headerWrapper" class="box">
       <div id="headerLogo">
         <h1><a href="http://creativecommons.org/"><span>Creative Commons</span></a></h1>
       </div>
       <div id="headerNav">
         <ul>
           <!-- <li><em>Home</em></li> -->
           <li><a href="http://creativecommons.org/about/">About</a></li>
           <li><a href="http://creativecommons.org/weblog/">News</a></li>
           <li><a href="https://support.creativecommons.org/">Donate</a></li>
           <li><a href="http://creativecommons.org/faq">FAQ</a></li>
           <li><a href="http://wiki.creativecommons.org/">Wiki</a></li>
           <li><a href="http://creativecommons.org/projects/">Projects</a></li>
           <li><a href="https://support.creativecommons.org/store">Store</a></li>
           <li class="helpLink" id="international_list"><a href="http://creativecommons.org/international/">International</a></li>
         </ul>
      </div>
     </div>

     <div id="mainContent" class="box <?php $classary = explode(" ", $title); print strtolower($classary[0]); ?>">
       <div id="contentPrimary">
     <!-- div id="splash">
      <?php if ($node->field_title_image[0]['fid']) { ?>
      <div class="title-image">
       <?php print theme('imagefield_view_image', $node->field_title_image[0], $node->field_title_image[0]['alt'], $node->field_title_image[0]['title']);  ?>
		  </div>
		  <?php } else if (($title != "") && ($title != "Support the Commons")){ ?>
		  <h2><?php print $title ?></h2>
      <?php } ?>
     </div -->
         <div id="title" class="block">
		   <?php if (strtolower($node->type) != "product") { ?>	
		   <h3 class="category"><a href="/">Support CC</a></h3>
		   <?php } else if ($node->uid == 13) { ?>
			<h3 class="category"><a href="/store">Store</a></h3>
		   <?php } ?>
		   <div class="title-labels">
			 <h2><? if (strtolower($node->type) == "product") { echo current($node->taxonomy)->name . ":"; } ?> <?php print $title ?></h2>
           </div>
		   <h3 class="subtitle"><?php print $node->field_subtitle[0]['view'] ?></h3>
         </div>

<?php if ($features != "") { 
      $colClass = "sideContentSpace"; ?>
      <div id="blocks">  
<?php } ?>
      <div id="" class="block page <?php $colClass ?>">
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
		</div>
      <div id="sideContent" class="content-box"><?php print $features ?></div>
<?php } else { ?>
      </div>
<?php } ?> 
	</div>
	<!-- mainContent --> 
	   <?php #if ($sidebar_right != ""): ?>
	   <?php if ($right != ""): ?>
	 <div class="content-box" id="sidebar-right">
		<?php print $right ?>
	</div>
     <?php endif; ?>
  </div>

  <div id="footer">
    <div id="footerContent" class="box">
    <?php print $footer_message;?>
    <?php print $footer; ?>
    </div>
<!-- footer -->
 <?php print $closure;?>
  </div>
  <script type="text/javascript">var cj = jQuery.noConflict(); $ = cj;</script>
 </body>
</html>
