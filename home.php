<?php
include 'Loader.class.php';

session_start();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
}

$_SESSION['loader'] = new Loader();
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ChatIO</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Raleway" />
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">

</head>

<body class='top-navigation'> <!--Toggle this class for side panel-->

<div id="wrapper">



<div id="page-wrapper" class="gray-bg">
<div class="row border-bottom">
        <div class="row border-bottom white-bg">
            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-header">
                    <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <i class="fa fa-reorder"></i>
                    </button>
                    <a href="home.php" class="navbar-brand">ChatIO</a>
                </div>
       <!--  <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="search_results.html">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div> -->
        <ul class="nav navbar-top-links navbar-right">
            <li> 
                    <button class="btn small-buttons" style="">
                    <?php
                        echo $_SESSION['loader']->load_first_name(); 
                    ?>
                    </button>
            </li>

            <li class="dropdown" style="">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="mailbox.html">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="profile.html">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                <span class="pull-right text-muted small">12 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="grid_options.html">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                <span class="pull-right text-muted small">4 minutes ago</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <div class="text-center link-block">
                            <a href="notifications.html">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>


            <li>
                <form method="post" action="logout.php">
                    <button class="btn small-buttons" name="logout" type="submit">
                        <i class="fa fa-sign-out"></i>
                    </button>
                </form>
            </li>
        </ul>
            </nav>
        </div>
</div>
<!-- <div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Chat view</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>
                <a>Miscellaneous</a>
            </li>
            <li class="active">
                <strong>Chat view</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div> -->


<div class="wrapper wrapper-content animated fadeInRight">
<!--     <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">

                    <strong>Chat room </strong> can be used to create chat room in your app.
                    You can also use a small chat in the right corner to provide live discussion.

                </div>
            </div>
        </div>
    </div> -->
    <div class="container1">
    <div class="row">
                <div class="ibox chat-view">
                    <div class="ibox-title">
                        <?php
                            echo $_SESSION['loader']->load_title();
                         ?>
                    </div>
                    <div class="ibox-content fullscreen">
                            <div class="col-xs-3 cell1" style = "margin-left: 20px">
                                <div class="chat-users">
                                    <div class="actions-list">
                    <div style="margin-top: 20px">
                        <form class="add-user" method="post" action="adduser.php"> 
                            <input type="text" placeholder="Add user" class="add-user-info" style="display: inline">
                        </form>
                    </div>
                                        <div class="chat-actions">
                                            <form method = "post" action="addchat.php">
                                                <button class="btn btn-primary" type = "submit" name = "add">Create new chat</button>
                                            </form>
                                        </div>
                                        <div class="chat-actions">
                                        <form class="leave-chat" method="post" action="leavechat.php">
                                            <button class="btn btn-primary">Add people</button>
                                        </form>
                                        </div>
                                        <div class="chat-actions">
                                        <form class="leave-chat" method="post" action="leavechat.php">
                                            <button class="btn btn-primary">Delete chat</button>
                                        </form>
                                        </div>
                                        <div class="chat-actions">
                                        <form class="leave-chat" method="post" action="leavechat.php">
                                            <button class="btn btn-primary">Leave chat</button>
                                        </form>
                                        </div>
                                        <?php
                                        ?>
                                    </div>

                                </div>
                            </div>

                        <div class="row">
                            <div class="col-xs-6 cell2" >
                                <div class="chat-discussion content">
                                    <?php
                                        //hardcoded for now;
                                        echo $_SESSION['loader']->load_chat_lines();
                                    ?>
                                    <div id="end-chat"></div>

                                </div>
                                
                            </div>
                            <div class="col-xs-2 cell3">
                                <div class="chat-users">
                                    <div class="users-list">
                                        <?php
                                            echo $_SESSION['loader']->load_chat_list();
                                        ?>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <form class = "submit-message" method="post" action="line.php">
                            <div class="col-lg-6"style="margin-left: 27px">
                                <div class="chat-message-form" >
                                    <div class="form-group">
                                        <input class="form-control message-input" name="message" placeholder="Enter message" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            </form>

                    </div>

                </div>
        </div>

    </div>

</div>
</div>
</div>
<!--    <div class="small-chat-box fadeInRight animated">

        <div class="heading" draggable="true">
            <small class="chat-date pull-right">
                02.19.2015
            </small>
            Small chat
        </div>

        <div class="content">

        </div>
            <div class="input-group input-group-sm"><input type="text" class="form-control"> <span class="input-group-btn"> <button
                    class="btn btn-primary" type="button">Send
            </button> </span></div>
        </div>

    </div>
    <div id="small-chat">

        <span class="badge badge-warning pull-right">5</span>
        <a class="open-small-chat">
            <i class="fa fa-comments"></i>

        </a>
    </div>
</div> --!>



<!-- Mainly scripts -->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src = "js/home.js"></script>
<script>
</script>
</body>

</html>
