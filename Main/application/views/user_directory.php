<!-- views/directory.php -->
<!-- localhost/path/index.php?/welcome/directory -->

<table class="table">
	<thead class="thead-dark">
		<tr>
			<th  scope="col">id</th>
			<th  scope="col">email</th>
			<th  scope="col">password</th>
			<th  scope="col">Role</th>
			<th  scope="col">Delete</th>
		</tr>
	</thead>
	<tbody>

<?php foreach($users->result_array() as $user): ?>
		<tr scope="row">
			<td><?=$user['id'];?></td>
			<td><?=$user['email'];?></td>
			<td><?=$user['password'];?></td>
			<td><?=$user['role_id'];?></td>
			<td><?=anchor("system/delete/{$user['id']}", "Delete");?></td>


		</tr>
<?php endforeach; ?>

	</tbody>
</table>
