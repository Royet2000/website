<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Image Gallery Example</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- References: https://github.com/fancyapps/fancyBox -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <style type="text/css">
        body{
        background-image:url('ocean.jpg');
        height: 100%;
        background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
        }
        .gallery {
            position: relative;
            right: 145px;
            bottom:60px;
            display: inline-block;
            height:100%;
            background:#e8e8e8;
            padding:30px 10px;
            border: solid 3px;
            border-radius:20px;
        }

        .close-icon {
            border-radius: 50%;
            position: absolute;
            right: 5px;
            top: -10px;
            padding: 5px 8px;
        }

        .form-image-upload {
            position:relative;
            background: #e8e8e8 none repeat scroll 0 0;
            border: solid 3px;
            padding: 25px;
            border-radius:10px;
            left:350px;
            width:1000px;
            bottom:150px;
        }

        .carousel-inner>.item>a>img,
        .carousel-inner>.item>img,
        .img-responsive,
        .thumbnail a>img,
        .thumbnail>img {
            width: 300px !important;
            height: 160px !important;
        }

        .logout{
            position: relative;
            bottom:212px;
            left:1275px;
            height:34px;
            color:red;
            border:outset 2px;
            border-color:black;
        }
        .thumbnail{
            border: solid 3px;
            border-color:black;
            font-size:20px;
            
        }
        .thumbnail:hover{
            background:#ed8248;
        }
        .text{
            border-radius:10px;
            border:solid 1px;
        }
        .bn{
            position: relative;
            height:34px;
            width:80px;
            right:10px;
            
        }


    </style>
</head>

<body>
    <div class="container">

        <h3 style="text-align: center; font-size: 100px; font-family: san serif; color: white; border:solid 3px; margin:20px;width:3px; position:relative; right:250px;" ><b>MY GALLERY</b></h3>

        <form action="./imageUpload.php" class="form-image-upload" method="POST" enctype="multipart/form-data">

            <!-- code to show error message -->
            <?php if (!empty($_SESSION['error'])) { ?>
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        <li><?php echo $_SESSION['error']; ?></li>
                    </ul>
                </div>
            <?php unset($_SESSION['error']);
            } ?>
            
            <!-- code to show success message  -->
            <?php if (!empty($_SESSION['success'])) { ?>
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong><?php echo $_SESSION['success']; ?></strong>
                </div>
                <?php
                echo '<script>alert("Image Successfully Deleted")</script>';
                ?>
            <?php unset($_SESSION['success']);
            
            } ?>

            <div class="row">
                <div class="col-md-5">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="text form-control" placeholder="Title">
                </div>
                <div class="col-md-5">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="text form-control">
                </div>

                <div class="col-md-2">
                    <br />
                   <button type="submit" class="bn btn-success">Upload</button>
                </div>
            </div>
            
        </form>
                        <form action="../gallery/index.php">
                        <button class="logout">Logout</button>
        </form>
                        <div class="row">
            <div class='list-group gallery' style="width: 1445px;">
                <?php
                require('db_config.php');

                $sql = "SELECT * FROM images";
                $images = $conn->query($sql);

                while ($image = $images->fetch_assoc()) {

                ?>
                    <div class='col-sm-3' style="float: left;">

                        <a class="thumbnail fancybox" rel="ligthbox" href="./uploads/<?php echo $image['img_name'] ?>">
                        
                            <img alt="" src="./uploads/<?php echo $image['img_name'] ?>" />
                            <div class='text-center'>
                                <small class='text-muted'><?php echo $image['title'] ?></small>
                            </div> <!-- text-center / end -->
                        </a>

                        <!-- form to delete image -->
                        <form action="./imageDelete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $image['id'] ?>">
                            <button type="submit" title="delete" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                        </form>

                    </div> <!-- col-6 / end -->
                <?php } ?>

            </div> <!-- list-group / end -->
        </div> <!-- row / end -->
    </div> <!-- container / end -->
</body>
</html>




<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none",
        });
    });
</script>