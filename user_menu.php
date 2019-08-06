<?php
$h_level=$_SESSION['level_id'];

$ch1=$_SESSION['ch1']; //กำหนดหัวเรื่องชื่อโครงการ
  if (isset($ch1)) {
        $status_id = $ch1; //ถ้าค่าเป็น 1 หา Pre-Con, 2 หา For-Con, 3 //Project End
        if ($status_id==1) {
            $titlename = 'Pre-Con';
        }
        else if ($status_id==2) {
            $titlename = 'For-Con';
        }
        else if ($status_id==3) {
            $titlename = 'จบโครงการ';
        }
    }

$s_name = "SELECT tb_user.user_id,tb_user.full_name,position.position_name,tb_user.userphoto,tb_user.level_id,tb_user.group_id,position.position_id,tb_user.department_id FROM tb_user,position WHERE tb_user.position_id=position.position_id AND tb_user.user_id=$_SESSION[user_id]";
$q_name = mysqli_query($connect, $s_name);
$d_name_user = mysqli_fetch_array($q_name);
include 'permission.php';
if($company_id=='1'){
  $article1='1';
  $article2='2';
  $article3='3';
  $article4='4';
  $article6='6';
  $article7='7';
}elseif($company_id=='2'){
  $article1='8';
  $article2='9';
  $article3='10';
  $article4='11';
  $article6='12';
  $article7='13';
}
//ข้อมูลพนักงาน
$sql_menu_profile = "SELECT * FROM department WHERE company_id=$company_id";
$query_menu_profile = mysqli_query($connect, $sql_menu_profile);

include 'eva_assign.php';
?>
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.php" class="site_title"><img src="<?php echo $url; ?>images/<?=$d_title['images']?>" alt="" width="35"> <span><?php echo $d_title['title2']; ?> </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile">
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><br/>
                  <center><img src="<?php echo $url; ?>userphoto/<?= $d_name_user['userphoto'] ?>" width="150" class="img-thumbnail">
                  <p style="margin-top: 10px"><font color="#ffffff"><?php echo $d_name_user['full_name']; ?></font><br/>
                  <font color="#ffffff"><?php echo $d_name_user['position_name']; ?></font></p>
                  </center>
                </div>
              </div>

            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">                
                <ul class="nav side-menu">
                  <li><a href="<?php echo $url; ?>user/index.php"><i class="fa fa-home"></i> หน้าแรก </a></li>

                  <?php
                  if($u_level_id=='4'){
                  ?>
                  <li><a href="<?php echo $url; ?>admin/index.php"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                  <li><a><i class="fa fa-database"></i> Log Viewer <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $url; ?>admin/history_project.php">โครงการที่ผ่านมา</a></li>
                    </ul>
                  </li>                  
                  <?php
                  }
                  ?>
                  <li><a><i class="fa fa-folder-open-o"></i> ระบบงาน <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php
                        echo $create_project;
                        echo $moveUser;
                        echo $userViewUpdate;
                        echo $userCreateDoc;
                      ?>
                    <?php
                    if ($u_level_id == '4') {
                    ?>
                    <li><a>โครงการ <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                         <li ><a>Pre-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_pre = mysqli_fetch_assoc($q_pre)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_pre['project_id'] ?>"><?php echo $d_pre['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>For-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_for = mysqli_fetch_assoc($q_for)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_for['project_id'] ?>"><?php echo $d_for['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>จบโครงการ<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_end = mysqli_fetch_assoc($q_end)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_end['project_id'] ?>"><?php echo $d_end['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>                                                
                      </ul>
                      <li><a href="<?php echo $url; ?>module-user/md/sum_index.php">สรุปรายงานการตรวจห้อง</a></li>  
                      <?php

                    }elseif($u_level_id == '6'){
                    ?>  
                    <li><a>โครงการ <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                         <li ><a>Pre-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_pre = mysqli_fetch_assoc($q_pre)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_pre['project_id'] ?>"><?php echo $d_pre['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>For-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_for = mysqli_fetch_assoc($q_for)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_for['project_id'] ?>"><?php echo $d_for['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>จบโครงการ<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_end = mysqli_fetch_assoc($q_end)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_end['project_id'] ?>"><?php echo $d_end['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>                         
                      </ul>
                    <?php
                    }elseif($u_level_id=='5'){
                    ?>
                    <li><a>โครงการ <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                         <li ><a>Pre-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_pre = mysqli_fetch_assoc($q_pre)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_pre['project_id'] ?>"><?php echo $d_pre['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>For-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_for = mysqli_fetch_assoc($q_for)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_for['project_id'] ?>"><?php echo $d_for['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>จบโครงการ<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_end = mysqli_fetch_assoc($q_end)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_end['project_id'] ?>"><?php echo $d_end['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>                         
                      </ul>
                    <?php
                    }elseif($u_level_id=='2'){
                    ?>
                    <li><a>โครงการ <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                         <li ><a>Pre-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_pre = mysqli_fetch_assoc($q_pre)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_pre['project_id'] ?>"><?php echo $d_pre['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>For-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_for = mysqli_fetch_assoc($q_for)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_for['project_id'] ?>"><?php echo $d_for['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>จบโครงการ<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_end = mysqli_fetch_assoc($q_end)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_end['project_id'] ?>"><?php echo $d_end['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>                         
                      </ul>
                    <?php
                    }elseif($u_level_id=='13'){
                    ?>
                    <li><a>โครงการ <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                         <li ><a>Pre-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_pre = mysqli_fetch_assoc($q_pre)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_pre['project_id'] ?>"><?php echo $d_pre['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>For-Con<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_for = mysqli_fetch_assoc($q_for)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_for['project_id'] ?>"><?php echo $d_for['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>
                         <li ><a>จบโครงการ<span class="fa fa-chevron-down"></span></a>
                           <ul class="nav child_menu">
                           <?php
                          while ($d_end = mysqli_fetch_assoc($q_end)) {
                            ?>
                             <li><a href="<?php echo $url; ?>user/home.php?project_id=<?= $d_end['project_id'] ?>"><?php echo $d_end['project_group_name']; ?></a></li>
                            <?php

                          }
                          ?>
                           </ul>
                         </li>                         
                      </ul>


                      <?php
                      }
                      ?>
                      
                      <?php
                      if($u_level_id=='4' OR $u_level_id=='5' OR $u_level_id=='6' OR $user_trans!="" OR $userTransData!=""){
                      ?>
                      <li ><a>โอนย้ายพนักงาน<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <?php echo $user_transEvp; ?>
                          <?php echo $user_trans; ?>
                          <?php echo $userTransData; ?>
                        <?php if($u_level_id=='5' OR $u_level_id=='6'){ ?>
                          <li><a href="<?php echo $url; ?>module-admin/manage-user/transfer_user.php">แจ้งโอนย้ายพนักงาน</a></li>
                          <li><a href="<?php echo $url; ?>module-admin/manage-user/transferUserData.php">ข้อมูลโอนย้ายพนักงาน(PM)</a></li>
                        <?php } ?>
                        </ul>
                      </li> 
                      <?php
                      }
                      ?>                      
                      
                      <li><a href="<?php echo $url; ?>module-user/personnel/index.php"> แผนงานโครงการและบุคลากร </a></li><!-- ประเมิน -->     
                
                      <?php
                      if($chcek_doc_md=='1'){  
                      ?>
                        <li><a href="<?php echo $url; ?>user/home_report.php"> การตรวจแฟ้มเอกสารในหน่วยงานก่อสร้าง</a></li>
                      <?php
                      }
                      ?>
                      <?php
                      if($d_single['group_list_id']=='11'){
                      ?>
                      <li><a href="<?php echo $url; ?>/module-admin/helpdesk/equipment.php"> ผู้ดูแลอุปกรณ์สำนักงาน</a></li>
                      <?php
                      }
                      ?>
                    <?php
                    if($eva_status=='1'){
                    ?>
                    <li><a> ข้อมูลพนักงาน <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu">
                        <li><a href="<?php echo $url; ?>module-admin/hr/index.php">แก้ไขข้อมูลพนักงาน</a></li>
                      </ul>
                    </li> 
                    <?php
                    }
                    ?>                     
<!-- ประเมิน --> 
                    <li><a>ประเมินผลงานพนักงาน <span class="fa fa-chevron-down"></span></a>
                      <ul class="nav child_menu"> 
                        <?php
                        if($evay=='1'){
                        ?>
                        <li><a href="<?php echo $url; ?>performance/hr_summary.php">รายงานการประเมินผลพนักงานประจำปี</a></li>
                        <?php
                        }
                        ?>                        
                        <?php
                        if($eva1=='1'){
                        ?>
                        <li><a href="<?php echo $url; ?>module-admin/eva/eva_index.php">เปิดใช้งานการประเมิน</a></li>
                        <?php
                        }
                        ?>

                        <?php
                        if($eva2=='1'){
                        ?>
                        <li><a href="<?php echo $url; ?>module-admin/eva/assign_hr.php">ให้สิทธิ์เข้าดูไฟล์ประเมิน</a></li>
                        <?php
                        }
                        ?>

                        <?php
                        if($eva3=='1' ){
                        ?>
                        <li><a href="<?php echo $url; ?>module-admin/eva/assign_eva_add.php">ให้สิทธิ์กำหนดผู้ประเมิน</a></li>
                        <?php
                        }
                        ?>

                        <?php
                        if($eva4=='1' OR $ass_hr=='1'){
                        ?>
                        <li><a href="<?php echo $url; ?>module-admin/eva/eva_index.php">เปิดใช้งานการประเมิน</a></li>
                        <li><a href="<?php echo $url; ?>module-admin/eva/assign_eva.php">กำหนดผู้ประเมิน</a></li>
                        <?php
                        }
                        ?>

                        <?php
                        if($eva5=='1' OR $eva_status=='1'){
                        ?>
                        <li><a href="<?php echo $url; ?>module-admin/eva/eva_status.php">สถานะการประเมินผลงานพนักงาน</a></li>
                        <?php
                        }
                        ?>
<!-- ส่วนกำหนดสิทธิ์การประเมินพนักงาน-->
                        <?php echo $assign_hr_button; ?>
                        <?php echo $eva_svp; ?>
                        <?php echo $eva_pd; ?>
                        <?php echo $eva_mgr; ?>
                        <?php echo $eva_site; ?>
                        <?php echo $eva_site_me; ?>
                        <?php echo $eva_off; ?>
                        <?php echo $eva_site_sef; ?>
                        <?php echo $eva_site_qa; ?>                        
<!-- ส่วนกำหนดสิทธิ์การประเมินพนักงาน--> 
                      <?php
                      if($u_level_id=='2'){
                      ?>
                        <li><a href="<?php echo $url; ?>performance_yourself/site_index0.php">ประเมินตัวเอง</a></li>
                        <li><a href="<?php echo $url; ?>performance/site_result.php">ใบสรุปผลการประเมิน</a></li>
                      <?php
                      }elseif($u_level_id=='4'){
                      ?>
                        <li><a href="<?php echo $url; ?>performance_yourself/mgr_index0.php">ประเมินตัวเอง</a></li>
                        <li><a href="<?php echo $url; ?>performance/manager_result.php">ใบสรุปผลการประเมิน</a></li>
                      <?php
                      }elseif($u_level_id=='5'){
                      ?>
                          <li><a href="<?php echo $url; ?>performance_yourself/pm_index0.php">ประเมินตัวเอง</a></li>
                          <li><a href="<?php echo $url; ?>performance/pm_result.php">ใบสรุปการประเมินผลงานพนักงาน</a></li>
                      <?php
                      }elseif($u_level_id=='6'){
                      ?>
                        <li><a href="<?php echo $url; ?>performance_yourself/pd_index0.php">ประเมินตัวเอง</a></li>
                        <li><a href="<?php echo $url; ?>performance/pd_result.php">ใบสรุปผลการประเมิน</a></li>
                        <li><a href="<?php echo $url; ?>pd-eva/site_all_result.php">สรุปผลการประเมินพนักงานภายในโครงการ</a></li>
                      <?php
                      }elseif($u_level_id=='12'){
                        if($d_smgr>0){
                      ?>
                          <li><a href="<?php echo $url; ?>performance_yourself/mgr_index0.php">ประเมินตัวเอง</a></li>
                          <li><a href="<?php echo $url; ?>performance/manager_result.php">ใบสรุปผลการประเมิน</a></li>
                      <?php
                        }elseif($d_spd>0){
                      ?>
                          <li><a href="<?php echo $url; ?>performance_yourself/pd_index0.php">ประเมินตัวเอง</a></li>
                          <li><a href="<?php echo $url; ?>performance/manager_result.php">ใบสรุปผลการประเมิน</a></li>
                      <?php
                        }else{
                      ?>
                          <li><a href="<?php echo $url; ?>performance_yourself/off_index0.php">ประเมินตัวเอง</a></li>
                          <li><a href="<?php echo $url; ?>performance/emp_result.php">ใบสรุปผลการประเมิน</a></li>
                      <?php
                        }

                      }elseif($u_level_id=='13'){
                      ?>
                        <li><a href="<?php echo $url; ?>performance_yourself/pe_index0.php">ประเมินตัวเอง</a></li>
                        <li><a href="<?php echo $url; ?>performance/pe_result.php">สรุปประเมินผลงานพนักงาน</a></li>
                      <?php
                      }elseif($u_level_id=='14'){
                      ?>
                        <li><a href="<?php echo $url; ?>performance_yourself/mgr_index0.php">ประเมินตัวเอง</a></li>
                        <li><a href="<?php echo $url; ?>performance/manager_result.php">ใบสรุปผลการประเมิน</a></li>
                      <?php
                      }
                      ?>

                      </ul>
                    </li>
<!-- ประเมิน -->                     
                    </li> 
               
                    </ul>
                  </li> 

                  <li><a><i class="fa fa-smile-o"></i> บริการ <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                    <?php
                    if($user_info=='1'){
                    ?>
                      <li><a> ข้อมูลพนักงาน <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo $url; ?>module-user/empinformation/all.php">ทั้งหมด</a></li>
                        <?php
                        while ($d_menu_profile = mysqli_fetch_assoc($query_menu_profile)) {
                          ?>
                          <li><a href="<?php echo $url; ?>module-user/empinformation/user.php?dip=<?= $d_menu_profile['department_id'] ?>"><?php echo $d_menu_profile['department_name']; ?></a></li>
                        <?php

                      }
                      ?>
                        </ul>
                      </li>
                    <?php
                    }
                    ?>

                    <?php
                    if($helpdesk=='1'){
                    ?>
                      <li><a> แจ้งซ่อม <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo $url; ?>module-user/helpdesk/ticket_com.php">แจ้งซ่อมอุปกรณ์คอมพิวเตอร์</a></li>
                          <?php
                          if($h_level=='12'){
                          ?>
                          <li><a href="<?php echo $url; ?>module-user/helpdesk/ticket_oe.php">แจ้งซ่อมอุปกรณ์สำนักงาน</a></li>
                          <?php
                          }elseif($h_level=='4'){
                          ?>
                          <li><a href="<?php echo $url; ?>module-user/helpdesk/ticket_oe.php">แจ้งซ่อมอุปกรณ์สำนักงาน</a></li>
                          <?php
                          }
                          ?>
                          <li><a href="<?php echo $url; ?>module-user/helpdesk/index.php">รายการที่แจ้ง</a></li>
                        </ul>
                      </li>
                    <?php
                    }
                    ?> 
                    
                    <?php
                    if($hardware=='1'){
                    ?>
                      <li><a> ยืม-คืน อุปกรณ์ <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo $url; ?>module-user/hardware/index.php">รายการอุปกรณ์</a></li>
                          <li><a href="<?php echo $url; ?>module-user/hardware/list_item.php">รายการยืม</a></li>
                        </ul>
                      </li>                    
                    <?php  
                    }
                    ?>

                    <?php
                    if($meeting=='1'){
                    ?>
                      <li><a> ห้องประชุม <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo $url; ?>module-user/meeting/index.php">จองห้องประชุม</a></li>
                          <li><a href="<?php echo $url; ?>module-user/meeting/export.php">รายการขอใช้ห้องประชุม</a></li>
                        </ul>
                      </li>
                    <?php
                    }
                    ?>
                    <!-- เมนูคอร์สอบรม -->
                     <li><a href="<?php echo $url; ?>module-user/course/index.php"> จองห้องสัมมนา </a>
                       
                      </li>



                    <?php
                    if($car=='1'){
                    ?>
                      <li><a> จองการใช้งานรถยนต์ <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                          <li><a href="<?php echo $url; ?>module-user/car/index.php">ตรวจสอบการใช้งานรถยนต์</a></li>
                          <li><a href="<?php echo $url; ?>module-user/car/export.php">รายการขอใช้งานรถยนต์</a></li>
                        </ul>
                      </li>
                    <?php
                    }
                    ?>


                    <?php
                    if($manual=='1'){
                    ?>
                      <li><a href="<?php echo $url; ?>module-user/manual/index.php"> คู่มือการใช้งาน </a></li>
                    <?php
                    }
                    ?>

                    <?php 
                    if($filedownload=='1'){
                    ?>  
                      <li><a href="<?php echo $url; ?>module-user/filedownload/index.php"> เอกสารประจำโครงการ </a></li>                      
                    <?php 
                    }
                    ?>                                      
                    </ul>
                  </li>
                <?php
                if($company_id=='2'){
                ?>
                  <li><a><i class="fa fa-calendar"></i> ปฏิทินกิจกรรม <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $url; ?>module-user/event/index.php">เพิ่มกิจกรรม</a></li>
                      <li><a href="<?php echo $url; ?>module-user/event/events.php">รายการปฏิทินกิจกรรม</a></li>
                    </ul>
                  </li>
                <?php
                }
                ?>
                <?php 
                if($announce=='1'){
                ?>
                  <li><a><i class="fa fa-exclamation-circle"></i> ประกาศ <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <?php echo $user_author; ?>
                      <li><a href="<?php echo $url; ?>module-user/announce/policy.php">นโยบายบริษัท</a></li>
                      <li><a href="<?php echo $url; ?>module-user/announce/page_cat.php?id=<?=$article6?>">ข่าว</a></li>
                      <li><a href="<?php echo $url; ?>module-user/announce/page_cat.php?id=<?=$article2?>">ประกาศจากผ่านบุคคล</a></li>
                      <li><a href="<?php echo $url; ?>module-user/announce/page_cat.php?id=<?=$article3?>">ประกาศจากฝ่ายไอที</a></li>
                      <li><a href="<?php echo $url; ?>module-user/announce/page_cat.php?id=<?=$article4?>">ประกาศจากฝ่ายเซฟตี้</a></li>
                      <li><a href="<?php echo $url; ?>module-user/announce/page_cat.php?id=<?=$article1?>">สาระรอบตัว</a></li>
                      <li><a href="<?php echo $url; ?>module-user/announce/profile_page_cat.php?id=<?=$article7?>">แนะนำพนักงานใหม่</a></li>
                    </ul>
                  </li>
                <?php 
                }
                ?> 

                  <li><a target="_blank" href="https://esspace.sti.co.th/Login" ><i class="fa fa-plus-square"></i> Esspace </a></li> 

                  <li><a target="_blank" href="<?=$wMail?>"><i class="fa fa-envelope-o"></i> Email </a></li>

                  <li><a href="<?php echo $url; ?>module-user/profile/user_account.php"><i class="fa fa-user"></i> ข้อมูลส่วนตัว </a></li>
                  <li><a href="<?php echo $url; ?>module-user/profile/history_project.php"><i class="fa fa-retweet"></i> โครงการที่ผ่านมา </a></li>
                  <li><a href="<?php echo $url; ?>logout.php"><i class="fa fa-sign-out"></i> ออกจากระบบ </a></li>
                </ul>
              </div>

            </div>
            <!-- /sidebar menu -->
          </div>