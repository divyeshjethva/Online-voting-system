<?php
    session_start();
    if(!isset($_SESSION['userdata'])){
        header("location: ../");
    }

    $userdata = $_SESSION['userdata'];
    $groupsdata = $_SESSION['groupsdata'];

    if($_SESSION['userdata']['status']==0){
        $status = '<b style="color:red">Not voted</b>';
    }
    else{
        $status = '<b style="color:green">Voted</b>';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
        margin: 0;
        padding: 0;
        }
        body{
            background-color: #6bd16b;
        }
        h1{
            text-align: center;
            padding: 20px 0;
        }
        .container{
            padding : 30px;
            display: flex;
            justify-content: space-around;
        }

        .profile{
            background-color: #fff;
            width: 25%;
            height: 300px;
            border-radius: 13px;
            padding : 10px;
        }
        .group{
            background-color: #fff;
            width: 60%;
            border-radius: 13px;
            padding : 10px;
        }
        .sub-btn{
            border: 1px solid #000;
            border-radius: 13px;
            padding: 5px 8px;
            margin: 5px 0;
            background-color: #5cd4d4;
        }
    </style>
</head>
<body>
    <h1>Online Voting System</h1>
    <a href="../"><button class="sub-btn">logout</button></a>
    <hr>

    <div class="container">
        <div class="profile">
            <center>
                <img src="../uploads/<?php echo $userdata['photo'] ?>" height="100" width="100"> <br><br>
            </center>
            <b>Name :</b><?php echo $userdata['name'] ?><br><br>
            <b>mobile :</b><?php echo $userdata['mobile'] ?><br><br>
            <b>address :</b><?php echo $userdata['address'] ?><br><br>
            <b>status :</b><?php echo $userdata['status'] ?><br><br>
        </div>
        <div class="group">
            <?php
                if($_SESSION['groupsdata']){
                    foreach ($groupsdata as $x) {
                        echo $x['name'];
                        ?>

                        <div>
                            <img style="float:right" src="../uploads/<?php echo $x['photo']?> " height="100" width="100"><br><br>
                            <b>Group Name: </b><?php echo $x['name'] ?><br><br>
                            <b>Votes: </b><?php echo $x['votes']?><br><br>
                            <form action="../api/vote.php" method="post">
                                <input type="hidden" name="gvotes" value="<?php echo $x['votes'] ?>">
                                <input type="hidden" name="gid" value="<?php echo $x['id'] ?>">
                                <input type="submit" name="votebtn" value="vote" class="sub-btn">
                            </form>
                            <hr>
                        </div>

                        <?php
                    }
                }
            ?>
        </div>
    </div>

</body>
</html>