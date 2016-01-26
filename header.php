<?php
/** 
 * The header Template
**/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset')?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head() ?>	
</head>
<body class="<?php _TCEO('body-class');?>">
	<header class="<?php _TCEO('header-class')?>">
		<?php if (_TCGO('enable-container')) {?><div class='container'><?php } ?>
		<div class="row valign-wrapper s-novalign">
			<div class="col valign center-align <?php echo (_TCGO('header-widgets', '1') == '1') ? 's12 m5' : 's12' ?>">
				<h1>
					<a href='<?php get_bloginfo('wpurl')?>'>
						<?php _TCEO('text-site-title', get_bloginfo('sitename'))?>
					</a>
				</h1>
				<?php if (_TCGO('show-tag-line')) { ?>
				<p class='flow-text'><?php _TCEO('text-tagline', get_bloginfo('description')) ?></p>
				<?php } ?>
			</div>
			<?php if (_TCGO('header-widgets', '1') == '1') {?>
				<div class="col valign s12 m7 center-align blue">
					<?php _TCCG('header-widget-area'); ?>
				</div>
			<?php } ?>
		</div>
		<?php if (_TCGO('enable-container')) {?></div><?php } ?>
		<nav class="<?php _TCEO('nav-class')?>">
			<?php if (_TCGO('enable-container')) {?><div class='container'><?php } ?>
			<div class="nav-wrapper">
				<?php _TCCE('primary-menu') ?>
				<ul class="hide-on-med-and-up">	
					<li><a id='primary-menu-open' data-activates="primary-menu-mobile"><i class="tiny material-icons left">menu</i> <?php _e('MENU', _TXTDOM()) ?></a></li>
				</ul>
			</div>
			<?php if (_TCGO('enable-container')) {?></div><?php } ?>
		</nav>
	</header>

	<main class="<?php _TCEO('main-class') ?>">

		<?php if (_TCGO('enable-container')) {?>
			<div class='container'>
		<?php } ?>		

			<div class='row'>
				

				<?php 
					$m = 12;
					$l = 12;
					$tot = (_TCGO('left-sidebar') == 1) + (_TCGO('right-sidebar'));
					$m -= (3 * $tot);
					$l -= (2 * $tot);
				?>
				<div class='col s12 m<?php echo $m?> l<?php echo $l ?> <?php if(_TCGO('left-sidebar')) { echo 'push-m3 push-l2'; }?>' >
<p>HELLO WORLD</p>
