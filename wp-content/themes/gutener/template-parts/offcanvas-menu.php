<?php
/** 
* Template for Off canvas Menu
* @since Gutener 1.0.0
*/
?>
<div id="offcanvas-menu" class="offcanvas-menu-wrap">
	<div class="close-offcanvas-menu">
		<button class="fas fa-times"></button>
	</div>
	<div class="offcanvas-menu-inner">
		<div class="header-sidebar">
			<?php dynamic_sidebar( 'menu-sidebar' ); ?>
		</div>
	</div>
</div>