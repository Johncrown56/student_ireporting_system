<aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="profile.php"><img src="assets/img/img1.jpg" class="img-circle" width="60"></a></p>
                   <?php $query=mysqli_query($bd, "select fullName from users where matricNo='".$_SESSION['login']."'");
 while($row=mysqli_fetch_array($query)) 
 {
 ?> 
              	  <h5 class="centered"><?php echo htmlentities($row['fullName']);?></h5>
                  <?php } ?>
              	  	
                  <li class="mt">
                      <a href="dashboard.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>


                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Account Setting</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="profile.php">Profile</a></li>
                          <li><a  href="change-password.php">Change Password</a></li>
                        
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="report-issue.php" >
                          <i class="fa fa-book"></i>
                          <span>Report Issue</span>
                      </a>
                    </li>
                  </li>
                  <li class="sub-menu">
                      <a href="complaint-history.php" >
                          <i class="fa fa-tasks"></i>
                          <span>Report History</span>
                      </a>                      
                  </li>

                  <li class="sub-menu d-lg-none">
                      <a href="logout.php" >
                          <i class="fa fa-power-off"></i>
                          <span>Logout</span>
                      </a>                      
                  </li>
                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>