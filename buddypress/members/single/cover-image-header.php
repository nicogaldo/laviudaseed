<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @since 3.0.0
 * @version 7.0.0
 */
?>

<div id="cover-image-container" class="bg-dark">
	<div id="header-cover-image"></div>

	<div id="item-header-cover-image" class="mb-0">
		<div id="item-header-avatar">
			<a href="<?php bp_displayed_user_link(); ?>">

				<?php bp_displayed_user_avatar( 'type=full' ); ?>

			</a>
		</div><!-- #item-header-avatar -->

		<div id="item-header-content">

			<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
				<h2 class="user-nicename">@<?php bp_displayed_user_mentionname(); ?></h2>
			<?php endif; ?>

			<?php
			bp_nouveau_member_header_buttons(
				array(
					'container'         => 'ul',
					'button_element'    => 'button',
					'container_classes' => array( 'member-header-actions', 'd-flex', 'my-2' ),
				)
			);
			?>

			<?php bp_nouveau_member_hook( 'before', 'header_meta' ); ?>

			<?php if ( bp_nouveau_member_has_meta() ) : ?>
				<div class="item-meta">

					<?php bp_nouveau_member_meta(); ?>

				</div><!-- #item-meta -->

                <?php
                /* $user_id = bp_displayed_user_id();
                #Construct your output here.
                $badge_output = '';
            
                $achievements = badgeos_get_user_achievements( array( 'user_id' => $user_id ) );
                if ( !empty( $achievements ) ) {
                        $badge_output .= '<div class="achievements">';
                    foreach ( $achievements as $achievement ) {
                                    if($achievement->post_type != 'sticker')
                                        continue;
                        $badge_output .= '<div class="achievement achievement-' . $achievement->post_type . '">';
                        //echo '<h2>' . get_the_title( $achievement->ID ) . '</h2>';
                        $badge_output .= get_the_post_thumbnail( $achievement->ID, 'full', array('title'=>get_the_title( $achievement->ID ) ) );
                        //echo __( 'Earned on: ', 'text-domain' ) . date( get_option( 'date_format' ), $achievement->date_earned ) ;
                        $badge_output .= '</div>';
                    }
                        $badge_output .= '</div>';
                }
                    
                echo $badge_output; */
                ?>

			<?php endif; ?>

			<?php
			bp_member_type_list(
				bp_displayed_user_id(),
				array(
					'label'        => array(
						'plural'   => __( 'Member Types', 'buddypress' ),
						'singular' => __( 'Member Type', 'buddypress' ),
					),
					'list_element' => 'span',
				)
			);
			?>

		</div><!-- #item-header-content -->

	</div><!-- #item-header-cover-image -->
</div><!-- #cover-image-container -->
