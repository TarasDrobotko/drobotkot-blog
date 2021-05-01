<?php
/**
 * Wallop Slider File 
 *
 * @package  SlidersPack - All In One Image Sliders
 * @since 1.12
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if($check_post_gallery == 'gallery') { ?>
	<div id="wp-spaios-wallop-<?php echo $unique; ?>" class="wallop-<?php echo $design_type; ?> Wallop wp-spaios-wallop-container">
		<div class="Wallop-list Wallop--<?php echo $mode_wallop ?>">
			<?php foreach( $images as $image ):
				$post_mata_data 	= get_post($image);
				$image_lsider 		= wp_get_attachment_image_src( $image, $slide_media_size );
				$image_link 		= get_post_meta($image, $prefix.'attachment_link',true);
				$image_alt_text		= get_post_meta( $image, '_wp_attachment_image_alt', true );
				$image_title 		= $post_mata_data->post_title;
				$image_captions 	= $post_mata_data->post_excerpt;
				
				// Include Design file
				if( $design_file ) {
					include( $design_file );
				}

			endforeach; ?>

			<?php if($pagination == "true") { ?>
				<div class="Wallop-pagination">
					<?php
					$i = 1;
					foreach( $images as $image ): ?>
					 <a href="javascript:void(0)" class="Wallop-dot"><?php echo $i; ?></a>
					<?php $i++; endforeach; ?>
				</div>
			<?php } ?>

			<?php if($arrow == "true") { ?>
				<a href="javascript:void(0)" class="Wallop-button Wallop-buttonPrevious">Previous</a>
				<a href="javascript:void(0)" class="Wallop-button Wallop-buttonNext">Next</a>
			<?php } ?>

		</div>
	</div>
<?php } if($check_post_gallery == 'post') { ?>
	<div id="wp-spaios-wallop-<?php echo $unique; ?>" class="<?php echo $design_type; ?> Wallop wp-spaios-wallop-container">
		<div class="Wallop-list Wallop--<?php echo $mode_wallop ?>">
			<?php if ( $query->have_posts() ) :
				while ( $query->have_posts() ) : $query->the_post();
					$images_id 		= get_post_thumbnail_id( $post->ID );
					$image_lsider 	= wp_get_attachment_image_src( $images_id, $slide_media_size );
					$image_link 	= get_the_permalink();
					$image_title 	= get_the_title();
					$terms 			= get_the_terms( $post->ID, $texonmy_terms );
					$trem_links 	= array();

					if($terms) {
						foreach ( $terms as $term ) {
							$term_link = get_term_link( $term );
							$trem_links[] = '<a href="' . esc_url( $term_link ) . '" target="'. $link_target . '">'.$term->name.'</a>';
						}
					}

					$cate_name = join( "-", $trem_links );

					// Design file
					if( $design_file ) {
						include( $design_file );
					}

				endwhile; 
			endif; // end if
			
			if($pagination == "true") { ?>
				<div class="Wallop-pagination">
					<?php $i = 1;
						while( $query->have_posts() ): $query->the_post(); ?>
				 			<a href="javascript:void(0)" class="Wallop-dot wp-spaios-wallop-dot"><?php echo $i; ?></a>
						<?php $i++; endwhile; ?>
				</div>
			<?php }

			if($arrow == "true") { ?>
				<a href="javascript:void(0)" class="Wallop-button Wallop-buttonPrevious">Previous</a>
				<a href="javascript:void(0)" class="Wallop-button Wallop-buttonNext">Next</a>
			<?php } ?>

		</div>
	</div>
<?php } if($check_post_gallery == 'acf-gallery') { ?>
	<div id="wp-spaios-wallop-<?php echo $unique; ?>" class="wallop-<?php echo $design_type; ?> Wallop wp-spaios-wallop-container">
		<div class="Wallop-list Wallop--<?php echo $mode_wallop ?>">
			<?php $acf_gallery_img = (array)$acf_gallery_img;
			foreach( $acf_gallery_img as $acf_img ):
				$image_id 			= $acf_img['ID'];
				$image_lsider 		= wp_get_attachment_image_src( $image_id, $slide_media_size );
				$image_alt_text 	= $acf_img['alt'];
				$image_title 		= $acf_img['title'];
				$image_captions 	= $acf_img['caption'];

				if( $design_file ) {
					include( $design_file );
				}
			endforeach; ?>

			<?php if($pagination == "true") { ?>
				<div class="Wallop-pagination">
					<?php
					$i = 1;
					foreach( $acf_gallery_img as $image ): ?>
					 <a href="javascript:void(0)" class="Wallop-dot"><?php echo $i; ?></a>
					<?php $i++; endforeach; ?>
				</div>
			<?php } ?>

			<?php if($arrow == "true") { ?>
				<a href="javascript:void(0)" class="Wallop-button Wallop-buttonPrevious">Previous</a>
				<a href="javascript:void(0)" class="Wallop-button Wallop-buttonNext">Next</a>
			<?php } ?>
		</div>
	</div>
<?php } ?>
<div class="wp-spaios-conf wp-spaios-hide"><?php echo json_encode( $slider_conf ); ?></div>