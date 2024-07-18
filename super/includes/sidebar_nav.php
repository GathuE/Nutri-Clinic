<div class="sidebar">
    <div class="scrollbar-inner sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="../../assets/img/userimages/<?php echo $profile_pic;?>">
            </div>
            <div class="info">
                <a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                    <span>
                    <?php echo $username ?>
                        <span class="user-level"><?php echo $role ?></span>
                    </span>
                </a>
                <div class="clearfix"></div>
            </div>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a href="dashboard">
                    <i class="la la-dashboard"></i>
                    <p>Dashboard</p>
       <!--         <span class="badge badge-count">5</span>     -->
                </a>
            </li>
            <li class="nav-item active">
                <a href="users">
                    <i class="la la-users"></i>
                    <p>Users</p>
                    <span class="badge badge-count">3</span>
                </a>
            </li>

        <!-- SIDE MENU GOEST HERE 

            <li class="nav-item">
                <a href="#">
                    <i class="#"></i>
                    <p></p>
                    <span class="badge badge-count">#</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="#"></i>
                    <p></p>
                    <span class="badge badge-count">#</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="#"></i>
                    <p></p>
                    <span class="badge badge-count">#</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="#"></i>
                    <p></p>
                    <span class="badge badge-count">#</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#">
                    <i class="#"></i>
                    <p></p>
                    <span class="badge badge-count">#</span>
                </a>
            </li>

        SIDE MENU GOES HERE --------------------------->
            <li class="nav-item update-pro">
                <button  data-toggle="modal" data-target="#modalUpdate">
                    <i class="la la-lock"></i>
                    <p>Credentials</p>
                </button>
            </li>
        </ul>
    </div>
</div>