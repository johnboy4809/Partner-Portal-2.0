<aside class="dashboard-menu">
    <div class="close-icon">
        <i class="far fa-arrow-left"></i>
    </div>
    <div class="brand">
        <h3 class="h5"><?php echo $user->account->name; ?></h3>
    </div>
    <div class="user"><?php
    if (isset($user->contact->avatar)) { ?>
        <div class="profile-img large" style="background-image:url(<?php echo $user->contact->avatar; ?>)"></div><?php
    } else { ?>
        <div class="profile-icon large" style="background-image:url(<?php echo get_template_directory_uri().'/assets/graphics/avatar.svg'; ?>)"></div><?php
    } ?>
        <div class="info">
            <span class="name"><?php echo $user->contact->name ?></span>
            <span class="title"><?php echo $user->contact->title; ?></span>
        </div>
    </div>
    <nav class="main-nav">
        <ul class="admin-menu">
            <li class="menu-item">
                <a href="#" class="modal-link" data-action="modal-check-serial-form"><i class="fal fa-plus"></i> <span>Manage new printer</span></a>
            </li>  
            <li class="menu-heading">
                <h3 class="h5">Services</h3>
            </li>
            <li class="menu-item has-sub">
                <a href="<?php echo site_url('/cases');?>"><i class="fad fa-user-headset"></i></i> <span>Support cases</span></a>
                <ul class="sub-nav">
                    <li class="menu-item">
                        <a href="<?php echo site_url('/cases');?>"><span>View cases</span></a>
                        <a href="" class="modal-link" data-action="modal-create-case"><span>Create a case</span></a>
                    </li>           
                </ul>
            </li> 
            <li class="menu-item">
                <a href="<?php echo site_url('/consumables');?>"><i class="fad fa-print"></i> <span>Consumables</span></a>
            </li>   
            <!-- <li class="menu-item">
                <a href="#"><i class="fad fa-tools"></i> <span>Register Repair</span></a>
            </li> 
            <li class="menu-item">
                <a href="#"><i class="fad fa-box-up"></i> <span>Register RMA</span></a>
            </li> 
            <li class="menu-heading">
                <h3 class="h5">Upgrades</h3>
            </li>
            <li class="menu-item">
                <a href="#"><i class="fad fa-id-card-alt"></i> <span>Holokote</span></a>
            </li>    
            <li class="menu-item">
                <a href="#"><i class="fad fa-repeat-alt"></i> <span>Duo</span></a>
            </li>
            <li class="menu-heading">
                <h3 class="h5">Settings</h3>
            </li> 
            <li class="menu-item">
                <a href="#"><i class="fad fa-user"></i> <span>Your Account</span></a>
            </li>
            <li class="menu-item">
                <a href="#"><i class="fad fa-building"></i> <span>Company Details</span></a>
            </li>
            <li class="menu-item">
                <a href="#"><i class="fad fa-user-unlock"></i> <span>Change Password</span></a>
            </li> -->
        </ul>
    </nav>
    <div class="collapse-btn">
        <a href="#"><i class="far fa-chevron-left"></i> <span>Collapse</span><i class="far fa-chevron-right"></i></a>
    </div>    
</aside>