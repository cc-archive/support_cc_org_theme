
<?php
function cc_progress_total() {
  $campaign_total = file_get_contents('http://creativecommons.org/includes/total.txt');

  print $campaign_total;
}

function showTestimonial() { 
	$url = "https://support.creativecommons.org/testimonials#chrisdibona";
	$utm = "?utm_source=support&utm_medium=testimonial&utm_campaign=fall2009";
?>

<div id="sidebarTestimonial">
	<h3>Join Chris in supporting&nbsp;CC!</h3>
	<p class="quote">
		<a href="<?= $url ?><?= $utm ?>"><img src="https://support.creativecommons.org/images/75/chrisdibona.jpg" align="left" alt="Chris DiBona" border="0" /></a>
		"The use of Creative Commons licensing presents the best way for creative people to share work with each other and through that sharing make the world better for us all."
	</p>
	<p class="source">
		<a href="<?= $url?><?= $utm ?>">&mdash; Chris DiBona</a><br/>
		<small>Google</small><br/>
	</p>
</div>
	<script>jQuery("#sidebarTestimonial").click(function() { window.location="https://support.creativecommons.org/donate<?= $utm ?>"; });</script>
<?php 
	/* end of showTestimonial() */
	return; 
}?>

<?php 
function showThermometer() { 	
	
$utm = "?utm_source=support&utm_medium=thermometer&utm_campaign=fall2009"; ?>

   			<div id="campaign">  
				<div class="progress" onclick="window.location='https://support.creativecommons.org/donate<?= $utm ?>';">
					<span>&nbsp;</span>
				</div>
				<div class="results">
					<a href="https://support.creativecommons.org/donate<?= $utm ?>">
						<?php cc_progress_total() ?> / $500,000 by&nbsp;Dec&nbsp;31 
						<br/>
						<em>Help us reach our goal!</em>
					</a>
				</div>
			</div>

<?php /* end of showThermometer() */ 
	return;
} 


if (isset($_COOKIE['cc_showtestimonial'])) {
	$showTestimonial = $_COOKIE['cc_showtestimonial'];
} else {
	$showTestimonial = rand(0, 1);
}

if ($showTestimonial) {
	showTestimonial();
} else {
	showThermometer();
}
?>


