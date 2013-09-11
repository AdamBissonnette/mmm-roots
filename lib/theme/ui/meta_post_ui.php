<?php /* Handles basic ui wrapper for all taxonomy meta sections */ ?>
<div class="mmm_postmeta_wrapper post_meta">
	<div class="container">
		<div class="row form-horizontal">
			<?php wp_nonce_field( 'mm_nonce', 'mm_nonce' ); ?>

			<?php
				echo OutputThemeData($options, $values);
			?>
		</div>
	</div>
</div>