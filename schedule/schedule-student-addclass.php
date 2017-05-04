<!DOCTYPE html>
<?php
$group_id = $_GET['group_id'];
$Subject_ID = $_GET['Subject_ID'];
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
    <title>เพิ่มข้อมูลนักศึกษา</title>
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
   
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <?php include "../config.php"; ?>
    
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
                <script scr="js/dropdown.js" type="text/javascript" ></script>
                <script type='text/javascript' src='js/jquery.js'></script>
                <script src="../js/formValidation.min.js"></script>
                <script src='../js/framework/bootstrap.min.js'></script>
               <script language="javascript">
         
          function ThaiOnly(input) {
          var regex = /[^ก-๙]/gi;
          input.value = input.value.replace(regex, "");
          }
          function englishOnly(input) {
          var regex = /[^a-zA-Z]/gi;
          input.value = input.value.replace(regex, "");
          }
          
          
          function CheckNum(){
          if (event.keyCode < 48 || event.keyCode > 57){
          event.returnValue = false;
          }
          }
        </script>
                <script>
        $(document).ready(function() {
        $('#frm_student').formValidation();
        });
        </script>


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
                        <a class="active-menu"  href="../admin-backend.php"><i class="fa fa-dashboard fa-3x"></i> หน้าแรก</a>
                    </li>
                     <li>
                        <a  href="../ui.html"><i class="fa fa-desktop fa-3x"></i> UI Elements</a>
                    </li>
                    <li>
                        <a  href="../tab-panel.html"><i class="fa fa-qrcode fa-3x"></i> Tabs & Panels</a>
                    </li>
               <li  >
                        <a   href="../chart.html"><i class="fa fa-bar-chart-o fa-3x"></i> Morris Charts</a>
                    </li> 
                      <li  >
                        <a  href="../table.html"><i class="fa fa-table fa-3x"></i> Table Examples</a>
                    </li>
                    <li  >
                        <a  href="../form.html"><i class="fa fa-edit fa-3x"></i> Forms </a>
                    </li>       
          
                             
                    <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>
                               
                            </li>
                        </ul>
                      </li>  
                  <li  >
                        <a  href="../blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li> 
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                 <div class="col-lg-10"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading">      
                            <h3>เพิ่มนักศึกษารายห้อง</h3>
                        </div>
                        <div class="panel-body" align="center">
                        <form class='form-horizontal' action="addclass.php?group_id=<?php echo $group_id ?>&Subject_ID=<?php echo $Subject_ID ?>" method="post"  enctype='multipart/form-data'data-fv-framework='bootstrap'
                        data-fv-icon-valid='glyphicon glyphicon-ok'
                        data-fv-icon-invalid='glyphicon glyphicon-remove'
                        data-fv-icon-validating='glyphicon glyphicon-refresh'>

                         <div class='form-group'>
                        <label class='col-sm-3 control-label'>คณะ</label>
                        <div class='col-sm-3' align='left'>
                        <select  name="Faculty_ID" id="faculty" class="form-control" onChange="getMajor(this.value);clearYears(this.value)" required>
                            <option value="" >เลือกคณะ</option>
                            <?php 
                            $sql = "SELECT * FROM faculty ";
                            $query = $connect->query($sql);
                            while($rs=$query->fetch_assoc()){
                            ?>
                            <option value="<?php echo $rs['Faculty_ID']; ?>"><?php echo $rs['Faculty_NameTH'] ?></option>
                            <?php
                            } echo $rs["Faculty_ID"];
                            ?>
                            </select>
                        </div>
                        </div>
                        
                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>สาขา</label>
                        <div class='col-sm-3' align='left'>
                       <select name="Major_ID" id="major-list" class="form-control" onChange="getYears(this.value);" required >
                                <option value="">กรุณาเลือกคณะ</option> 
                                </select>
                        </div>
                        </div>
                        
                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>ชั้นปี</label>
                        <div class='col-sm-3' align='left'>
                       <select name="Class_ID" id="year-list" class="form-control"  required >
                       <option value="">กรุณาเลือกสาขา</option> 
                       </select>
                        </div>
                        </div>

                        <div class="panel-footer">
                           <input class="btn btn-success btn-lg" type="submit" name="btnsave" value="บันทึก" > &nbsp;
                           <input class="btn btn-danger btn-lg" type="reset" name="clear" onClick="ClearForm();" value="ล้างข้อมูล" >
                           </form>
                           <a href="schedule-student.php?group_id=<?php echo $group_id ?>&Subject_ID=<?php echo $Subject_ID ?>" class="btn btn-warning btn-lg">ย้อนกลับ</a>
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
      <!-- BOOTSTRAP SCRIPTS
    <script src="../assets/js/bootstrap.min.js"></script> -->
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="../assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="../assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    
    <script src="../js/dropdown.js"></script>
   
</body>
</html>
