<!DOCTYPE html>
<?php
require_once  "../config.php";
$page= (isset($_GET['page'])) ? $_GET['page'] : '';
$strSearch= (isset($_GET['strSearch'])) ? $_GET['strSearch'] : '';


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
        <title>ข้อมูลอาจารย์ที่ปรึกษา</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="../assets/css/bootstrap.css" rel="stylesheet" />
        <!-- FONTAWESOME STYLES-->
        <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- MORRIS CHART STYLES-->
        <link href="../assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
        <link href="../assets/css/custom.css" rel="stylesheet" />
        <!-- GOOGLE FONTS-->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="ddsearch.js" type="text/javascript"> </script>
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
                            <div class="col-lg-12">
                                <h2>Adviser Data                    </h2>
                            </div>
                        </div>
                        <div class="row"> <div></div></div>
                        <div class="col-sm-push-12">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3>ข้อมูลอาจารย์ที่ปรึกษา</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row"> 
                                    <?php  
if($page==''){
$Search=(isset($_POST['Search'])) ? $_POST['Search'] : '';
$Search2=(isset($_POST['Search2'])) ? $_POST['Search2'] : '';
}else{
$Search=(isset($_GET['Search'])) ? $_GET['Search'] : '';
$Search2=(isset($_GET['Search2'])) ? $_GET['Search2'] : '';
}
?>
                                    <form name="form1" method="post" action="teacher-view.php?show=OK&strSearch=Y" class='navbar-form navbar-left' role='search'>
                                    <div class='form-group' >
                                    <select name='Search2' class='form-control'>
                                    <option value="Teacher_ID" <?php if($Search2=="Teacher_ID"){ echo 'selected'; }?>>Teacher_ID</option>
                                    <option value="Teacher_NameTH" <?php if($Search2=="Teacher_NameTH"){ echo 'selected'; }?>>Teacher_NameTH</option>
                                    </select>
                                    <input name='Search' type='text' class='form-control' style='width:auto'  placeholder='Enter Keyword...'  value='<?php echo $Search?>'  onFocus="this.value ='' ;">
                                    <select name="Faculty_ID" id="faculty" class="form-control" onChange="getMajor(this.value);clearYears(this.value)">
                                                        <option value="" >ทุกคณะ</option>
                                                        <?php
                                                        $sql = "SELECT * FROM faculty ";
                                                        $query = $connect->query($sql);
                                                        while($rs=$query->fetch_assoc()){
                                                        ?>
                                                        <option value="<?php echo $rs["Faculty_ID"]; ?>"><?php echo $rs["Faculty_NameTH"] ?></option>
                                                        <?php
                                                        } echo $rs["Faculty_ID"];
                                                        ?>
                                                    </select>
                                                    <select name="Major_ID" class="form-control" id="major-list" onChange="getYears(this.value);" >
                                                        <option value="">ทุกสาขา</option>
                                                    </select><select name="sex" class="form-control"  >
                                                        <option value="">ทุกเพศ</option>
                                                        <option value="0">ชาย</option>
                                                        <option value="1">หญิง</option>
                                                    </select>
                                    <button type='submit' class='btn btn-default' value='Search'>Search</button>
</div>
</form>
<?php
$limit = '20';

if($strSearch=="Y"){
$Qtotal = mysqli_query($connect,"select * from Teacher Where ".$Search2." like '%".$Search."%'  ");
}else{
$Qtotal = mysqli_query($connect,"select * from Teacher");
}

$total_data = mysqli_num_rows($Qtotal);
$total_page= ceil($total_data/$limit);

if($page>=$total_page) $page=$total_page;
if($page<=0 or $page==''){
$start = 0;
$page=1;
}

$start=($page-1)*$limit;

$from=$start+1;
$to=$page*$limit;
if($to>$total_data) $to=$total_data;
?>

<div class='alert alert-info' role='alert' style='font-weight:bold;'>
<?php
echo $from.' - '.$to;
printf(' from %d  ',$total_data);
printf(' | Page %d <br />',$page);
?>
</div>
                                     </div>
                                    <div class="row">
                                    </div >
                                    <div class="row"></div>
                                <div class="row"></div>
                                <table class='table table-bordered tablesorter'>
                                  <thead>
                                    <tr>
                                      <td align='center'><strong>รหัสอาจารย์ </strong></td>
                                      <td align='center'><strong>ชื่ออาจารย์ </strong></td>
                                      <td align='center'><strong>ที่ปรึกษาชั้น 1 </strong></td>
                                      <td align='center'><strong>ที่ปรึกษาชั้น 2 </strong></td>
                                      <td align='center'><strong>ที่ปรึกษาชั้น 3 </strong></td>
                                      <td width="8%"></td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
if($strSearch=="Y"){
    $Faculty_ID = $_POST["Faculty_ID"];
    $Major_ID = $_POST["Major_ID"];
    $sex = $_POST["sex"];
$sql = "SELECT adviser.*,teacher.*
FROM adviser
INNER JOIN teacher ON adviser.Teacher_ID LIKE teacher.Teacher_ID
WHERE adviser.Teacher_ID LIKE '%$Search%' OR teacher.Teacher_NameTH LIKE '%Search%'";
$Query = mysqli_query($connect,$sql);


echo $sql1;
}else{

$sql = "SELECT adviser.*,teacher.*
FROM adviser
INNER JOIN teacher ON adviser.Teacher_ID LIKE teacher.Teacher_ID";
$Query = mysqli_query($connect,$sql);
}

while($arr = mysqli_fetch_array($Query)){

?>

<tr valign='top'>
<td align='center'><?php echo $arr['Teacher_ID'] ?></td>
<td align='center'><?php echo $arr['Teacher_Titlename']." ".$arr['Teacher_NameTH'] ?></td>
<td align='center'><?php echo $arr['class_id1']; ?></td>
<td align='center'><?php echo $arr['class_id2']; ?></td>
<td align='center'><?php echo $arr['class_id3']; ?></td>

<form name="edit" method="post" action="teacher-view-editadviser.php?">
<input type='hidden' name='Select_ID' value="<?php echo $arr['Teacher_ID']?>">
<input type='hidden' name='class_id1' value="<?php echo $arr['class_id1']?>">
<input type='hidden' name='class_id2' value="<?php echo $arr['class_id2']?>" >
<input type='hidden' name='class_id3' value="<?php echo $arr['class_id3']?>" >
<td> <input type="submit" name="edit" value="แก้ไขข้อมูล" class="btn btn-info" onclick="return confirm('คุณต้องการที่จะแก้ข้อมูล <?php echo $titlename." ".$arr['Teacher_NameTH'] ?> หรือไม่ ?');"/>
</td>
</form>
</tr>
<?php }?>
</tbody>
</table>
<nav>
<ul class='pagination'>
<li <?php if($page==1) echo "class='disabled' ";?>><a href='teacher-view.php?page=<?php echo $page-1?>&Search=<?php echo$Search?>&Search2=<?php echo $Search2?>&strSearch=<?php echo$strSearch?>' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>

<?php for($i=1;$i<=$total_page;$i++){

if($page-2>=2 and ($i>2 and $i<$page-2)) {
echo "<li ><a href=''>...</a></li>";
$i=$page-2;
}

if($page+5<=$total_page and ($i>=$page+3 and $i<=$total_page-2)) {
echo "<li ><a href='' >...</a></li>";
$i=$total_page-1;
}

?>
<li <?php if($page==$i) echo "class='active' ";?>><a href='teacher-view.php?page=<?php echo $i?>&Search=<?php echo $Search?>&Search2=<?php echo $Search2?>&strSearch=<?php echo $strSearch?>' ><?php echo $i?></a></li>
<?php }?>

<li <?php if($page==$total_page) echo "class='disabled' ";?>><a href='teacher-view.php?page=<?php echo $page+1?>&Search=<?php echo $Search?>&Search2=<?php echo $Search2?>&strSearch=<?php echo $strSearch?>' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>
</ul>
</nav>




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
        <!-- CUSTOM SCRIPTS -->
        <script src="../assets/js/custom.js"></script>
    </body>
</html>