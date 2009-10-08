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
  <?/*= $picture */
	$hero_image = end($node->field_image_cache);
  ?>
  <div class="content">
		<div class="product-image"><img src="/sites/default/files/imagecache/product_hero/<?php echo $hero_image['filepath'];?> "/> </div>
		<div class="product-details">
		  <h2><?php print uc_currency_format($node->sell_price); ?></h2>
   		  <p><?php print $node->content['add_to_cart']['#value']; ?></p>
		</div>
		<div class="product-pictures">
<?php foreach ($node->field_image_cache as $images) { 
		if ($images['list'] == "1") { ?>
		<a rel="fancybox" class="fancybox" title="<?php print $images['data']['title'] ?>" href="<?php /*/sites/default/files/imagecache/product_hero/*/?>/<?php print $images['filepath']; ?>"><img src="/sites/default/files/imagecache/product/<?php print $images['filepath']; ?>" alt="<?php print $images['data']['alt']; ?>" border="0" /></a>
<?php } } ?>
		</div>

  </div>
</div>
<?php /*
<pre>
<?php // this will print the $node array at the bottom of each node take it out when finished ?>
<?php var_dump($node); ?>
</pre>
*/?>
