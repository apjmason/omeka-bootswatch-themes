<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
        <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <!-- Will build the page <title> -->
    <?php
        if (isset($title)) { $titleParts[] = strip_formatting($title); }
        $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>
    <?php echo auto_discovery_link_tags(); ?>

    <!-- Will fire plugins that need to include their own files in <head> -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


    <!-- Need to add custom and third-party CSS files? Include them here -->
    <?php
		$bootswatch_theme=get_theme_option('Style Sheet');
        queue_css_file($bootswatch_theme.'/bootstrap.min');
        queue_css_file('style');
        echo head_css();
    ?>

    <!-- Need more JavaScript files? Include them here -->
    <?php
        queue_js_file('lib/bootstrap.min');
        queue_js_file('globals');
        echo head_js();
    ?>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <nav class="navbar navbar-default navbar-fixed-top"><!-- navbar-fixed-top -->
      <div class="container">
        <div class="navbar-header">
          <?php echo bs_link_logo_to_navbar(); ?>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <?php echo public_nav_main_bootstrap(); ?>
          <?php echo search_form(array('show_advanced' => false, 'form_attributes'=>array('id'=>'navbar-search', 'class'=>'navbar-form navbar-right'))); ?>
        </div>
      </div>
    </nav>
<!-- NAH - edited to only add header on home page -->
    <?php if ((get_theme_option('display_header') !== '0') && is_current_url($base_url)): ?>
    <header id="banner" class="<?php echo get_theme_option('header_flow'); ?> page-header" style="background-size:cover;background-image:url('<?php 
		if ((get_theme_option('Header Background Image') === null)){
			echo img('defaulthbg.jpg');
		}			
		else echo bs_header_bg(); 
		?>');">
		<div class="row header-row vertical-center">
			<?php if ((get_theme_option('header_logo_image') !== null)): ?>
			<div class="col-md-2 col-md-offset-1" id="header-logo-holder">
				 <?php echo bs_header_logo(); ?>
			</div>

<!-- NAH- adding conditional to center text if no logo -->
			<div class="col-md-8" id="header-claim-holder">
      <?php else : ?>
			<div class="col-md-8 col-md-offset-2" id="header-claim-holder"> 
			<?php endif; ?>

				<div class="jumbotron">
				<?php if ((get_theme_option('header_image_heading') !== '')): ?>
					<h1><?php echo get_theme_option('header_image_heading'); ?></h1>
				<?php endif; ?>
				<?php if ((get_theme_option('header_image_text') !== '')): ?>
					<p><?php echo get_theme_option('header_image_text'); ?></p>
				<?php endif; ?>
        <div class="row">
          <div class="col-xs-4">
            <a href="#themes" class="btn btn-primary btn-lg btn-block" role="button">Themes</a>
          </div>
          <div class="col-xs-4">
            <a href="#map" class="btn btn-primary btn-lg btn-block" role="button">Map</a>
          </div>
          <div class="col-xs-4">
            <a href="#timeline" class="btn btn-primary btn-lg btn-block" role="button">Timeline</a>
          </div>
				</div>			
			</div>
		</div>
    </header>  
    <?php endif; ?>  
    <main id="content">
      <div class="container">
          <?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
