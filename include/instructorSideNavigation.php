<aside id="sidebar" class="sidebar">
   <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
         <a class="nav-link 
            <?php
            if ($page != "home") {
               echo " collapsed";
            }
            ?>" href="home.php">
            <i class='bx bxs-dashboard'></i>
            <span>Dashboard</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link 
            <?php
            if ($page != "manage_student") {
               echo " collapsed";
            }
            ?>" href="manage_student.php"><i class='bx bxs-chalkboard'></i>
            <span>Manage Student</span>
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link 
         <?php
         if ($page == "attendance_student" || $page == "attendance_instructor") {
            echo "";
         } else {
            echo " collapsed";
         }
         ?>
         " data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"><i class='bx bxs-folder-open'></i><span>Attendance</span><i class="bi bi-chevron-down ms-auto"></i> </a>
         <ul id="forms-nav" class="nav-content
         <?php
         if ($page == "attendance_student" || $page == "attendance_instructor") {
            echo "";
         } else {
            echo " collapse";
         }
         ?> " data-bs-parent="#sidebar-nav">
            <li> <a class="<?= $page == 'attendance_student' ? 'active' : '' ?>" href="attendance_student.php"><i class='bx bxs-right-arrow'></i><span>Students</span> </a></li>
            <li> <a class="<?= $page == 'attendance_instructor' ? 'active' : '' ?>" href="attendance_instructor.php"><i class='bx bxs-right-arrow'></i></i><span>My Attendance</span> </a></li>
         </ul>
      </li>
</aside>