<!DOCTYPE html>
<?php
session_start();
	if($_SESSION['admin_id'] == "")
	{
		echo "<SCRIPT LANGUAGE='JavaScript'>
alert('กรุณา Login')
location.href = '../admin.php';
</script>";
		exit();
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ข้อมูลวิชา</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- MORRIS CHART STYLES-->
        <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="../assets/css/custom.css" rel="stylesheet" />
        <!-- TABLE STYLES-->
    <link href="../assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="../js/dropdown1.js" type="text/javascript"> </script>
        <?php include "../config.php"; ?>
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="../admin-backend.php">BACK END</a>
                </div>
                <div style="color: white;
                    padding: 15px 50px 5px 50px;
                    float: right;
                    font-size: 16px;"> <?php echo $_SESSION["date"] ?> &nbsp <a href="../logout-admin.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
                </nav>
                <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav" id="main-menu">
                            <li class="text-center">
                                <img src="../assets/img/find_user.png" class="user-image img-responsive"/>
                            </li>
                            <li>
                                <a href="../admin-backend.php"><i class="fa fa-dashboard fa-3x"></i> หน้าแรก</a>
                            </li>
                            </ul>
                    </div>
                </nav>
                <!-- /. NAV SIDE  -->
                <div id="page-wrapper" >
                    <div id="page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Schedule Data </h2>
                            </div>
                        </div>
                        <div class="row"> <div></div></div>
                        <div class="col-sm-push-9">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3>ข้อมูลตารางเรียน/สอน</h3>
                                </div>
                                <div class="panel-body">
                <div class="table-responsive">
                <table class="table table-striped table-bordered" id="dataTables-example">
                    <thead>
                        <tr>
                            <td align='center'><strong>กลุ่ม </strong></td>
                            <td align='center'><strong>รหัสวิชา </strong></td>
                            <td align='center'><strong>ชื่อวิชา </strong></td>
                            <td align='center'><strong>อาจารย์ผู้สอน</strong></td>
                            <td align='center'><strong>จำนวนนักศึกษา</strong></td>
                            <td width="8%" align='center' colspan="3"><button class="btn btn-success" onclick="window.location.href='schedule-add.php'">เพิ่มตารางสอน</button></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql1 = "SELECT a.*,b.*,c.*
                             FROM teacher_of_subject a
                                INNER JOIN teacher b ON a.teacher_id = b.Teacher_ID
                                INNER JOIN subject c ON a.subject_id = c.Subject_ID";
                        $Query1 = mysqli_query($connect,$sql1);
                        while($arr1 = mysqli_fetch_array($Query1)){
                         $group =  $arr1['group_id'];
                        ?>
                        <tr valign='top'>
                            <td align='center'><?php echo $arr1['group_id'] ?></td>
                            <td align='center'><?php echo $arr1['Subject_ID'] ?></td>
                            <td align='center'><?php echo $arr1['Subject_NameTH'] ?></td>
                            <td align='center'><?php echo $arr1['Teacher_NameTH'] ?></td>
                            <?php
                         $sql2 = "SELECT count(*) as totalstudent
                         FROM student_of_subject 
                     WHERE subject_id = '".$arr1['Subject_ID']."' AND student_of_subject.group_id = '$group' ";
                        $Query2 = mysqli_query($connect,$sql2) or die("error");
                         while($arr2 = mysqli_fetch_array($Query2)){
                            ?>
                            <td align='center'><?php echo $arr2['totalstudent']  ?></td>
                            <?php
                        }
                            ?>
      <form name="edit" method="post" action="schedule-student.php?group_id=<?php echo $arr1['group_id'] ?>&Subject_ID=<?php echo $arr1['Subject_ID'] ?>">
     <td><input type="submit" name="studentadd" value="เพิ่มนักศึกษา" class="btn btn-primary" onclick="return confirm('คุณต้องการเพิ่มนักศึกษาวิชา <?php echo $arr['Teacher_NameTH'] ?> ใช่หรือไม่ ?');"/></td>
     </form>
                            <form name="edit" method="post" action="schedule-edit.php?group_id=<?php echo $arr1['group_id'] ?>&Subject_ID=<?php echo $arr1['Subject_ID'] ?>&Teacher_ID=<?php echo $arr1['Teacher_ID']; ?>">
                            <input type="hidden" name="Subject_Credit" value="<?php echo $arr['Subject_Credit'] ?>"></input>
                    <input type='hidden' name='Select_ID' value="<?php echo $arr['Subject_ID']?>">
                    <td> <input type="submit" name="edit" value="แก้ไขข้อมูล" class="btn btn-info" onclick="return confirm('คุณต้องการที่จะแก้ข้อมูล <?php echo $arr['Teacher_NameTH'] ?> หรือไม่ ?');"/>
                            </td>
                        </form>
<td><form name="deleat" method="post" action="deletedata.php?group_id=<?php echo $arr1['group_id'] ?>&Subject_ID=<?php echo $arr1['Subject_ID'] ?>&Teacher_ID=<?php echo $arr1['Teacher_ID']; ?>">
    <input type="hidden" name="Subject_ID" value="<?php echo $arr['Subject_ID'] ?>"/>
    <input type="submit" value="ลบข้อมูล" class="btn btn-danger btn-mi"  onclick="return confirm('คุณต้องการที่จะลบวิชา <?php echo $arr['Subject_NameTH']; ?> หรือไม่ ?')"/>
</form></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
        </div>
                        </div>
                    </div>
                    <!-- /. ROW  -->
                    <hr />
                </div>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->
        <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
        <!-- JQUERY SCRIPTS -->
        <script src="../assets/js/jquery-1.10.2.js"></script>
        <!-- BOOTSTRAP SCRIPTS -->
        <script src="../assets/js/bootstrap.min.js"></script>
        <!-- METISMENU SCRIPTS -->
        <script src="../assets/js/jquery.metisMenu.js"></script>
        <!-- MORRIS CHART SCRIPTS -->
        <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
        <script src="../assets/js/morris/morris.js"></script>
        <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
        <!-- CUSTOM SCRIPTS -->
        <script src="../assets/js/custom.js"></script>
    </body>
</html>