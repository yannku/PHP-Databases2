<div class="container">


<div class="col-sm-12 ">
        <h3 >Our Students</h3>
    </div>

<div class="row">

	<?php foreach($students->result_array() as $student): ?>

		<div class="  col-sm-4 bck">
	        <a href=""><img src='uploads\images\<?=$student['id'];?>.jpg' alt="">
	            <div class="overlay">
	                <p class="text"><?=anchor("student_portfolio/{$student['id']}"," {$student['name']} {$student['surname']} ", array('class' => 'name'));?></p>

	            </div>
	        </a>
	    </div>

	<?php endforeach; ?>

</div>
</div>



	</tbody>
</table>
