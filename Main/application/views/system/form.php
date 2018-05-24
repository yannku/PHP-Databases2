<?=form_open($form_action);?>
            <?php foreach ($form as $key => $input): ?>

                <?=form_label($key.':', $input['id']);?>
                <?=form_input($input);?>
                <br>

            <?php endforeach; ?>

            <?php echo form_dropdown('roles',$dropdown,'3',array('class' => 'form-control')); ?>
            <?=form_button($buttons['submit'])?>

        <?=form_close();?>
