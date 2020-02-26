<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo 'en-gb'; //ICL_LANGUAGE_CODE; ?>">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title><?php wp_title(' | ', true, 'right'); bloginfo('name'); ?></title>

    <link rel="shortcut icon" type="image/png" href="<?php echo get_stylesheet_directory_uri()."/assets/graphics/favicon-32.png"; ?>" />

    <?php wp_head(); ?>

    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body <?php body_class(); ?>>