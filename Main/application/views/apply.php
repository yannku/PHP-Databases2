<?=form_open($form_action,array('class' => 'form-group'));?>

          <div class="row justify-content-center login">

            <div class="col-sm-6">

<?php foreach ($form_inputs as $input): ?>


<?=form_input($input);?>
                <div class="spacing">

                </div>

<?php endforeach; ?>
<?php echo form_dropdown('courses',$dropdown,'',array('class' => 'form-control')); ?>
<?=form_button($buttons['submit'])?>
                </div>

    </div>

<?=form_close();?>
