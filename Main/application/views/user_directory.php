<!-- views/directory.php -->
<!-- localhost/path/index.php?/welcome/directory -->
<div class="">
	<!--<p>Roles ---- 1 = Admin, 2 = Staff, 3 = Student</p>-->
</div>
<table class="table">
	<thead class="thead-dark">
		<tr>

			<th  scope="col">email</th>
			<th  scope="col">name</th>
			<th  scope="col">surname</th>
			<th  scope="col">Delete</th>
		</tr>
	</thead>
	<tbody>

<?php foreach($users->result_array() as $user): ?>
		<tr scope="row">

			<td><?=$user['email'];?></td>
			<td><?=$user['name'];?></td>
			<td><?=$user['surname'];?></td>
			<td><?=anchor("delete_user/{$user['id']}", "Delete");?></td>


		</tr>
<?php endforeach; ?>

	</tbody>
</table>
