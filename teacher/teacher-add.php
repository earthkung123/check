<!DOCTYPE html>
<?php
session_start();
	if($_SESSION['admin_id'] == "")
	{
		echo "<SCRIPT LANGUAGE='JavaScript'>
alert('กรุณา Login')
location.href = 'admin.php';
</script>";
		exit();
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>เพิ่มข้อมูลอาจารย์</title>
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
               <script language="javascript">
					function ThaiOnly(input) {
					var regex = /[^ก-๙]/gi;
					input.value = input.value.replace(regex, "");
					}
					function englishOnly(input) {
					var regex = /[^a-zA-Z]/gi;
					input.value = input.value.replace(regex, "");
					}
					function englishOnly1(input) {
          var regex = /[^a-zA-Z0-9 ]/gi;
          input.value = input.value.replace(regex, "");
          }
					
					function CheckNum(){
					if (event.keyCode < 48 || event.keyCode > 57){
					event.returnValue = false;
					}
					}
				</script>

            
            <script language="javascript">
			function ClearForm(){
      document.getElementById("form1").reset();
    }
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
font-size: 16px;"><?php echo $_SESSION["date"] ?> &nbsp <a href="../logout-admin.php" class="btn btn-danger square-btn-adjust">Logout</a> </div>
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
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Teacher Data                    </h2>
                    </div>
                </div> 
                <div class="row"> <div></div></div>
                
                 <div class="col-lg-10"> 
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3>เพิ่มข้อมูลอาจารย์</h3>
                        </div>

                         <div class="panel-body" align="center">
                        <form class='form-horizontal' id='frm_student' action="add.php" method="post"  enctype='multipart/form-data'data-fv-framework='bootstrap'
                        data-fv-icon-valid='glyphicon glyphicon-ok'
                        data-fv-icon-invalid='glyphicon glyphicon-remove'
                        data-fv-icon-validating='glyphicon glyphicon-refresh'>

                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>รหัสอาจารย์</label>
                        <div class='col-sm-3' align='left'>
                        <input name='Teacher_id' id='Teacher_id'  type='text' class="form-control"  onKeyPress="englishOnly1(this)" data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกรหัสอาจารย์'>
                        </div>
                        </div>


                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>เพศ</label>
                        <div class='col-sm-5' align='left'>
                        <label class="btn btn-info"> <input type="radio" name="Teacher_sex" id="sex" value="0" checked="true"> ชาย </label>
                         <label class="btn btn-info"> <input type="radio" name="Teacher_sex" value="1"> หญิง</label>
                        </div>
                        </div>

                        <div class="panel-body">
                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>คำนำหน้าชื่อ</label>
                        <div class='col-sm-3' align='left'>
                        <input name='Teacher_Titlename' id='Teacher_Titlename'  type='text' class="form-control" maxlength="13" data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกรหัสอาจารย์'>
                        </div>
                        </div>

                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>ชื่ออาจารย์ (TH)</label>
                        <div class='col-sm-4' align='left'>
                        <input type="text" name="Teacher_NameTHF" class="form-control" id="Teacher_NameTHF" onKeyUp="ThaiOnly(this)"  data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกชื่ออาจารย์' required >
                        </div>
                        </div>
                        
                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>นามสกุล (TH)</label>
                        <div class='col-sm-4' align='left'>
                        <input type="text" name="Teacher_NameTHL" class="form-control" id="Teacher_NameTHL" onKeyUp="ThaiOnly(this)" data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกนามสกุลอาจารย์' required>
                        </div>
                        </div>
                        
                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>ชื่ออาจารย์ (ENG)</label>
                        <div class='col-sm-4' align='left'>
                        <input type="text" name="Teacher_NameENGF" class="form-control" id="Teacher_NameENGF" onKeyUp="englishOnly(this)" data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกชื่ออาจารย์' required>
                        </div>
                        </div>
                        
                         <div class='form-group'>
                        <label class='col-sm-3 control-label'>นามสกุล (ENG)</label>
                        <div class='col-sm-4' align='left'>
                        <input type="text" name="Teacher_NameENGL" class="form-control" id="Student_NameENGL" onKeyUp="englishOnly(this)" data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกนามสกุลอาจารย์' required>
                        </div>
                        </div>

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
                       <select name="Major_ID" id="major-list" class="form-control" onChange="getYears(value);" required >
                                <option value="">กรุณาเลือกคณะ</option> 
                                </select>
                        </div>
                        </div>




                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>วันเกิด</label>
                        <div class='col-sm-3' align='left'>
                       <input name="teacher_birthday" type="date" data-fv-notempty='true' class="form-control" data-fv-notempty-message='กรุณาเลือกวันเกิด' required>
                        </div>
                        </div>

                        



                        <div class='form-group'>
                        <label class='col-sm-3 control-label'>Pic</label>
                        <div class='col-sm-5' align='left'>
                        <input type='file' name='pic' id='pic' class='form-control' class="form-control" data-fv-notempty='false'> เลือกรูปภาพ.
                        </div>
                        </div>

                        

                        <div class="panel-footer">
                           <input class="btn btn-success btn-lg" type="submit" name="btnsave" value="บันทึก" > &nbsp;
                           <input class="btn btn-danger btn-lg" type="reset" name="clear" onClick="ClearForm();" value="ล้างข้อมูล" >
                        </div>
                        </form>
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
    
    <script src="../js/dropdown.js"></script>
   
</body>
</html>
