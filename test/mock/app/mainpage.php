<?php
session_start();
$user = $_SESSION["username"];

$mytype = $_SESSION['type'];
$mydate = $_SESSION['date'];
$myappid = $_SESSION['appid'];
$mypurpose = $_SESSION['purpose'];
$mytime = $_SESSION['time'];
?>
<html>

<head>
        <!-- i got this from w3 school to add the icon -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src="mystyle.js" defer></script>
    <script type="text/javascript" src="validate.js"></script>
    <link href="styles.css" rel="stylesheet">

<body>
    <div class="nav">
        

        <a href="mainpage.php"><i class="fa fa-home" class="myicon"></i>&nbsp; Home</a>
        <div class="dropdown">
            <?php
            echo "<button class='dropbtn'><i class='fas fa-user-circle' class='myicon'></i>&nbsp;Hello $user ";
            ?>

            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">

                <a href="settings.php"><i class="fa fa-edit" class="myicon1"></i>settings</a>
                <a href="logout.php"><i class="fa fa-sign-out" class="myicon1"></i>logout</a>

            </div>
        </div>

    </div>
    <div class="logindesign">
        <form action="" method="POST" id="loginform">
            <br>
            <br>
            <br>
            <h1> Reschedule</h1>



            <input type="text" class="designus" placeholder="appointment type" name="type" required /><br>

            <input type="date" class="designus" name="date" required /><br>
            <input type="time" class="designus" name="time" required /> <br>
            <input type="text" class="designus" placeholder="purpose" name="purpose" required /><br>
            <input type="submit" class="designussubmit" value="submit" name="submit">
            <br>
            <br>
            <br>


        </form>

    </div>
    <?php
    if (!empty($_POST)) {
        $mytype = $_POST["type"];
        $mydate = $_POST["date"];
        $mytime = $_POST["time"];
        $mypurpose = $_POST["purpose"];
        $my_db_conn = new mysqli("localhost", "root", "root", "Journal");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        $sql = "UPDATE appointment SET  type='$mytype', appointment_date = '$mydate', appointment_time = '$mytime', purpose ='$mypurpose'   WHERE appointment_id='$myappid'";


        $res = mysqli_query($my_db_conn, $sql);
        if ($res) {
            echo "update successful";
            header('Refresh:3; url=mainpage.php');
        } else {
            echo "couldn't update record";
        }
    }


    ?>

</body>
</head>

</html>