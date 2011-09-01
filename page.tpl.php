<?php 
if (strpos($node->field_css_body[0]['view'], "donate") !== false) {
		$isDonatePage = true;
}

if ($title == 'Access denied' && !$logged_in) {
  header( 'Location: /user?destination=' . substr ($_SERVER['REQUEST_URI'],1 ) ); 
};
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php global $base_url; $theme_path = $base_url .'/'. path_to_theme(); ?>
<html xmlns="http://www.w3.org/1999/xhtml" 
  xmlns:cc="http://creativecommons.org/ns#"
  xmlns:ccnet="http://creativecommons.net/n#"
  xmlns:sioc="http://rdfs.org/sioc/ns#"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
  xmlns:dct="http://purl.org/dc/terms/"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema#"
  xmlns:sioc_service="http://rdfs.org/sioc/services#"
  xmlns:powder="http://www.w3.org/2007/05/powder#"
  lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>">
 <head>
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
<?php /* removing YUI 
  <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.5.2/build/container/assets/skins/sam/container.css" /> 
  <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/yahoo-dom-event/yahoo-dom-event.js"></script> 
  <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/animation/animation-min.js"></script> 
  <script type="text/javascript" src="http://yui.yahooapis.com/2.5.2/build/container/container-min.js"></script> 
*/ ?>

	<?php /*<script type="text/javascript" charset="utf-8" src="<?php print $theme_path; ?>/site.js"></script>*/ ?>
  
  <?php if ($isDonatePage || (strpos($_SERVER["REQUEST_URI"], "pcp"))) { ?>
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/ui-lightness/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />
  <?php } ?>

  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts;  ?>
  
  <?php  /*if ($isDonatePage || (strpos($_SERVER["REQUEST_URI"], "pcp"))) { */?>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.ba-url.min.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/oneclick.js?110126"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.marquee.js"></script>
  <?php  
//  if (strpos($_SERVER["REQUEST_URI"], "pcp")) { print $scripts; } 
  ?>
  <script type="text/javascript" src="<?php print $theme_path; ?>/support.js"></script>
  
  <!-- Fancybox - http://fancybox.net -->
  <script type="text/javascript" src="<?php print $theme_path; ?>/fancybox/jquery.fancybox-1.2.1.CC.pack.js"></script> 
  <script type="text/javascript" src="<?php print $theme_path; ?>/fancybox/fancybox-go.js"></script>
  <link rel="stylesheet" href="<?php print $theme_path; ?>/fancybox/jquery.fancybox.css" type="text/css" media="screen" />

  <?php if (($node->nid == 61) || ($node->nid == 62)) { ?>
  <?php /* Sparklines for the analytics/facts and figures page */ ?>
  <script type="text/javascript" src="<?php print $theme_path;?>/js/jquery.sparkline.min.js"></script>
  <?php } ?>

  <link href="<?php print $theme_path; ?>/print.css" rel="stylesheet" media="print" type="text/css" />
  <!--[if lt IE 7]><link rel="stylesheet" type="text/css" media="screen" href="<?php print $theme_path ?>/style-ie.css" />
   <style type="text/css">
    img { behavior: url("<?php print $theme_path ?>/pngie.htc"); }
   </style>	
  <![endif]-->
  <script type="text/javascript" src="<?php print $theme_path ?>/site.js"></script> 

  <link about="/" rel="sioc_service:has_service" href="/r/lookup" />
  <link about="/r/lookup" rel="sioc_service:service_protocol" href="http://wiki.creativecommons.org/work-lookup" />

</head>
 <body class="yui-skin-sam <?php echo $node->field_css_body[0]['view']; ?>" <?php print theme("onload_attribute"); ?>>

	<a id="top"></a>
	<div id="header" class="container_16">
		<div class="container_16">
			<div class="grid_16 ">
				<h1 id="logo"><a href="http://creativecommons.org/"><span>Creative Commons</span></a></h1>

				<ul class="nav">
					<li><a href="http://creativecommons.org/about">About</a></li>
					<li><a href="http://creativecommons.org/weblog/">Blog</a></li>
					<li><a href="https://creativecommons.net/donate">Donate</a></li>
					<li><a href="http://wiki.creativecommons.org/FAQ">FAQ</a></li>
					<li><a href="http://wiki.creativecommons.org/">Wiki</a></li>
					<li><a href="http://creativecommons.org/affiliates">International</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div id="page">
		<div id="title" class="container_16">
			<div class="grid_16">
				<?php if ($isSuperhero) {?>
				<h3 class="category"><a href="/superheroes"><img src="<?php print $theme_path; ?>/images/superhero/cc-superhero-hero-small.png" alt="[CC]" border="0" /> <span>Superheroes</span></a></h3>
				<?php } else if (strtolower($node->type) != "product") { ?>	
				<h3 class="category"><a href="/">Support CC</a></h3>
				<?php } else if ($node->uid == 13) { ?>
				<h3 class="category"><a href="/store">Store</a></h3>
				<?php } ?>
				<?php if ($isSuperheroIndex) { ?>
				<div class="title-labels superheroTitle">
					<h2><img src="<?php print $theme_path; ?>/images/superhero/cc-superhero-hero.png" alt="[CC]" border="0" /> <span>Superheroes</span></h2>
				<?php } else { ?>
				<div class="title-labels">
					<h1><? if (strtolower($node->type) == "product") { echo current($node->taxonomy)->name . ":"; } ?> <?php print $title ?></h1>
				<?php } ?>
				</div>
			</div>
		
<?php if ($tabs != "") { ?>
			<div class="grid_16">
				<?php print $tabs ?>
			</div>
<?php } ?>
		</div>



		<div class="container_16">
		<div id="" class="block page <?php $colClass ?> <?php if ($isDonatePage) { ?> prefix_1 <? }?> grid_13">
				<?php if ($help != ""): ?>
				<p id="help"><?php print $help ?></p>
				<?php endif; ?>

				<?php if ($messages != ""): ?>
				<div id="message"><?php print $messages ?></div>
				<?php endif; ?>

				<?php if($title == "Access denied" && strstr( $_SERVER['REQUEST_URI'], 'https://creativecommons.net/') == '/r/add/') { ?>

				<h3>The ability to catalogue works on the CC Network is a feature only available to those with a premium account.</h3>
				<h4>To catalogue your own works, please consult our <a href="/donate/?utm_source=join&utm_campaign=upsell">donate</a> page for more information.</h4>

				<h4>If you have recently made a donation to Creative Commons and are seeing this message, there may be an issue with your account. To verify that we have a correct record of your contribution history, please consult our <a href="/a/redeem">account renewal page</a>.</h4>

				<?php } ?>
				
				<!-- start main content -->
				<?php print($content) ?>
				<!-- end main content -->

			</div>
			
			<?php if ($right != ""): ?>
			<div class="grid_3" id="sidebar-right">
				<?php print $right ?>
			</div>
			<?php endif; ?>
		</div>
	</div>

  <div id="footer">
		<div class="container_16">
				<div class="grid_2 alpha" id="top_link"><a href="#top">&#8682;</a></div>
			<div class="clear"></div>
			<div class="grid_6">
				<h4>Creative Commons</h4>
				<dl class="grid_2 alpha">
					<dt><a href="http://creativecommons.org/about">About</a></li>
					<dt><a href="http://creativecommons.org/who-uses-cc">Who Uses CC?</a></li>
					<dt><a href="http://creativecommons.org/culture">Culture</a></li>
					<dt><a href="http://creativecommons.org/education">Education</a></li>
					<dt><a href="http://creativecommons.org/science">Science</a></li>
				</dl>
				<dl class="grid_2">
					<dt><a href="http://creativecommons.org/weblog">Blog</a></li>
					<dt><a href="http://wiki.creativecommons.org/Case_Studies">Case Studies</a></li>
					<dt><a href="http://creativecommons.org/interviews">CC Talks With...</a></li>
					<dt><a href="http://creativecommons.org/newsletter">Newsletters</a></li>
					<dt><a href="http://creativecommons.org/about/downloads">Downloads</a></li>
				</dl>
				<dl class="grid_2 omega">
					<dt><a href="http://creativecommons.org/affiliates">International</a></li>
					<dt><a href="http://wiki.creativecommons.org/Events">Events</a></li>
					<dt><a href="http://creativecommons.org/about/people">People</a></li>
					<dt><a href="http://creativecommons.org/about/press">Press Room</a></li>
					<dt><a href="http://creativecommons.org/contact">Contact</a></li>
				</dl>
			</div>
			<div class="grid_2 prefix_1">
				<h4>Licensing</h4>
				<dl class="grid_2 alpha omega">
					<dt><a href="http://creativecommons.org/licenses">The Licenses</a></li>
					<dt><a href="http://creativecommons.org/choose">Choose License</a></li>
					<dt><a href="http://wiki.creativecommons.org/FAQ">FAQ</a></li>
					<dt><a href="http://search.creativecommons.org/">Find Content</a></li>
					<dt><a href="http://wiki.creativecommons.org/Developers">Developers</a></li>
				</dl>
			</div>
			<div class="grid_2 prefix_1 suffix_1">
				<h4>Supporting CC</h4>
				<dl class="grid_2 alpha omega">
					<dt><a href="https://creativecommons.net/donate">Donate</a></li>
					<dt><a href="https://creativecommons.net/store">Store</a></li>
					<dt><a href="https://creativecommons.net/supporters">Supporters</a></li>
					<dt><a href="https://creativecommons.net/corporate">Corporate Giving</a></li>
					<dt><a href="https://creativecommons.net/figures">Facts &amp; Figures</a></li>
				</dl>
			</div>
			<div class="grid_3 social alpha omega">
				<dl class="social_links">
					<dt><a href="https://creativecommons.net/civicrm/mailing/subscribe?reset=1&gid=121">Subscribe to Newsletter</a></li>
					<dt class="fb"><iframe src="https://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fcreativecommons.org&amp;layout=button_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;colorscheme=light&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:150px; height:21px;" allowTransparency="true"></iframe></li>
					<dt><a href="http://twitter.com/creativecommons">Follow on Twitter</a></li>
					<dt><a href="http://identi.ca/creativecommons">Follow on Identi.ca</a></li>
				</dl>
			</div>
		</div>
		<div class="container_16" id="footer_license">
		  <?php print $footer_message;?>
		  <?php print $footer; ?>
		</div>
  </div>
<!-- footer -->
 <?php print $closure;?>
  <script type="text/javascript">var cj = jQuery.noConflict(); $ = cj;</script>

<?php
  if ( ! (preg_match('/openid\/provider/', $_SERVER['REQUEST_URI']) ||
       preg_match('/openid\/provider/', $_SERVER['HTTP_REFERER'])) ) {
    $ga_code = <<<GACODE
  <script type="text/javascript">
    var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
    document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
  </script>
  <script type="text/javascript">
    var pageTracker = _gat._getTracker("UA-2010376-4");
    pageTracker._trackPageview();
  </script>
GACODE;
    echo $ga_code;
  }
?>


 </body>
</html>

