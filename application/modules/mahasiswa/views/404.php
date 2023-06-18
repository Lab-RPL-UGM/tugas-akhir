<?php
/**
 * Created by nad.
 * Date: 31/03/2018
 * Time: 14:14
 * Description:
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php if(isset($pageTitle)){
        echo '<title>' . $pageTitle . '</title>';
    } else {
        echo '<title>e-Lusi</title>';
    }?>

    <!-- Bootstrap -->
    <link href="<?php echo base_url()?>elusistatic/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url()?>elusistatic/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <!-- page content -->
            <div class="col-md-12">
                <div class="col-middle">
                    <div class="text-center text-center">
                        <div class="mid_center">
                            <h1 class="error-number">404</h1>
                            <h2>Sorry but we couldn't find this page</h2>
                            <p>This page you are looking for does not exist <br>
                                <a href="<?php echo base_url();?>mahasiswa">Back to home?</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
</body>
</html>

