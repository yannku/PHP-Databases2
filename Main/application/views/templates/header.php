<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link type="text/css" rel="stylesheet" href="<?=base_url('css\style.css')?>" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="<?=base_url('js/bootstrap.bundle.min.js')?>"></script>
        <script src="<?=base_url('js\bootstrap.min.js')?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <title>MCAST ICA</title>

    </head>
    <body>
<?php foreach ($nav as $page => $url): ?>
		<?=anchor($url, $page);?>
<?php endforeach; ?>
        <input type="checkbox" id="toggle-sidenav" class="hidden">
            <label class="sidenav-bg" for="toggle-sidenav"></label>
            <div id="mySidenav" class="sidenav">
                <label class="closebtn" for="toggle-sidenav">&times;</label>
                <a href="<?=site_url('home');?>">Home</a>
                <a href="<?=site_url('ica_courses');?>">Courses</a>
                <a href="<?=site_url('timetables');?>">Timetables</a>
                <a href="<?=site_url('students');?>">Our Students</a>
                <label class="dropdown-btn" data-toggle="#student-links">Student links
                    <i class="fas fa-caret-down"></i>
                </label>
                <div class="dropdown-container" id="student-links">
                  <a href="http://mcast.edu.mt/searchOurCatalogue">Library</a>
                  <a href="#">Academic Links</a>
                  <a href="<?=site_url('forms');?>">Forms</a>
                  <a href="<?=site_url('calendar');?>">Academic Calendar</a>
                  <a href="sick.html">Cancelled Lectures</a>
                </div>
                <a href="<?=site_url('job_list');?>">Vacancies</a>
                <a href="<?=site_url('login ');?>">Login</a>
            </div>


            <nav class="navbar fixed-top bg-light">
                <div class="container-fluid topnav">

                    <div class="navbar-left d-flex align-items-center">
                        <label class="navbar-toggler m-0 p-0 "  for="toggle-sidenav">
                            <i class="icon fas fa-bars"></i>
                        </label>
                        <div class="navbar-brand m-0 p-0">
                            <a href="<?=site_url('home');?>"><img class="logo" src="<?=base_url('Images\solid_normal.png')?>" alt=""></a>
                        </div>
                    </div>

                    <!--<div class="nav navbar-nav navbar-right  ">
                        <div class="dropdown">
                            <button class="dropbtn"><i class="icon fas fa-user-circle" ></i></button>
                            <div class="dropdown-content">
                               <a href="login.html">Login</a>
                            </div>
                        </div>-->

                    </div>
                </div>
            </nav>
            <main class="container-fluid welhome" id="site-content">
