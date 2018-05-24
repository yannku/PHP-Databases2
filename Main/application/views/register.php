<?=form_open($form_action,array('class' => 'form-group'));?>

          <div class="row justify-content-center login">

            <div class="col-sm-6">

<?php foreach ($form_inputs as $input): ?>


<?=form_input($input);?>
    <div class="spacing">

    </div>
<?php endforeach; ?>
<?php echo form_dropdown('roles',$dropdown,'3',array('class' => 'form-control')); ?>
    <div class="spacing">

    </div>
<?=form_button($buttons['submit'])?>
                </div>

    </div>

<?=form_close();?>
