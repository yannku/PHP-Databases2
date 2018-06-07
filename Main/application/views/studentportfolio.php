<div class="container">
    <div class="row">

        <div class="col-sm-3">
            <img src='uploads\images\<?=$student['id'];?>.jpg' class="porprof" alt="">

        </div>
        <div class="col-sm-9">
            <h5 class="name"><?=$student['name'];?> <?=$users['surname'];?></h5>
            <p class="info"> <?=$users['about'];?></p>
            <div class="coninfo">
                <i class="fas fa-envelope-square"></i>
                <p class="email"><?=$users['email'];?></p>
            </div>
            <div class="coninfo">
                <i class="fas fa-phone-square"></i>
                <p class="email"><?=$users['mobile'];?></p>
            </div>

        </div>
        </div>

        <div class="row">
            <div class="col-sm-10">
                <p>My Projects</p>
            </div>

        </div>

        <div class="row bck">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
<?php foreach ($image as $img): ?>

    <img src="uploads\images\<?=$users['id']{$i}?>.*" alt="">


<?php endforeach; ?>
                        <img src="<?=base_url('uploads\portfolio\4_0.jpg')?>" alt="">

                    </div>
                    <div class="col-sm-4">
                        <img src="Images\website.png" alt="">
                    </div>
                    <div class="col-sm-4">
                        <img src="Images\website.png" alt="">
                    </div>

                </div>
            </div>


                </div>
            </div>



        </div>
    </div>
