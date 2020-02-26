<?php
    /**
     * Template Name: Dealer Login
    */
    the_post();
    require_once("inc/header.php");
    $wp_session = WP_Session::get_instance();
?>

<main class="full" lang="en-UK">
    <?php the_content(); ?>
</main>

 <?php require_once("inc/footer.php"); ?>