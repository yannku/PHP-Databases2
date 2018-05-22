<?=form_open($properties['action'], NULL, $properties['hidden'])?>
  <?=form_error('form')?>
  <?php foreach ($form as $key => $input):?>
    <div>
      <?=form_error($key);?>
      <?=form_label($key);?>
      <?=form_input($input);?>
    </div>
  <?php endforeach;?>

  <?=form_dropdown('course_id', $dropdown);?>
  <?=form_submit(null, "Submit")?>
<?=form_close()?>
