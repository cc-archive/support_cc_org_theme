<?php 
if (strpos($node->field_css_body[0]['view'], "donate") !== false) {
		$isDonatePage = true;
}

if ($title == 'Access denied' && !$logged_in) {
  header( 'Location: /user?destination=' . substr ($_SERVER['REQUEST_URI'],1 ) ); 
};
?>
<?php include 'page-head-adapter.php'; ?>
<?php include 'cc-wp/header-doctype.php'; ?>
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
 <head profile="http://gmpg.org/xfn/11">
  <title><?php print $head_title ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
  <?php include 'cc-wp/header-common.php'; ?>
  
  <?php if ($isDonatePage || (strpos($_SERVER["REQUEST_URI"], "pcp"))) { ?>
  <link rel="stylesheet" href="<?php print $theme_path; ?>/css/ui-lightness/jquery-ui-1.7.2.custom.css" type="text/css" media="screen" title="no title" charset="utf-8" />
  <?php } ?>

  <?php print $head ?>
  <?php print $styles ?>
  <?php print $scripts;  ?>
  <script type="text/javascript">
  var jc = $.noConflict(true);
  </script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.js"></script>
  <script type="text/javascript">
  var cj = $.noConflict();
  </script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery-ui.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.ba-url.min.js"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/oneclick.js?110126"></script>
  <script type="text/javascript" src="<?php print $theme_path; ?>/js/jquery.marquee.js"></script>
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
	<div id="container">

    <?php include 'page-header.php'; ?>
        <div id="main" role="main">
            <div class="container">
                <div class="sixteen columns">

		        <div class="first row">
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
			<div class="row">
				<?php print $tabs ?>
			</div>
<?php } ?>

		<div class="row">
		<div class="thirteen columns alpha <?php $colClass ?> <?php if ($isDonatePage) { ?> prefix_1 <? }?>">
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
			<div class="three columns omega" id="sidebar-right">
				<?php print $right ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
</div>
<?php include 'page-footer.php'; ?>
</body>
</html>

