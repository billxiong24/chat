<?php
session_start();
if(isset($_SESSION['user'])){
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ChatIO</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
    <link href="css/index.css" rel="stylesheet">


</head>

<body class="top-navigation">

    <div id="wrapper">
        <div id="page-wrapper">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="#" class="navbar-brand">ChatIO</a>
                </div>
                <div class="navbar-collapse collapse" id="navbar">
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <a href="login.php" class="navbar-brand" style="font-family: Raleway; font-weight: 200;">
                                <i class="fa fa-sign-in"></i> Log in 
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="wrapper wrapper-content">
         <div class="container animated fadeInDown">
                <div class="slogan">
                    <span>Instant Messaging. Redefined.</span>
                </div>
                <div class="title">
                    <span>Chat</span>
                </div>
                <div class="logo">
                    <button class="btn btn-primary filler" id="i"></button>
                    <button class="btn btn-primary filler" id="o"></button>
                </div>
                    <div id="w">
                        <div id="page">
                            <div id="content-login">
                                <div class="content">
                                    <div class="buttons">
                                        <input type="submit" class="btn btn-primary register" id="showsignup" value="Sign up">
                                        <input type="submit" class="btn btn-primary login" id="showregister" value="Log in">
                                    </div>
                                </div>
                            </div>

                            <div id="content-register2">
                                <div class="content">
                                      <div class="loginColumns">
                                           <form class="m-t" role="form" method="post" action="signup.php">
                                        <div class="row">
                                            <div class="col-md-6" style="border-top: solid #C3C3C3 1px">
                                                <div class="form-group" style="margin-top: 15px">
                                                    <input class="form-control" name="firstname-signup"  placeholder="First name" autocomplete="off" required="">
                                                </div>
                                                <div class="form-group">
                                                    <input class="form-control" name="lastname-signup"  placeholder="Last name" autocomplete="off" required="">
                                                </div>
                                                <h2 class="font-bold">Welcome to ChatIO</h2>

                                                <p>
                                                    A perfectly designed and precisely prepared chat client,

                                                   ChatIO is committed to revolutionizing and redefining instant messaging, one step at a time. 
                                                </p>

                                                <p>
                                                    Get started by entering a username and password and clicking "Sign up". It's that easy. 
                                                </p>

                                                
                                            </div>
                                            <div class="col-md-6" style="border-top: solid #C3C3C3 1px">
                                                <div class="ibox-content" style="border: none">
                                                        <div class="form-group">
                                                            <input class="form-control" name="user-signup"  placeholder="Username" autocomplete="off" required="">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="password" class="form-control" name="password-signup" placeholder="Password" required="">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary block full-width m-b" name="signup" >Sign up</button>

                                                        <p class="text-muted text-center">
                                                            <small>Already have an account?</small>
                                                        </p>
                                                        <a class="btn btn-sm btn-white btn-block" id="showregister">Login</a>
                                                        <a class="btn btn-sm btn-white btn-block" id="showlogin2">Back</a>
                                                </div>
                                            </div>
                                        </div>
                                          </form>
                                        <hr/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="content-register">
                                <div class="content">
                                     <div class="middle-box text-center loginscreen loginflip" style = "margin-top: 180px">
                                        <div>
                                            <!-- <h3>Login</h3>
                                            <p>Perfectly designed and precisely prepared to suit your needs. Login in to see it in action. -->
                                            <div style = "border: solid #D2D2D2 1px;">
                                                <i class="fa fa-user" style="font-size: 130px;"></i>
                                            </div>
                                                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
                                            </p>
                                            <form class="m-t" role="form" action="login.php" method="post">
                                                <div class="form-group">
                                                    <input class="form-control" name="username" placeholder="Username" required="" autocomplete="off">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                                                </div>
                                                <button type="submit" name="loginbutton" class="btn btn-primary block full-width m-b">Login</button>
                                                <a class="btn btn-sm btn-white btn-block" id="showlogin">Back</a>

                                                <a href="#"><small>Forgot password?</small></a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
<!--             <div class="container animated fadeInDown">
                <div class="slogan">
                    <span>Instant Messaging. Redefined.</span>
                </div>
                <div class="title">
                    <span>Chat</span>
                </div>
                <div class="logo">
                    <button class="btn btn-primary filler" id="i"></button>
                    <button class="btn btn-primary filler" id="o"></button>
                </div>
                <div class="buttons">
                    <input type="submit" class="btn btn-primary" id="register" value="Sign up">
                    <input type="submit" class="btn btn-primary" id="login" value="Log in">
                </div>

            </div> -->


        </div>
        <div class="footer">
            <div>
                <strong>Copyright</strong> ChatIO &copy; 2017
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- Flot -->
    <script src="js/plugins/flot/jquery.flot.js"></script>
    <script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="js/plugins/flot/jquery.flot.resize.js"></script>

    <!-- ChartJS-->
    <script src="js/plugins/chartJs/Chart.min.js"></script>

    <!-- Peity -->
    <script src="js/plugins/peity/jquery.peity.min.js"></script>
    <!-- Peity demo -->
    <script src="js/demo/peity-demo.js"></script>
    <script src="js/formslider.js"></script>

    <script>
        $(document).ready(function() {

        });
    </script>

</body>

</html>
