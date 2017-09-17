<?php
/**
 *  WP Prodact Review front page layout.
 *
 * @package     WPPR
 * @subpackage  Layouts
 * @global      WPPR_Review_Model $review_object The inherited review object.
 * @copyright   Copyright (c) 2017, Bogdan Preda
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       3.0.0
 */

$price_raw = $review_object->get_price_raw();

$lightbox = '';

$links                     = $review_object->get_links();
$multiple_affiliates_class = 'affiliate-button';
$links                     = array_filter( $links );
$image_link                = reset( $links );
if ( count( $links ) > 1 ) {
	$multiple_affiliates_class = 'affiliate-button2 affiliate-button';
}
if ( $review_object->get_click() == 'image' ) {
	$lightbox   = 'data-lightbox="' . esc_url( $review_object->get_small_thumbnail() ) . '"';
	$image_link = $review_object->get_image();
}
?>
	<section id="review-statistics" class="article-section">
		<div class="review-wrap-up  cwpr_clearfix">
			<div class="cwpr-review-top cwpr_clearfix">
				<span><h2 class="cwp-item"><?php echo esc_html( $review_object->get_name() ); ?></h2></span>
				<span class="cwp-item-price cwp-item"><span>
								<span><?php echo esc_html( empty( $price_raw ) ? '' : $price_raw ); ?></span>
						   </span></span>
			</div><!-- end .cwpr-review-top -->
			<div class="review-wu-left">
				<div class="rev-wu-image">
					<a href="<?php echo esc_url( $image_link ); ?>" <?php echo $lightbox; ?> rel="nofollow"
					   target="_blank"><img
								src="<?php echo esc_attr( $review_object->get_small_thumbnail() ); ?>"
								alt="<?php echo esc_attr( $review_object->get_name() ); ?>"
								class="photo photo-wrapup wppr-product-image"/></a>
				</div><!-- end .rev-wu-image -->
				<div class="review-wu-grade">
					<div class="cwp-review-chart ">
					<span>
						<div class="cwp-review-percentage"
							 data-percent="<?php echo esc_attr( $review_object->get_rating() ); ?>">
							<span class="cwp-review-rating"><?php echo esc_html( $review_object->get_rating() ); ?></span>
						</div>
					</span>
					</div><!-- end .chart -->
				</div><!-- end .review-wu-grade -->
				<div class="review-wu-bars">
				<?php
				foreach ( $review_object->get_options() as $option ) {
					?>
					<div class="rev-option" data-value="<?php echo $option['value']; ?>">
					<div class="cwpr_clearfix">
						<h3><?php echo esc_html( apply_filters( 'wppr_option_name_html', $option['name'] ) ); ?></h3>
						<span><?php echo esc_html( round( $option['value'] / 10 ) ); ?>/10 </span>
					</div>
					<ul class="cwpr_clearfix"></ul>
					</div>
					<?php
				}
					?>
				</div><!-- end .review-wu-bars -->
			</div><!-- end .review-wu-left -->
			<div class="review-wu-right">
				<div class="pros">
					<h2>
					<?php
					echo esc_html(
						apply_filters(
							'wppr_review_pros_text', $review_object->wppr_get_option(
								'cwppos_pros_text'
							)
						)
					);
						?>
						</h2>
					<ul>
					<?php
					foreach ( $review_object->get_pros() as $pro ) {
						?>
						<li><?php echo esc_html( $pro ); ?></li> 
										<?php
					}
						?>
					</ul>
				</div><!-- end .pros -->
				<div class="cons">
					<h2>
					<?php
						echo esc_html(
							apply_filters(
								'wppr_review_cons_text', $review_object->wppr_get_option(
									'cwppos_cons_text'
								)
							)
						);
						?>
						</h2>
					<ul>
					<?php
					foreach ( $review_object->get_cons() as $con ) {
						?>

							<li><?php echo esc_html( $con ); ?></li>

						<?php } ?>
					</ul>
				</div>
			</div><!-- end .review-wu-right -->
		</div><!-- end .review-wrap-up -->
	</section>
<?php
foreach ( $links as $title => $link ) {
	if ( ! empty( $title ) && ! empty( $link ) ) {
		?>
		<div class="<?php echo esc_attr( $multiple_affiliates_class ); ?>">
			<a href="<?php echo esc_url( $link ); ?>" rel="nofollow"
			   target="_blank"><span><?php echo esc_html( $title ); ?></span> </a>
		</div><!-- end .affiliate-button -->
		<?php
	}
}
