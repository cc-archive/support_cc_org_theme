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

<div class="profile-side">

<? if ($user->uid == $account->uid && in_array('Commoner', array_values($user->roles))) { 
         // is the user logged in at their own profile page ?>

       <div>
         <h4>Your OpenID URL</h4>
         <input onclick="this.select()" readonly="readonly" value="https://creativecommons.net/<?=$user->name?>" type="text">

		<p>
		  <small>
		    Use this URL to log into OpenID enabled sites.
		    
		    <strong>
		      To reduce risk of attack we  recommend using HTTPS for your OpenID URL.
		    </strong>
		    
		  </small>
		</p>
       </div>
       <br />

       <div>   
         <h4>Place this badge on your website</h4>
          <? print $account->content['badge']['#children'] ?>
       </div>
       <br />

<? } ?>

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

