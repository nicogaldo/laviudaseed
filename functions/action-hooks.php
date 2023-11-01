<?php
/*
 * b5st Action Hooks
 * =================
 * Designed to be used by a child theme, but they can also be used directly 
 * in your development of b5st. Example usage:
 *    -- See “Dimox Breadcrumbs Insertion” below.
 *    -- See “Mainbody Widgets 1 Insertion” below.
 */

// Navbar (in `header.php`)

function slider_home_height() {

$options = get_option( 'strapword_options' );
$sliderHomeHeight = $options['slider_home_height'];
if ( $sliderHomeHeight ) {
?>
    <style>
    @media only screen and (min-width: 768px) {
        .swiper-home, .swiper-home img {
            height: <?= $sliderHomeHeight['height'];?><?= $sliderHomeHeight['unit']?>;
        }
    }
    </style>
<?php 
}

}
add_action( 'wp_head', 'slider_home_height' );

function strapword_navbar_before() {
  do_action('navbar_before');
}

function strapword_navbar_after() {
  do_action('navbar_after');
}

function strapword_navbar_brand() {
  if ( ! has_action('navbar_brand') ) {
    
    $options = get_option( 'strapword_options' );?>

<a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>" alt="<?php bloginfo('name'); ?>">

    <?php
    if ( $options["logo_header"] && $options["logo_header"]["logo_header_img"]['url'] ) { ?>
        <img src="<?php echo $options["logo_header"]["logo_header_img"]['url'] ?>" class="img-fuid" alt="<?php bloginfo('name'); ?>" width="<?php echo $options["logo_header"]["logo_header_width"]; ?>">

    <?php
    } else { 
        bloginfo('name');
    } ?>
</a>

<?php
  } else {
		do_action('navbar_brand');
	}
}

function strapword_navbar_search() {
  if ( ! has_action('navbar_search') ) {
    ?>
<form class="d-flex" role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
        <input class="form-control border-secondary" type="text" value="<?php echo get_search_query(); ?>" placeholder="Search..." name="s" id="s">
        <button type="submit" id="searchsubmit" value="<?php esc_attr_x('Search', 'strapword') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>
<?php
  } else {
		do_action('navbar_search');
	}
}

// Mainbody

function strapword_mainbody_before() {
  do_action('mainbody_before');
}
function strapword_mainbody_after() {
  do_action('mainbody_after');
}

function strapword_mainbody_start() {
  do_action('mainbody_start');
}
function strapword_mainbody_end() {
  do_action('mainbody_end');
}

/*
 * Dimox Breadcrumbs Insertion
 * ===========================
 * An example for how to insert something via an action hook -- 
 * but inserting it only on single posts, using `is_single()`.
 */

function strapword_dimox_single_post() {
  if ( is_single() ) { ?>
<?php if (function_exists('dimox_breadcrumbs')) { ?>
<?php dimox_breadcrumbs(); ?>
<?php } ?>
<?php }
};

add_action( 'mainbody_before', 'strapword_dimox_single_post' );

/*
 * Mainbody Widgets 1 Insertion
 * ============================
 * An example for how to insert something via an action hook -- 
 * this will appear on every page (if you have widgets in this area).
 */

function strapword_mainbody_widgets_1() {
  if(is_active_sidebar('mainbody-widget-area-1')): ?>
<section class="container-xxl my-5">
    <div class="row">
        <?php dynamic_sidebar('mainbody-widget-area-1'); ?>
    </div>
</section>
<?php endif;
};
//add_action( 'mainbody_end', 'strapword_mainbody_widgets_1' );

// Footer (in `footer.php`)

function strapword_footer_before() {
  do_action('footer_before');
}
function strapword_footer_after() {
  do_action('footer_after');
}

function strapword_footer_brand() {
  if ( ! has_action('footer_brand') ) {
    
    $options = get_option( 'strapword_options' );?>

    <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>" alt="<?php bloginfo('name'); ?>">

        <?php if ( $options["logo_footer"] && $options["logo_footer"]["logo_footer_img"]['url'] ) { ?>
        <img src="<?php echo $options["logo_footer"]["logo_footer_img"]['url'] ?>" class="img-fuid" alt="<?php bloginfo('name'); ?>" width="<?php echo $options["logo_footer"]["logo_footer_width"]; ?>">

        <?php
        } else { 
            bloginfo('name');
        } ?>
    </a>

<?php
  } else {
		do_action('footer_brand');
	}
}

function strapword_bottomline() {
	if ( ! has_action('bottomline') ) {
		?>
        <div class="bg-dark text-light">
            <div class="container border-top">
                <div class="row pt-3">
                    <div class="col-sm">
                        <p class="text-center text-sm-start">&copy; <?php echo date('Y'); ?> <a class="text-secondary" href="<?php echo home_url('/'); ?>"><?php bloginfo('name'); ?></a></p>
                    </div>
                    <div class="col-sm">
                        <p class="text-center text-sm-end"><a class="text-secondary" href="https://devacid.xyz">devAcid</a></p>
                    </div>
                </div>
            </div>
        </div>
    <?php
	} else {
		do_action('bottomline');
	}
}