<?php
include("../include/db.php");
@session_start();
ob_start();


function sidebar(){
    global $con;
    $q_id = "SELECT * FROM student_data";
    $sql_id = mysqli_query($con, $q_id);
    $c = 0;
    while($row_id = mysqli_fetch_array($sql_id)){
    $c++;
    }
    echo '

<div class="span2">
    <div class="sidebar">
        <ul class="widget widget-menu unstyled">
            <li class="active"><a href="index"><i class="menu-icon icon-dashboard"></i>Dashboard
                </a></li>
            <li><a href="position"><i class="menu-icon icon-inbox"></i>Positions </a></li>
            <li><a href="upload"><i class="menu-icon icon-bullhorn"></i>Candidates </a></li>
            <li><a href="student"><i class="menu-icon icon-tasks"></i>Voters <b class="label orange pull-right">'. $c .'</b></a></li>
        </ul>
        
        <!--/.widget-nav-->


        <ul class="widget widget-menu unstyled">
            <li><a href="access"><i class="menu-icon icon-lock"></i>Access </a></li>
            <li><a href="login/logout"><i class="menu-icon icon-signout"></i>Logout </a></li>
            <!-- <li><a href="ui-button-icon.html"><i class="menu-icon icon-bold"></i> Buttons </a></li>
            <li><a href="ui-typography.html"><i class="menu-icon icon-book"></i>Typography </a></li>
            <li><a href="form.html"><i class="menu-icon icon-paste"></i>Forms </a></li>
            <li><a href="table.php"><i class="menu-icon icon-table"></i>Tables </a></li>
            <li><a href="charts.html"><i class="menu-icon icon-bar-chart"></i>Charts </a></li> -->
        </ul>

        <!--/.widget-nav-->
    
        <!-- <ul class="widget widget-menu unstyled">
            <li><a class="collapsed" data-toggle="collapse" href="#togglePages"><i class="menu-icon icon-cog">
                    </i><i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right">
                    </i>More Pages </a>
                <ul id="togglePages" class="collapse unstyled">
                    <li><a href="other-login.html"><i class="icon-inbox"></i>Login </a></li>
                    <li><a href="other-user-profile.html"><i class="icon-inbox"></i>Profile </a></li>
                    <li><a href="other-user-listing.html"><i class="icon-inbox"></i>All Users </a></li>
                </ul>
            </li>
        </ul> -->
    </div>
    <!--/.sidebar-->
</div>
<!--/.span3-->

         ';
}