<?=form_open($form_action,array('class' => 'form-group'));?>

          <div class="row login">
            <div class="col-sm-7">
                <img src="<?=base_url('Images\cameraperson.jpg')?>" alt="">
            </div>
            <div class="col-sm-5">

<?php foreach ($form_inputs as $input): ?>


<?=form_input($input);?>
        <div class="spacing">

        </div>
<?php endforeach; ?>
<?=form_button($buttons['submit'])?>
                </div>

    </div>

<?=form_close();?>
