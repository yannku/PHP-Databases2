<!-- views/directory.php -->
<!-- localhost/path/index.php?/welcome/directory -->

<div class="row justify-content-center">
	<div class="col-sm-8">
		<h1>Vacancies</h1>

<table class="table">

	<tbody>

<?php foreach($jobs->result_array() as $job): ?>
	<h5><?=$job['j_name'];?></h5>
	</div>
	<div class="row">
		<div class="col-sm-8">
			<p><?=$job['j_desc'];?> </p>
		</div>
		<div class="col-sm-4">
			<button type="button" name="button" class="btn btn-dark"><?=anchor("{$job['j_url']}", "View", array('class' => ''));?></button>

		</div>


	</div>

<?php endforeach; ?>


	</tbody>
</table>

</div>
