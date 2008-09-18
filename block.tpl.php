  <div class="block block-<?php print $block->module; ?>" id="block-<?php print $block->module; ?>-<?php print $block->delta; ?>">
    <?php if ($block->subject) { ?><h4><?= $block->subject; ?></h4><?php } ?>
    <div class="content"><?= $block->content; ?></div>
 </div>
