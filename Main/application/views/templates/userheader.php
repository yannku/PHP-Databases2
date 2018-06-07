<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="<?=base_url('css\style.css')?>" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="<?=base_url('js/bootstrap.bundle.min.js')?>"></script>
        <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <title>MCAST ICA</title>

    </head>
    <body>
<?php foreach ($nav as $page => $url): ?>
		<?=anchor($url, $page);?>
<?php endforeach; ?>

            <nav class="navbar fixed-top bg-light">
                <div class="container-fluid topnav">

                    <div class="navbar-left d-flex align-items-center">
                        <div class="navbar-brand m-0 p-0">
                            <a href="index.html"><img class="logo" src="<?=base_url('Images\solid_normal.png')?>" alt=""></a>
                        </div>
                    </div>

                    <div class="nav navbar-nav navbar-right">
                        <div class="dropdown">
                            <button class="btn btn-dark"><?=anchor("logout", "Logout", array('class' => 'click'));?></button>

                        </div>

                    </div>
                </div>
            </nav>
            <main class="container-fluid welhome" id="site-content">
