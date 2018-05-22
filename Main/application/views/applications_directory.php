<!-- views/directory.php -->
<!-- localhost/path/index.php?/welcome/directory -->

<table class="table table-striped">
	<thead>
		<tr>
			<th scope="col">Name</th>
			<th scope="col">Surname</th>
			<th scope="col">DOB</th>
			<th scope="col">Id number</th>
			<th scope="col">Address</th>
			<th scope="col">Mobile</th>
			<th scope="col">Email</th>
			<th scope="col">Nationality</th>
			<th scope="col">MQF</th>
			<th scope="col">Course id</th>
			<th scope="col">View</th>
		</tr>
	</thead>
	<tbody>

<?php foreach($apps->result_array() as $app): ?>
		<tr scope="row">
			<td><?=$app['a_name'];?></td>
			<td><?=$app['a_surname'];?></td>
			<td><?=$app['a_dob'];?></td>
			<td><?=$app['a_idnumber'];?></td>
			<td><?=$app['a_address'];?></td>
			<td><?=$app['a_mobile'];?></td>
			<td><?=$app['a_email'];?></td>
			<td><?=$app['a_nationality'];?></td>
			<td><?=$app['a_mqf'];?></td>
			<td><?=$app['tbl_courses_id'];?></td>
			<td><?=anchor("", "View");?></td>

		</tr>
<?php endforeach; ?>

	</tbody>
</table>
