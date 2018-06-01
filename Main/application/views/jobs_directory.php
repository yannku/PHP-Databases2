<!-- views/directory.php -->
<!-- localhost/path/index.php?/welcome/directory -->

<table class="table">
	<thead class="thead-dark">
		<tr>
			<th  scope="col">Job Name</th>
			<th  scope="col">Job desc</th>
			<th  scope="col">URL</th>
			<th  scope="col">Role</th>
			<th  scope="col">Edit</th>
			<th  scope="col">Delete</th>
		</tr>
	</thead>
	<tbody>

<?php foreach($jobs->result_array() as $job): ?>
		<tr scope="row">
			<td><?=$job['j_name'];?></td>
			<td><?=$job['j_desc'];?></td>
			<td><?=$job['j_url'];?></td>
			<td><?=$job['tbl_jroles_id'];?></td>
			<td><?=anchor("jobs/edit_job/{$job['id']}", "Edit");?></td>
			<td><?=anchor("jobs/delete/{$job['id']}", "Delete");?></td>


		</tr>
<?php endforeach; ?>

	</tbody>
</table>
