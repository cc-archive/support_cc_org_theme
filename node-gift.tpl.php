<div class="node<?php print ($sticky) ? " sticky" : ""; ?>">
  <div class="block">
    <div class="store-pics">
	 <?= $special_content ?>      
    </div>
	</div>

  <div class="content">
  <?= $content ?>
  </div>
<?php if ($links){ ?>
    <?php if ($picture){ ?>
      <br class='clear' />
    <?php } ?>
  <div class="links"><?= $links ?></div>
<?php } ?>

</div>

