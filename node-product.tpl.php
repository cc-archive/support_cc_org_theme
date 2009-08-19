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
 	<table>
	  <tr>
		<td><img src="/sites/default/files/imagecache/product_hero/<?php echo $hero_image['filepath'];?> "/> </td>
		<td>
		  <h2><?php print uc_currency_format($node->sell_price); ?></h2>
   		  <p><?php print $node->content['add_to_cart']['#value']; ?></p>
		</td>
	  </tr>
	  <tr>
		<td colspan="2">
<?php foreach ($node->field_image_cache as $images) { 
		if ($images['list'] == "1") { ?>
		<img src="/sites/default/files/imagecache/product/<?php print $images['filepath']; ?>" alt="<?php print $images['data']['title']; ?>" />
<?php } } ?>
		<td>
	  </tr>
	</table>

  </div>
</div>
<?/*
<pre>
<?php // this will print the $node array at the bottom of each node take it out when finished ?>
<?php var_dump($node); ?>
</pre>
*/?>
