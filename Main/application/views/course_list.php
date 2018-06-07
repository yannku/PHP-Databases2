<!-- views/directory.php -->
<!-- localhost/path/index.php?/welcome/directory -->

<div class="row justify-content-center">
	<div class="col-sm-8">
		<h1>Courses</h1>

<table class="table">

	<tbody>

<?php foreach($courses->result_array() as $course): ?>
	<h5><?=anchor("courses/view_course/{$course['id']}", "{$course['c_name']}", array('class' => ''));?></h5>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<p>Duration: <?=$course['c_duration'];?> years</p>
		</div>
		<div class="col-sm-4">
			<p>MQF: level <?=$course['c_mqf'];?></p>
		</div>
		<div class="col-sm-4">
			<p>Course code: <?=$course['c_code'];?></p>
		</div>

	</div>

<?php endforeach; ?>

		<button type="button" name="Apply" class="btn btn-dark"><?=anchor("course_app", "Apply for a course", array('class' => 'click'));?></button>

	</tbody>
</table>

</div>
