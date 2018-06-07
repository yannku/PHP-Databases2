<div class="container">
            <div class="row">

                <div class="col-sm-3">
                    <img src="Images\profile.jpg" class="porprof" alt="">

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
                    <button type="button" class="btn btn-dark"><?=anchor("edituser", "Edit profile");?></button>
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
                                <img src="Images\website.png" alt="">
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
