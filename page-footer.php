    <?php include 'cc-wp/page-footer.php'; ?>
    <?php include 'cc-wp/footer-codes.php'; ?>
    <?php print $closure;?>
  <script type="text/javascript">var cj = jQuery.noConflict(); $ = cj;</script>
<?php
  if ( ! (preg_match('/openid\/provider/', $_SERVER['REQUEST_URI']) ||
       preg_match('/openid\/provider/', $_SERVER['HTTP_REFERER']) ||
       preg_match('/o\/endpoint/', $_SERVER['REQUEST_URI'])) ) {
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
