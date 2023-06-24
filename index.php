<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student iReporting System</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/half-slider.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container p-lg">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="./img/unilag_logo.png" class="logo-image">
                <a class="navbar-brand" href="javascript:;"><span class="d-sm-none">STUDENT </span>iREPORTING SYSTEM</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav float-right-lg f-w-lg">
                    <li> <a href="users/">Login</a></li>
                    <li><a href="users/registration.php">Register</a></li>
                    <li><a href="admin/">Admin</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Half Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <!-- <li data-target="#myCarousel" data-slide-to="2"></li> -->
        </ol>
        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('img/c2.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('img/c10.jpg');"></div>
                <div class="carousel-caption">

                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <div class="col-lg-12">
                <div class="com">
                    <h1><b>WELCOME TO STUDENT iREPORTING SYSTEM</b></h1>
                    <p>
                    <h2>The easiest way to complain online </h2><br> <b><i>You have an issue that can affect your academics negatively? Sign Up today to leave complaints on various issues.</b> </i></p>
                </div>
            </div>
        </div>
        <style>
            .com {
                text-align: center;
            }
        </style>
        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; <?php echo date('Y') ?> Student iReporting System. </p>
                </div>
            </div>
            <!-- /.row -->
        </footer>
        <style>
            .col-lg-12 {
                text-align: center;
                /* border: 1px solid black; */
            }

            .logo-image {
                float: left;
                padding-right: 1rem;
            }

            @media (min-width: 1200px) {
                .p-lg {
                    padding: 0.5em;
                }
            }

            @media (max-width: 768px) {
                .d-sm-none {
                    display: none;
                }
            }

            @media (min-width: 768px) {
                .float-right-lg {
                    float: right !important;
                }
                .f-w-lg {
                    font-weight: bold;
                }
            }
        </style>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })
    </script>

</body>

</html>