<?php
/**
 * BuddyPress - Members Home
 *
 * @since   1.0.0
 * @version 3.0.0
 */
?>

	<?php bp_nouveau_member_hook( 'before', 'home_content' ); ?>

	<div id="item-header" role="complementary" data-bp-item-id="<?php echo esc_attr( bp_displayed_user_id() ); ?>" data-bp-item-component="members" class="users-header single-headers mt-n5">

		<?php bp_nouveau_member_header_template_part(); ?>

	</div><!-- #item-header -->

	<div class="bp-wrap row">
		<?php if ( ! bp_nouveau_is_object_nav_in_sidebar() ) : ?>
            <div class="col-12 col-md-3 border-end border-1 border-light border-opacity-50">
                <?php bp_get_template_part( 'members/single/parts/item-nav' ); ?>
            </div>

		<?php endif; ?>

		<div id="item-body" class="col-12 col-md item-body ps-md-4">

			<?php bp_nouveau_member_template_part(); ?>

		</div><!-- #item-body -->
	</div><!-- // .bp-wrap -->

	<?php bp_nouveau_member_hook( 'after', 'home_content' ); ?>
