

          <div class="row justify-content-center">

            <div class="col-sm-6">
<?=form_open($form_action,array('class' => 'form-group'));?>
<?php foreach ($form_inputs as $input): ?>


<?=form_input($input);?>
                <div class="spacing">

                </div>

<?php endforeach; ?>

<?=form_button($buttons['submit'])?>
            </div>

    </div>

<?=form_close();?>
