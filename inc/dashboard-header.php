<header class="dashboard-header">
    <div class="magicard">
        <a class="brand" href="<?php echo site_url('/');?>">
            <img class="logo" src="<?php echo get_template_directory_uri(); ?>/assets/graphics/magicard.svg" alt="Magicard | <?php echo bloginfo('name'); ?>" />
            <span>Partner Portal</span>
        </a>
    </div>
    <div class="user">
        <i class="fad fa-user-circle"></i>
        <div class="user-menu">
            <div class="user-info"><?php
            if (isset($contact->contact->avatar)) { ?>
                <div class="profile-img large" style="background-image:url(<?php echo $contact->contact->avatar; ?>)"></div><?php
            } else { ?>
                <div class="profile-icon large" style="background-image:url(<?php echo get_template_directory_uri().'/assets/graphics/avatar.svg'; ?>)"></div><?php
            } ?>
                <div class="info">
                    <span class="name"><?php echo $contact->contact->name ?></span>
                    <span class="title"><?php echo $contact->contact->title; ?></span>
                </div>
            </div>
            <ul class="user-nav">
                <li class="menu-item">
                    <a href="<?php echo site_url('/account');?>"><i class="fad fa-user"></i> <span>Your Account</span></a>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fad fa-building"></i> <span>Company Details</span></a>
                </li>
                <li class="menu-item">
                    <a href="#"><i class="fad fa-user-unlock"></i> <span>Change Password</span></a>
                </li>
                <li class="menu-item">
                    <a href="#" class="logoutBtn modal-link" data-action="modal-logout"><i class="fad fa-sign-out-alt"></i> <span>Log out</span></a>
                </li>
            </ul>    
        </div>
    </div>
    <div class="logout">  
        <a href="#" class="modal-link" data-action="modal-logout"><i class="fad fa-sign-out-alt"></i></a>
    </div>
</header>

