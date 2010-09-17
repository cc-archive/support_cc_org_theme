<?php
//print_r($form);
print drupal_render($form['name']);
// prints the username field
?>

<?php
print drupal_render($form['pass']); // print the password field
?>

<?php
print drupal_render($form['submit']); // print the submit button
?>

<?php
print drupal_render($form); //print remaining form elements like "create new account"
?>
