<? // Determine the type of node, via taxonomy
//$nterms = taxonomy_node_get_terms($node->nid);
	$nterms = $node->taxonomy;
   rsort($nterms);
   //($nterms[0]->name == 'Gift') ? $is_gift = true : $is_gift = false;

   if ($nterms[0]->name == 'Gift') { include 'node-gift.tpl.php'; return; }
?>
<div class="node<?php print ($sticky) ? " sticky" : ""; ?>">
  <?php if ($page == 0){ ?>
    <h2><a href="<?= $node_url ?>" title="<?= $title ?>"><?= $title ?></a></h2>
  <?php } ?>
  <?= $picture ?>
  <div class="info"><?= $submitted ?></div>
  <div class="content">
  <?= $content ?>
  </div>
<?php if ($links){ ?>
    <?php if ($picture){ ?>
      <br class='clear' />
    <?php } ?>
  <div class="links"><?= $links ?></div>
<?php } ?>
<?php if ($terms){ ?>
  <div class="terms">( categories: <?= $terms ?> )</div>
<?php } ?>
</div>
