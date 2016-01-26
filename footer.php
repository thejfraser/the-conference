<?php
/**
 * The Footer
**/
	$m = 12;
	$l = 12;
	$tot = (_TCGO('left-sidebar') == 1) + (_TCGO('right-sidebar'));
	$m -= (3 * $tot);
	$l -= (2 * $tot);
?>


				</div>
				<?php if (_TCGO('left-sidebar')) {?>
					<aside class="col s12 m3 l2 pull-m<?php echo $m ?> pull-l<?php echo $l ?> <?php _TCEO('left-sidebar-background-class') ?>">
						<?php _TCCG('left-sidebar-widget-area'); ?>
					</aside>
				<?php } ?>

				<?php if (_TCGO('right-sidebar')) {?>
					<aside class="col s12 m3 l2 <?php _TCEO('right-sidebar-background-class') ?>">
						<?php _TCCG('right-sidebar-widget-area'); ?>
					</aside>
				<?php } ?>
			</div>
		<?php if (_TCGO('enable-container')) {?></div><?php } ?>
	</main>
	<footer class="page-footer <?php _TCEO('footer-class')?>">
		<?php if (_TCGO('enable-container')) {?><div class='container'><?php } ?>
			<div class="row">
				<?php _TCCG('footer-widget-area');?>
			</div>
		<?php if (_TCGO('enable-container')) {?></div><?php } ?>
		<div class="footer-copyright">
			<?php if (_TCGO('enable-container')) {?><div class='container'><?php } ?>
				<?php apply_filters('footer_left_text', '') ?>
				<div class="right">
					<?php apply_filters('footer_right_text', '') ?>
				</div>
			<?php if (_TCGO('enable-container')) {?></div><?php } ?>
		</div>
	</footer>
	<?php _TCCE('primary-menu-mobile') ?>
	<?php wp_footer(); ?>
</body>
</html>