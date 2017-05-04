
<html xmlns="http://www.w3.org/1999/xhtml" > 
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>STUDENT MANAGEMENT</title>
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css' />
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>
<script src='js/formValidation.min.js'></script>
<script src='js/framework/bootstrap.min.js'></script>
<script src='js/moment-with-locales.js'></script>
<script src='js/bootstrap-datetimepicker.js'></script>
<link href='css/bootstrap-datetimepicker.css' rel='stylesheet'>
<script src='js/bootbox.min.js'></script>
<script>
$(document).ready(function() {
$('#frm_student').formValidation();
});
function chkdel(id){
if(confirm('Do you want to Delete >>> '+id+' <<<\r\nPlease... Confirm to Delete !!!  ')){
return true;
}else{
return false;
}
}

$(function () {
$('#datetimepicker_student_birthday').datetimepicker({
//daysOfWeekDisabled: [0, 6],
locale:'en',
format:'YYYY-MM-DD'
}
);
});
$(function () {
$('#datetimepicker_Semes_Start').datetimepicker({
//daysOfWeekDisabled: [0, 6],
locale:'en',
format:'YYYY-MM-DD'
}
);
});
$(document).on('click', '.confirm_delete', function(e) {
var show = $(this).data('show');
e.preventDefault();

bootbox.confirm({
title:'Confirm for Delete!!!',
//size: 'small',
message: 'Do you want to Delete <<< <b>'+ show+' </b>>>> ?',
buttons: {
confirm: {
label:'Confirm',
className:'btn-success'
},
cancel: {
label:'Cancel',
className:'btn-danger'
}

},
callback: function(result){
if (result) {
window.location.href = e.target.href;
}
}
});

});
</script>

</head>







<form class='form-horizontal' id='frm_student' action="student.php?submit=OK&show=OK&Select_ID=" method="post"  enctype='multipart/form-data'data-fv-framework='bootstrap'
data-fv-icon-valid='glyphicon glyphicon-ok'
data-fv-icon-invalid='glyphicon glyphicon-remove'
data-fv-icon-validating='glyphicon glyphicon-refresh'>
<div class='form-group'>
<label class='col-sm-5 control-label'>Student_ID</label>
<div class='col-sm-5' align='left'>
<input name='Student_ID' id='Student_ID'  type='text' class="form-control" maxlength="13" onKeyPress="CheckNum()" data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกรหัสนักศึกษา'>
</div>
</div>

<div class='form-group'>
                        <label class='col-sm-3 control-label'>ชื่อนักศึกษา (TH)</label>
                        <div class='col-sm-4' align='left'>
                        <input type="text" name="Student_NameTHF" class="form-control" id="Student_NameTHF" onKeyUp="ThaiOnly(this)" data-fv-notempty='true' data-fv-notempty-message='กรุณากรอกชื่อนักศึกษา'>
                        </div>
                        </div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Student_NameENG</label>
<div class='col-sm-5' align='left'>
<input name='Student_NameENG' id='Student_NameENG' type='text' class='form-control' data-fv-notempty='true' data-fv-notempty-message='Please Enter...'>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Class_ID</label>
<div class='col-sm-5' align='left'>
<select name='Class_ID' id='Class_ID' class='form-control' data-fv-notempty='true' data-fv-notempty-message='Please Enter...'>
<?php
$rstTemp=mysqli_query($conn,'select * from class');
while($arr_2=mysqli_fetch_array($rstTemp)){
?>
<option value="<?php echo $arr_2['Class_ID']?>"><?php echo $arr_2['Class_NameTH']?></option>
</select>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Faculty_ID</label>
<div class='col-sm-5' align='left'>
<select name='Faculty_ID' id='Faculty_ID' class='form-control' data-fv-notempty='true' data-fv-notempty-message='Please Enter...'>
<?php
$rstTemp=mysqli_query($conn,'select * from faculty');
while($arr_2=mysqli_fetch_array($rstTemp)){
?>
<option value="<?php echo $arr_2['Faculty_ID']?>"><?php echo $arr_2['Faculty_NameTH']?></option>
<?php }?>
</select>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Major_ID</label>
<div class='col-sm-5' align='left'>
<select name='Major_ID' id='Major_ID' class='form-control' data-fv-notempty='true' data-fv-notempty-message='Please Enter...'>
<?php
$rstTemp=mysqli_query($conn,'select * from major');
while($arr_2=mysqli_fetch_array($rstTemp)){
?>
<option value="<?php echo $arr_2['Major_ID']?>"><?php echo $arr_2['Major_NameTH']?></option>
<?php }?>
</select>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Student_Address</label>
<div class='col-sm-5' align='left'>
<input name='Student_Address' id='Student_Address' type='text' class='form-control' data-fv-notempty='true' data-fv-notempty-message='Please Enter...'>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Student_birthday</label>
<div class='col-sm-5' align='left'>
<div class='input-group date ' id='datetimepicker_student_birthday'>
<input type='text' class='form-control' name='student_birthday' id='student_birthday' />
<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
</div>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Student_Telephone</label>
<div class='col-sm-5' align='left'>
<input name='Student_Telephone' id='Student_Telephone' type='number' min='0' step='1' class='form-control' data-fv-notempty='false' data-fv-notempty-message='Please Enter...'>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Semes_Start</label>
<div class='col-sm-5' align='left'>
<div class='input-group date ' id='datetimepicker_Semes_Start'>
<input type='text' class='form-control' name='Semes_Start' id='Semes_Start' />
<span class='input-group-addon'><span class='glyphicon glyphicon-calendar'></span></span>
</div>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Student_sex</label>
<div class='col-sm-5' align='left'>
<label class='btn btn-primary '>
<input  name='student_sex'  type='radio' value='0'> ชาย
</label>
<label class='btn btn-primary '>
<input  name='student_sex'  type='radio' value='1'> หญิง
</label>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Student_titlename</label>
<div class='col-sm-5' align='left'>
<input name='student_titlename' id='student_titlename' type='text' class='form-control' data-fv-notempty='false' data-fv-notempty-message='Please Enter...'>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Status</label>
<div class='col-sm-5' align='left'>
<label class='btn btn-primary '>
<input  name='status'  type='radio' value='0'> ปกติ
</label>
<label class='btn btn-primary '>
<input  name='status'  type='radio' value='1'> จบการศึกษา
</label>
<label class='btn btn-primary '>
<input  name='status'  type='radio' value='2'> พ้นสภาพ
</label>
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Pic</label>
<div class='col-sm-5' align='left'>
<input type='file' name='pic' id='pic' class='form-control' data-fv-notempty='false' data-fv-notempty-message='Please Enter...'> Select a Picture.
</div>
</div>

<div class='form-group'>
<label class='col-sm-5 control-label'>Fileupload</label>
<div class='col-sm-5' align='left'>
<input type='file' name='fileupload' id='fileupload' class='form-control' data-fv-notempty='false' data-fv-notempty-message='Please Enter...'> Select a File.
</div>
</div>

<div class='form-group'>
<div class='col-sm-offset-2 col-sm-10'>
<button type='submit' class='btn btn-success'>Insert Data</button>
<button type='button' class='btn btn-danger' onClick="document.location.href='student.php?show=OK'">Cancle</button>
</div>
</div>
</form>
<?php }?>


</div>
 </div>
</div>
</div>
</div>


