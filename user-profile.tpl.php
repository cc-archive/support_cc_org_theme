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

       <div class="green-box">
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

       <div class="green-box">   
         <h4>Place this badge on your website</h4>
          <? print $account->content['badge']['#children'] ?>
       </div>
       <br />

<? } ?>

<? if ( $account->content['works'] ) { ?>
   <div class="green-box">
     <h4>Works I have licensed</h4>
     <? print $account->content['works']['#children'] ?>
   </div>
<? } ?>

</div>

<? if ($user->uid == $account->uid) { ?>     
   <h2>Profile Information</h2>
     <small>Information published on your public profile.</small>
   <dd><fieldset>
     <strong>Your name</strong>
     <p><? print $account->profile_name ?></p>
     <strong>Your location</strong>
     <p><? print $account->profile_location ?></p>
     <strong>Your homepage</strong>
     <p><? print $account->profile_homepage ?></p>
     <strong>Your story</strong>
     <p><? print nl2br($account->profile_story) ?></p>
   </fieldset></dd>
     &raquo; <a href="/<?=$account->name?>/edit/Profile%20Information">Edit 'Profile Information'</a>
   
   <div class="divider">&nbsp;</div>

   <h2>Contact Information</h2>
     <small>This information is for the internal use of CC and will not be made public on your profile.</small>
      <? print $account->content['Contact Information']['#children'] ?>

   <div class="divider">&nbsp;</div>

   <h2>Discussion Lists</h2>
     <small>Subscribe to our different mailing lists.</small>
     <? print $account->content['Email Lists']['#children'] ?>

<? } else { ?>

   <h2>My CC Story</h2>
   <p>
     <?php print nl2br($account->profile_story) ?>
   </p>

<? } ?>
</div>

