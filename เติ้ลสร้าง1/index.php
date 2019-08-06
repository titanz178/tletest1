<?php
session_start();
$user_id=$_SESSION['user_id'];
include '../../include/connectdb.php';
include '../../include/permission.php';
if($meeting == "0"){
  echo "You do not have permission to access.!";
  header('refresh:2;url=../../index.php');
  exit();  
}

if($_SESSION['user_id'] == "")
{
    echo "Please Login!";
    header('refresh:2;url=../../index.php');
    exit();
}

$today=date("Y-m-d");
// select data from company
$sql_com = "SELECT * FROM company WHERE company_id=$company_id";
$query_com = mysqli_query($connect,$sql_com);
$data_com = mysqli_fetch_assoc($query_com);
//select data user
$sql_user="SELECT * FROM tb_user,department,position WHERE tb_user.position_id=position.position_id AND tb_user.department_id=department.department_id AND tb_user.user_id=$user_id";
$query_user=mysqli_query($connect,$sql_user);
$data_user=mysqli_fetch_assoc($query_user);
// select name of meeting_room
$meet_room="SELECT meeting_room_name FROM meeting_room WHERE meeting_room_status ='Y' ";
$q_meet_room=mysqli_query($connect,$meet_room);
//select course to day.
$sql_course="SELECT * FROM `tbl_course` WHERE ('$today'=`dateStart`) OR ('$today'=`dateEnd`) OR ('$today' BETWEEN `dateStart` AND `dateEnd`)  ";
$q_course=mysqli_query($connect,$sql_course);
// select course to user_id.
$sql_course_uid="SELECT * FROM `tbl_course` WHERE `user_code` = '$data_user[user_name]' order by  tbl_course_id DESC";
$q_course_uid=mysqli_query($connect,$sql_course_uid);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ปฏิทินสัมมนา</title>
     <!-- Datepicker -->
    <link rel=stylesheet href="../meeting/lib/datepicker/jquery-ui.css">
    <link rel=stylesheet href="../meeting/lib/datepicker/jquery-ui-timepicker-addon.css">
    <link rel="stylesheet" type="text/css" href="../meeting/css/bootstrap-datetimepicker.css">  
    <!-- Bootstrap -->
    <link href="../../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styling plus plugins -->
    <link href="../../build/css/custom.min.css" rel="stylesheet"> 
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!--fancybox --> 
    <link rel="stylesheet" type="text/css" href="../meeting/fancy/jquery.fancybox.css" type="text/css" media="screen">  
    <!-- fullcalendar -->
    <link rel="stylesheet" type="text/css" href="../../include/fullcalendar/fullcalendar.css" rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="../../include/fullcalendar/fullcalendar.print.css" rel='stylesheet' media='print'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Timepicker -->
    <link rel="stylesheet" type="text/css" href="../../include/timepicker/jquery.timepicker.css">
    <!-- POP UP CSS -->
    <link rel=stylesheet href="../../vendors/popup/colorbox.css">  
    <style type="text/css">  
      .mylabel{  
          display: inline-block;  
          width: 150px;  
          margin-bottom: 10px;          
      }  
    </style> 
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
<!-- Side Menu -->
<?php include '../../include/user_menu.php'; ?>
<!-- End Side Menu -->
        </div>

<!-- Top Menu -->
<?php include '../../include/top_menu.php'; ?>
<!-- End Top Menu -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small>  <span style="color: red">กำลังDev อยู่  <?php $d_name_user['department_id']='35' ?></span>  </small></h3>              
              </div>
                
              <div class="title_right">
                <form action="" method="POST" class="form-inline" role="form">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                      <div class="input-group">
                      
                    <?php 
                   	 if($d_name_user['department_id']=='15' || $d_name_user['department_id']=='35'){
                    ?>
                        <a class="btn btn-primary" data-toggle="modal" href='#modal-id'>จองหลักสูตรอบรม </a> 
                        <a class="btn btn-warning" data-toggle="modal" href='#modal-Edit_id'>แก้ไข </a> 
                    <?php
                	}
                    ?>
                      </div>
                    </div>
                </form>
              </div>
            </div>
             
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if(isset($msg)){echo "$msg";} ?>        
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                  <!-- content here --> 
                  <div class="row">
                    <div class="col-lg-12">
                        <p><h4><u><b>ปฏิทินสัมมนา</b></u></h4></p>
                    </div>
                  </div>

                    <div class="panel panel-default" style="margin-top: 15px">
                        <div class="panel-heading">
                            <b>หัวข้ออบรมของวันนี้</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="home-pills">
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th><center>หลักสูตรอบรม</center></th>
                                                    <th><center>วันที่</center></th>
                                                    <th><center>ตั้งแต่เวลา</center></th>
                                                    <th><center>ผู้ขอใช้</center></th>
                                                    <th><center>บริษัท</center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            while($data_course=mysqli_fetch_assoc($q_course)){

                                                $dmt1=date_create($data_course['dateStart']);
                                                $dmt1_1=date_format($dmt1,"d/m/Y");
                                                $dmt2=date_create($data_course['dateEnd']);
                                                $dmt2_2=date_format($dmt2,"d/m/Y");

                                                $st1=substr($data_course['timeStart'], 0, 5);
                                                $et1=substr($data_course['timeEnd'], 0, 5);


                                                if($data_course['company_id']==1){
                                                    $company_name1='บริษัท สโตนเฮ้นจ์ อินเตอร์ จำกัด (มหาชน)';
                                                }else if($data_course['company_id']==2){
                                                    $company_name1='บริษัท สโตนเฮ้นจ์ จำกัด (มหาชน)';
                                                }
                                            ?>
                                                <tr>
                                                    <td align="center"><?php echo $data_course['courseName']; ?></td>
                                                    <td><center><?php echo $dmt1_1 .'&nbsp;-&nbsp;'. $dmt2_2; ?></center></td>
                                                    <td><center><?php echo $st1; ?> - <?php echo $et1; ?> น.</center></td>                                                    
                                                    <td><center><?php echo $data_course['user_name']; ?></center></td>
                                                    <td><center><?php echo $company_name1; ?></center></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-pills">
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th><center><font size=2>โครงการ</font></center></th>
                                                    <th><center><font size=2>วันที่</font></center></th>
                                                    <th><center><font size=2>ตั้งแต่เวลา</font></center></th>
                                                    <th><center><font size=2>ผู้ขอใช้</font></center></th>
                                                    <th><center><font size=2>บริษัท</font></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            while($data_room3=mysqli_fetch_assoc($query_room3)){

                                                $dmt3=date_create($data_room3['start_date']);
                                                $dmt3_3=date_format($dmt3,"d/m/Y");

                                                $st1=substr($data_room3['start_time'], 0, 5);
                                                $et1=substr($data_room3['end_time'], 0, 5);


                                                if($data_room3['company_id']==1){
                                                    $company_name3='บริษัท สโตนเฮ้นจ์ อินเตอร์ จำกัด';
                                                }else if($data_room3['company_id']==2){
                                                    $company_name3='บริษัท สโตนเฮ้นจ์ จำกัด';
                                                }
                                            ?>
                                                <tr>
                                                    <td><font size=2><?php echo $data_room3['project_meeting']; ?></font></td>
                                                    <td><center><font size=2><?php echo $dmt3_3; ?></font></center></td>
                                                    <td><center><font size=2><?php echo $st1; ?> - <?php echo $et1; ?></font></center></td>                                                    
                                                    <td><center><font size=2><?php echo $data_room3['user_name']; ?></font></center></td>
                                                    <td><center><font size=2><?php echo $company_name3; ?></font></center></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="messages-pills">
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th><center><font size=2>โครงการ</font></center></th>
                                                    <th><center><font size=2>วันที่</font></center></th>
                                                    <th><center><font size=2>ตั้งแต่เวลา</font></center></th>
                                                    <th><center><font size=2>ผู้ขอใช้</font></center></th>
                                                    <th><center><font size=2>บริษัท</font></center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                            while($data_room2=mysqli_fetch_assoc($query_room2)){

                                                $dmt2=date_create($data_room2['start_date']);
                                                $dmt2_2=date_format($dmt2,"d/m/Y");

                                                $st2=substr($data_room2['start_time'], 0, 5);
                                                $et2=substr($data_room2['end_time'], 0, 5);

                                                if($data_room2['company_id']==1){
                                                    $company_name2='บริษัท สโตนเฮ้นจ์ อินเตอร์ จำกัด';
                                                }else if($data_room2['company_id']==2){
                                                    $company_name2='บริษัท สโตนเฮ้นจ์ จำกัด';
                                                }
                                            ?>
                                                <tr>
                                                    <td><font size=2><?php echo $data_room2['project_meeting']; ?></font></td>
                                                    <td><center><font size=2><?php echo $dmt2_2; ?></font></center></td>
                                                    <td><center><font size=2><?php echo $st2; ?> - <?php echo $et2; ?></font></center></td>                                                    
                                                    <td><center><font size=2><?php echo $data_room2['user_name']; ?></font></center></td>
                                                    <td><center><font size=2><?php echo $company_name2; ?></font></center></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>                  
                  <!-- content here -->
                  </div>
                </div>
              </div>
            </div>            



            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_content">
                    <br />
                  <!-- content here --> 
                  <div id='calendar'></div>                              
                  <!-- content here -->
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
        <!-- /page content -->

<!-- footer content -->
<?php include '../../include/footer_menu.php'; ?>
<!-- /footer content -->
      </div>
    </div>

    
           
  </body>
</html>
<div class="modal fade" id="modal-id" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 style="text-align: center;color: black"><small><b>กรุณากรอกรายละเอียด</b></small></h3>
      </div>
      <div class="modal-body">
        <form action="courseAdd.php" method="POST" role="form">
        <div class="row ">
          <div class="form-group col-lg-4">
            <label for="">รหัสพนักงาน</label>
            <input disabled type="text" class="form-control" name="user_code" placeholder="Input field" value="<?=$data_user['user_name'];?>" required>
          </div>
          <div class="form-group col-lg-4">
            <label for="">ชื่อ - นามสกุล</label>
            <input disabled type="text" name="user_name" class="form-control" placeholder="Input field" required value="<?=$data_user['full_name'];?>" required>
          </div>
          <div class="form-group col-lg-4">
            <label for="">ตำแหน่ง</label>
            <input disabled type="text" name="position" class="form-control" placeholder="Input field" required value="<?=$data_user['position_name'];?>" required>
          </div>
        </div>
    
        <div class="row ">
          <div class="form-group col-lg-6">
            <label for="">แผนก</label>
            <input disabled type="text" name="department_name" class="form-control" placeholder="Input field" required value="<?=$data_user['department_name'];?>"required>
          </div>  
          <div class="form-group col-lg-6">
            <label for="">บริษัท</label>
            <input disabled type="text" name="company_id" class="form-control" placeholder="Input field" required value="<?=$data_com['company_name'];?>"required>
          </div>        
        </div>
     

        <div class="row ">
          <div class="form-group col-lg-6">
            <label for="">หัวข้อ/หลักสูตรอบรม</label>
            <input type="text" autocomplete="off" name="courseName" class="form-control" placeholder="Input field" required>
          </div>  
          <div class="form-group col-lg-3">
            <label for="">วันที่เริ่ม</label>
            <input autocomplete="off" type="text" name="dateStart" class="form-control dateFile" placeholder="Input field" id="dateStart" required>
          </div> 
          <div class="form-group col-lg-3">
            <label for="">จองถึงวันที่</label>
            <input autocomplete="off" type="text" name="dateEnd" class="form-control dateFile" placeholder="Input field" id="dateEnd" required>
          </div>
        </div>

        <div class="row">
          <!-- <div class="form-group col-lg-3">
            <label for="">เวลาเริ่ม</label>
            <input type="text" autocomplete="off" class="form-control" name="timeStart" id="start_time" required>
          </div>
          <div class="form-group col-lg-3">
            <label for="">เวลาสิ้นสุด</label>
            <input type="text" autocomplete="off" class="form-control" name="timeEnd"  id="end_time" required>
          </div> -->
            <div class="form-group col-lg-3" >
			  <label for="sel1">ช่วงเวลา:</label>
			  <select class="form-control" id="timeStart" name="timeStart" required>
			  	<option value="" >&emsp;-- เลือกช่วงเวลา --</option>
			    <option value="1">ช่วงเช้า | 08.00 - 12.00 น.</option>
			    <option value="2">ช่วงบ่าย | 13.00 - 17.00 น.</option>
			    <option value="3">เต็มวัน  | 08.00 - 17.00 น.</option>
			  </select>
			</div>
          <div class="form-group col-lg-3">
            <label for="sel1">สถานที่:</label>
			  <select name="location" class="form-control" id="location" required="required">
			  	<option value="" style="text-align: center;">-- เลือกห้องประชุม --</option>
			    <?php 
			    while ($d_meet_room=mysqli_fetch_assoc($q_meet_room)) {
				
			     ?>
			     	<option value="<?= $d_meet_room['meeting_room_name']?>"><?= $d_meet_room['meeting_room_name']?></option>
			     <?php  }?>
			  </select>
          </div>
          <div class="form-group col-lg-3">
            <label for="">วิทยากร</label>
            <input type="text" autocomplete="off" class="form-control" name="lecturer"   required>
          </div>
                       
        </div>
        <div class="row">
          <div class="col-lg-12">
            <label style="color: black">สถานะ:</label> 
            <span id="success" style="color: green">สามารถจองได้</span> 
            <span id="fail" style="color:red">เวลาที่ท่านเลือกมีผู้อื่นจองแล้ว กรุณาเลือกใหม่</span>
          </div> 
        </div> 

        <div class="row">
          <div class="col-lg-12">
            <label for="">กลุ่มเป้าหมาย/ผู้เข้าร่วมโครงการ</label>
            <textarea name="demand" id="input" class="form-control" rows="5"  required></textarea>
          </div>
       
        </div>
        <br>
        

        <?php echo" <input type='hidden' class='form-control' name='user_code'  value='$data_user[user_name]'>"; ?>
        <?php echo" <input type='hidden' class='form-control' name='user_name'  value='$data_user[full_name]'>"; ?>
        <?php echo" <input type='hidden' class='form-control' name='department_name'  value='$data_user[department_name]'>"; ?>
        <?php echo" <input type='hidden' class='form-control' name='position'  value='$data_user[position_name]'>"; ?>
        <?php echo" <input type='hidden' class='form-control' name='company_id'  value='$data_com[company_id]'>"; ?>          
        
          <input type="submit" name="submit" value="Submit" class="btn btn-primary " id="submit">
        </form>

      </div>
      <div class="modal-footer">

      </div>
    </div>
  </div>
</div>
   
<!-- การจัดการแก้ไข -->

   <div class="modal fade" id="modal-Edit_id">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 style="text-align: center;"><small><b style="">แก้ไขข้อมูล</b></small></h3><hr>
            <table width="100%" style="text-align:center;" class="table table-striped table-bordered">
                <tr >
                    <td width="5%"><b>ลำดับ</b></td>
                    <td><b>หัวข้ออบรม</b></td>
                    <td><b>วันที่อบรม</b></td>  
                    <td><b>เวลาเริ่มอบรม</b></td>
                    <td width="15%"><b>แก้ไข</b></td>
                    <td width="15%"><b>ลบ</b></td>
                </tr>
                <?php 
                    $rowCourse = mysqli_num_rows($q_course_uid); //นับข้อมูลเพื่อไม่สร้างตารางแก้ไข
                   if ($rowCourse<0) {
                       echo '<tr><td colspan="6" align="center"><span style="color: green;">ไม่มีหัวข้อหลักสูตรที่ท่านได้เพิ่มไว้</span></td></tr>';
                   }else{
                        $number =1;
                        while ($d_courseUser = mysqli_fetch_assoc($q_course_uid)) {
                   ?>   
                    <tr>
                        <td><?=$number?></td>
                        <td><?=$d_courseUser['courseName']?></td>
                        <?php $dStart=date_create($d_courseUser['dateStart']); ?>
                        <?php $dEnd=date_create($d_courseUser['dateEnd']); ?>
                        <td><?= date_format($dStart,"d/m/Y ") ?> - <?= date_format($dEnd,"d/m/Y ") ?></td>
                        <td> เริ่ม <?=$d_courseUser['timeStart']?> - <?=$d_courseUser['timeEnd']?> น.</td>
                        <td>
                            <a  class='iframe' href='courseEdit.php?edit_id=<?=$d_courseUser['tbl_course_id']?>' ><i class="fas fa-pencil-alt fa-2x"></i></a>

                        </td>


                        <td><a  href="#" onclick="dalete_data(<?=$d_courseUser['tbl_course_id'] ?>,'<?=$d_courseUser['courseName'] ?>' )"><i class="fas fa-trash-alt fa-2x"></i></a></td>
                    </tr>
                   <?php   
                       $number++; }
                   }
                 ?>
                 
            </table>
      </div>
    </div>
  </div>
 </div>



<!-- jQuery -->
    <script src="../../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../../build/js/custom.min.js"></script>
    <!-- full calender -->
    <script src="../meeting/lib/moment.min.js"></script>
    <script src="../../include/fullcalendar/fullcalendar.min.js"></script>
    <script src="../meeting/lang/th.js"></script>
    <!--fancybox --> 
    <script src="../meeting/fancy/jquery.fancybox.pack.js"></script>
    <script src="../meeting/fancy/helpers/jquery.fancybox-thumbs.js"></script>
    <script src="../meeting/fancy/helpers/jquery.fancybox-buttons.js"></script> 
    <!-- script src="js/moment-with-locales.js"></script-->
    <script src="../meeting/src/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript">
    jQuery( document ).ready(function() {   
          //var currentLangCode = 'th';
          $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },          
                eventLimit: true, // allow "more" link when too many events
                defaultDate: new Date(),
                //lang: currentLangCode,
                timezone: 'Asia/Bangkok',
                events: {
                url: 'data_course.php',
                },  
                loading: function(bool) {
                    $('#loading').toggle(bool);
                },
                
                eventClick: function(event) {
        if (event.url) {
          $.fancybox({
                    'href' : event.url,
                    'type' : 'iframe',
                    'autoScale'         : false,
                    'openEffect' : 'elastic',
                    'openSpeed'  : 'fast',
                    'closeEffect' : 'elastic',
                    'closeSpeed'  : 'fast',
                    'closeBtn'  : true,
                    onClosed    :   function() {
                        parent.location.reload(true); 
                    },
                    helpers : {
                        thumbs : {
                            width  : 50,
                            height : 50
                        },
                        
                        overlay : {
                                css : {
                                    'background' : 'rgba(49, 176, 213, 0.7)'
                         }
                         }
                    }
                });
          return false;
        }
      },       
            
            });
        });
    </script> 
    <style>
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }

    </style> <!-- end fullCalendar -->
   
  <!-- ------------- function เซ็คการจองซ้ำ-------------------->
<script>
	$(document).ready(function(){
	 $("#success").hide();
	 $("#fail").hide();

	  $("#dateStart,#dateEnd,#timeStart,#location").change(function(){
	  	var dateStart = $("#dateStart").val();
	  	var dateEnd = $("#dateEnd").val();
	  	var Ptime = $("#timeStart").val();
	  	var location = $("#location").val();
	  	if (Ptime=='1') {
	  	 var timeStart = '08:00:00';
	  	 var timeEnd= '12:00:00';
	  	}else if (Ptime=='2') {
	  	 var timeStart = '13:00:00';
	  	 var timeEnd= '17:00:00';
	  	}else if (Ptime=='3') {
	  	 var timeStart = '08:00:00';
	  	 var timeEnd= '17:00:00';
	  	}
	  	checkdata();
	  	function checkdata(){//ตรวจสอบข้อมูลซ้ำ
	  	    $.post("checkvalidate.php",
		    {
		      dateStart: dateStart,
		      dateEnd: dateEnd,
		      timeStart: timeStart,
		      timeEnd: timeEnd,
		      location:location,
		    },
		    function(data){
		      if (data==1) {//ห้องเต็ม
		      	$("#fail").show();
		      	$("#success").hide();
		      	$('#submit').addClass("disabled");
		      }
		      if (data==2) { //ห้องว่าง
		      	$("#success").show();
		      	$("#fail").hide();
		      	$('#submit').removeClass("disabled");
		      }
		    });
	    }

	  
	  });
      //-------ลบข้อมูลจากตาราง DB-----
	});
</script>

<script type="text/javascript"> //ลบข้อมูลใน DB
    function dalete_data(id,nameCourse){
        var r = confirm('คุณต้องการลบข้อมูลของหัวข้อ '+nameCourse+' หรือไม่?');
        if (r==true) {
            $.post("courseDelete.php",
            {
              edit_id: id,
            },
            function(data){
                // load the url and show modal on success
                $("#modal-Edit_id .modal-body").load(target, function() { 
                     $("#modal-Edit_id").modal("show"); 
                });
            });
        }
    }
</script>

<!-- date Picker -->
    <script src="../meeting/lib/datepicker/jquery-ui.min.js"></script>   
    <script src="../meeting/lib/datepicker/jquery-ui-timepicker-addon.js"></script>   
    <script src="../meeting/lib/datepicker/jquery-ui-sliderAccess.js"></script> 
    <script type="text/javascript">
    $(function(){
        $(".dateFile").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
    </script>   
    <!--timepicker-->
    <script src="../../include/timepicker/jquery.timepicker.js"></script> 
    <script src="../../include/timepicker/lib/site.js"></script>
    <script>
        $(function() {
            $('#start_time').timepicker({ 'timeFormat': 'H:i' });
        });
        $(function() {
            $('#end_time').timepicker({ 'timeFormat': 'H:i' });
        });
    </script> 

    <!-- POP UP -->
    <script src="../../vendors/popup/jquery.colorbox.js"></script>
    <script>
            $(document).ready(function(){
                //Examples of how to assign the Colorbox event to elements
                $(".iframe").colorbox({width:"50%", height:"100%", iframe:true, onOpen:function() { $("body").css("overflow", "hidden"); }, onClosed:function() { $("body").css("overflow", "auto"); }});
            });
    </script>       