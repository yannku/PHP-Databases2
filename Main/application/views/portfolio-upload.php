<button type="button" class="btn btn-dark"><?=anchor("student_page", "Back to profile", array('class' => "click"));?></button>
          <div class="row justify-content-center">
<?=form_open_multipart('portfolioupload/submit',array('class' => 'form-group'))?>
<?php foreach ($form as $key => $input): ?>
    <div>
        <?=form_label($key);?>:


        <?=form_input($input);?>
        <div class="spacing">

        </div>
    </div>
<?php endforeach; ?>
<?=form_submit(null, "Submit", array('class' => "btn btn-dark"))?>
<?=form_close()?>
</div>
