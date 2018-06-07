<?=form_open_multipart('portfolioupload/submit')?>
<?php foreach ($form as $key => $input): ?>
    <div>
        <?=form_label($key);?>:
        <?=form_input($input);?>
    </div>
<?php endforeach; ?>
<?=form_submit(null, "Submit")?>
<?=form_close()?>
