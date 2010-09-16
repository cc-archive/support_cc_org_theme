<div id="profile_header">
   <div id="title" class="block">
       <? theme('user_picture', $account, 'depiction'); ?>
       <? print $profile['user_picture'] ?>
		   <div class="title-labels">
         <h2><?= ($account->profile_name ? $account->profile_name : $account->name) ?></h2>
        <? if($account->profile_location) { ?><h3><?= $account->profile_location ?></h3><? } ?>
        <? if($account->profile_homepage) { ?>
          <a href="<?= $account->profile_homepage ?>"><h3><?= $account->profile_homepage ?></h3></a>
        <? } ?>
       </div>
   </div>
</div>

<div class="profile">

<div class="registrations">
   <div>
     <h4>Works I have licensed</h4>
     <? print $account->content['works']['#children'] ?>
   </div>
</div>
   <h2>My CC Story</h2>
<p>
<?php print nl2br($account->profile_story) ?>
</p>
</div>

