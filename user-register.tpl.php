<div id="registration_form">
<? 
   echo $messages;
   echo drupal_render($form['timezone']);
   echo drupal_render($form['form_build_id']);
   echo drupal_render($form['form_id']);
?>
<div class="field">
    <?= drupal_render($form['account']['name']); ?>
  </div>
  <div class="field">
    <?= drupal_render($form['account']['mail']); ?>
  </div>
  <div class="field">
     <div id="tou" style="height:400px;overflow-y:scroll;margin:20px 0;border:1px #ccc solid;padding:10px;">
     <h1>TERMS OF USE</h1>
     <? 
     $tou = node_load(arg(1,drupal_get_normal_path('h/policies/tou')));
     print $tou->field_body[0]['value'] ;
     ?>
     </div>
  </div>
  <div class="field">
      <input type="checkbox" name="kapeesh" id="kapeesh" onclick="$('#edit-submit').toggleClass('disabled')" />
      <label for="kapeesh">By agreeing to the Terms of Use you affirm you are at least 13 years of age. If you are between 13 years old and the age of majority in your jurisdiction, you affirm that you have obtained your parent's or legal guardian's express permission to create an account as required by CC.</label>
  </div>
  <div class="field">
<? 
  $form['submit']['#attributes']['disabled'] = '';
  $form['submit']['#attributes']['class'] = 'submit-disabled';
  print drupal_render($form['submit']); 
?>
<script>
$(document).ready(function() {
        $('#kapeesh').click(function() {
                $('#edit-submit').toggleClass('submit-disabled');
                $('#edit-submit').attr('disabled', !($('#edit-submit').attr('disabled')));
            });
        if($('#kapeesh:checked').val()) {
            $('#edit-submit').toggleClass('submit-disabled');
            $('#edit-submit').attr('disabled', false);
        }            
    });
</script>
  </div>
</div>
