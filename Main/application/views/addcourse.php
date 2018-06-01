

          <div class="row justify-content-center">

            <div class="col-sm-6">
<?=form_open($form_action,array('class' => 'form-group'));?>
<?php foreach ($form_inputs as $input): ?>


<?=form_input($input);?>
                <div class="spacing">

                </div>

<?php endforeach; ?>
<?= form_textarea($Description) ?>
                <div class="spacing">

                </div>
<?= form_textarea($Requirments) ?>
                <div class="spacing">

                </div>
<?= form_textarea($Study_units) ?>
                <div class="spacing">

                </div>
<?= form_textarea($Carrier_opportunities) ?>
                <div class="spacing">

                </div>

<?=form_button($buttons['submit'])?>
            </div>

    </div>

<?=form_close();?>
