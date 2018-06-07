<div class="container">
    <div class="row">

        <div class="col-sm-3">
            <img src='uploads\images\<?=$users['id'];?>.jpg' class="porprof" alt="">

        </div>
        <div class="col-sm-9">
            <h5 class="name"><?=$users['name'];?> <?=$users['surname'];?></h5>
            <p class="info"> <?=$users['about'];?></p>
            <div class="coninfo">
                <i class="fas fa-envelope-square"></i>
                <p class="email"><?=$users['email'];?></p>
            </div>
            <div class="coninfo">
                <i class="fas fa-phone-square"></i>
                <p class="email"><?=$users['mobile'];?></p>
            </div>
            <button type="button" class="btn btn-dark"><?=anchor("edituser", "Edit profile",array('class' => 'click' ) )?></button>
            <button type="button" class="btn btn-dark"><?=anchor("portfolioupload/form", "Upload images",array('class' => 'click' ) )?></button>
            <button type="button" class="btn btn-dark"><?=anchor("index.php/upload", "Change profile picture",array('class' => 'click' ) )?></button>
            <button type="button" class="btn btn-dark"><?=anchor("index.php/upload", "Publish",array('class' => 'click' ) )?></button>
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
                        <img src='<?=base_url("uploads/portfolio/{$users['id']}_0.jpg")?>' alt="">
                    </div>
                    <div class="col-sm-4">
                        <img src='<?=base_url("uploads/portfolio/{$users['id']}_1.jpg")?>' alt="">
                    </div>
                    <div class="col-sm-4">
                        <img src='<?=base_url("uploads/portfolio/{$users['id']}_2.jpg")?>' alt="">
                    </div>

                </div>
            </div>


                </div>
            </div>



        </div>
    </div>
