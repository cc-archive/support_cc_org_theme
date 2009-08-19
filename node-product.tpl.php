<? // Determine the type of node, via taxonomy
   $nterms = taxonomy_node_get_terms($node->nid);
   rsort($nterms);
   //($nterms[0]->name == 'Gift') ? $is_gift = true : $is_gift = false;
   
   if ($nterms[0]->name == 'Gift') { include 'node-gift.tpl.php'; return; }
?>
<div class="node<?php print ($sticky) ? " sticky" : ""; ?>">
  <?php if ($page == 0){ ?>
	<h2><a href="<?= $node_url ?>" title="<?= $title ?>"><?= $title ?></a></h2>
  <?php } ?>
  <?/*= $picture */?>
  <div class="content">
  <?= $content ?>
  </div>
</div>

<pre>
<?php // this will print the $node array at the bottom of each node take it out when finished ?>
<?php var_dump($node); ?>
</pre>
