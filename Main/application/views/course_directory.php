<!-- views/directory.php -->
<!-- localhost/path/index.php?/welcome/directory -->

<table class="table">
	<thead class="thead-dark">
		<tr>
			<th scope="col">Course name</th>
			<th scope="col">Course code</th>
			<th scope="col">Course duration</th>
			<th scope="col">MQF Level</th>
			<th scope="col">Edit</th>
			<th scope="col">View</th>
		</tr>
	</thead>
	<tbody>

<?php foreach($courses->result_array() as $course): ?>
		<tr scope="row">
			<td><?=$course['c_name'];?></td>
			<td><?=$course['c_code'];?></td>
			<td><?=$course['c_duration'];?></td>
			<td><?=$course['c_mqf'];?></td>
			<td><?=anchor("courses/edit_course/{$course['id']}", "Edit");?></td>
			<td><?=anchor("", "View");?></td>
		</tr>
<?php endforeach; ?>

	</tbody>
</table>
