<?php
include 'ChatManager.class.php';
include 'Notification.class.php';
include 'DataBase.class.php';
include 'ChatLine.class.php';
include 'ChatUser.class.php';
//TODO real auth here
session_start();
DataBase::init();
if(!isset($_SESSION['user'])){
    header("Location: index.php");
}
//hashmap maybe
/*if(isset($_SESSION['chats']) && isset($_POST['message'])){
    $man = $_SESSION['chats'][0]->submit_chat($_POST['message']);
    unset($_POST['message']);
    header('Location: line.php');
}*/
$chats = ChatManager::load_chats();
//$chat = new ChatManager(13, "Group chat", array("wwx"));
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
                        $query = "SELECT first FROM users WHERE username='".$_SESSION['user']."'";
                        $name = DataBase::make_query($query);
                        $row = mysqli_fetch_assoc($name);
                        echo $row['first'];
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
    <div class="row">
        <div class="col-lg-12">

                <div class="ibox chat-view">

                    <div class="ibox-title">
                        <?php
                        /**
                         * TODO make this look nicer, store current chat in less ratchet way
                         *
                         */
                            $curr = mysqli_fetch_assoc($chats);
                            //stores the current chat thats open
                            $_SESSION['last_chat_id'] = $curr['id'];
                            $_SESSION['id'] = array($curr['id'], $curr['name'], explode(",", $curr['users']));
                            $manager = new ChatManager($curr['id'], $curr['name'], explode(",", $curr['users']));
                            $_SESSION['manager'] = $manager;
                            echo'<span class="message-title"><small class="pull-right text-muted">Last message:  Mon Jan 26 2015 - 18:39:23</small>'
                            .$curr["name"] . ' (' . $curr['users'] . ')</span>';
                         ?>
                    <div style="display: inline; ">
                        <form class="add-user" method="post" action="adduser.php"> 
                            <input type="text" placeholder="Add user" class="add-user-info" style="display: inline">
                        </form>
                        <form method="post" action="">
                            <button class="btn btn-primary">Leave chat</button>
                        </form>
                    </div>
                    </div>
                    <div class="ibox-content">

                        <div class="row">

                            <div class="col-md-9 ">
                                <div class="chat-discussion">
                                    <?php
                                        //hardcoded for now;
                                        $lines = $manager->load_chat_lines();
                                        $line_count = 0;
                                        $last_message_id;
                                        while($row = mysqli_fetch_assoc($lines)){
                                             
                                             $last_message_id = $row['line_id'];
                                             $line_count++;
                                             echo '<div class="chat-message left">
                                            <img class="message-avatar" src="img/a1.jpg" alt="" >
                                            <div class="message" id="mess">
                                                <a class="message-author" href="#">'.$row['username'].'</a>
                                                <span class="message-date"> Mon Jan 26 2015 - 18:39:23 </span>
                                                <span class="message-content">'
                                                . $row['text'].
                                                '</span>
                                            </div>
                                        </div>';
                                        }
                                        $_SESSION['last_message_id'] = $last_message_id;
                                    ?>
                                    <div id="end-chat"></div>

                                </div>
                                
                            </div>
                            <div class="col-md-3">
                                <div class="chat-users">
                                    <div class="users-list">
                                        <?php
                                        $_SESSION['chat_ids'] = array();
                                        mysqli_data_seek($chats, 0);
                                        $notifs = '<div class="label-warning notif">4</div>'; 
                                        while($row = mysqli_fetch_assoc($chats)){
                                            array_push($_SESSION['chat_ids'], $row['id']);
                                            echo '<div class="chat-user">
                                                    <form class="change-chat" '. 'id=' . $row["id"] .' method = "post" action="change.php">
                                                    <img class="chat-avatar" src="img/a4.jpg" alt="" >
                                                    <div class="chat-user-name">
                                                        <input class = "btn" type="submit" name = "chatname"' .' value="'. $row["name"] .'">
                                                        '.$notifs.'
                                                    </div>
                                                    </form>
                                                    <form class="remove-chat" method="post" action="remove.php" id='.$row["id"].'>
                                                    <button class="small-buttons pull-right" type="submit" style="margin-top: -35px"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    </div>';
                                        }


                                        $notif_obj = new Notification($_SESSION['chat_ids']);
                                        $_SESSION['notifs'] = $notif_obj;
                                        ?>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <form class = "submit-message" method="post" action="line.php">
                            <div class="col-lg-9">
                                <div class="chat-message-form">
                                    <div class="form-group">
                                        <input class="form-control message-input" name="message" placeholder="Enter message" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            </form>
                            <div style="text-align: center; padding-top: 20px;">
                                <form method = "post" action="addchat.php">
                                    <button class="btn btn-primary m-b" type = "submit" name = "add" style="width: 160px">Create new chat</button>
                                </form>
                            </div>

                    </div>

                </div>
        </div>

    </div>


</div>
</div>
    <div class="small-chat-box fadeInRight animated">

        <div class="heading" draggable="true">
            <small class="chat-date pull-right">
                02.19.2015
            </small>
            Small chat
        </div>

        <div class="content">

            <div class="left">
                <div class="author-name">
                    Monica Jackson <small class="chat-date">
                    10:02 am
                </small>
                </div>
                <div class="chat-message active">
                    Lorem Ipsum is simply dummy text input.
                </div>

            </div>
            <div class="right">
                <div class="author-name">
                    Mick Smith
                    <small class="chat-date">
                        11:24 am
                    </small>
                </div>
                <div class="chat-message">
                    Lorem Ipsum is simpl.
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    Alice Novak
                    <small class="chat-date">
                        08:45 pm
                    </small>
                </div>
                <div class="chat-message active">
                    Check this stock char.
                </div>
            </div>
            <div class="right">
                <div class="author-name">
                    Anna Lamson
                    <small class="chat-date">
                        11:24 am
                    </small>
                </div>
                <div class="chat-message">
                    The standard chunk of Lorem Ipsum
                </div>
            </div>
            <div class="left">
                <div class="author-name">
                    Mick Lane
                    <small class="chat-date">
                        08:45 pm
                    </small>
                </div>
                <div class="chat-message active">
                    I belive that. Lorem Ipsum is simply dummy text.
                </div>
            </div>


        </div>
        <div class="form-chat">
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
</div>



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
