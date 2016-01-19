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
					WIDGET GOES HERE!
				</div>
			<?php } ?>
		</div>
		<nav class="<?php _TCEO('nav-class')?>">
			<div class="nav-wrapper">
				<ul class="hide-on-small-only hide">

				</ul>
				<ul class="hide-on-med-and-up">
					<li><a id='menu-open'><i class="material-icons">menu</i> <?php _e('Menu', _TXTDOM()) ?></a></li>
				</ul>
			</div>
		</nav>
	</header>
