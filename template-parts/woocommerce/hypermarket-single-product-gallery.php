<?php
/**
 * Displaying single product image and thumbnails
 *
 * @package 		Hooked into "woocommerce_before_single_product_summary"
 * @author  		Mahdi Yazdani
 * @package 		Hypermarket
 * @since 		    1.0.4
 */
global $post, $product, $woocommerce;

$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
$attachment_ids = $product->get_gallery_image_ids();
if(! empty($post_thumbnail_id)):
?>
<!-- Product Gallery -->
<div class="images product-gallery woocommerce-product-gallery__wrapper">
	<!-- Preview -->
	<ul class="product-gallery-preview">
			<?php
				$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
				$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
				$thumbnail_post    = get_post( $post_thumbnail_id );
				$image_title       = $thumbnail_post->post_content;
				$attributes = array(
					'title'                   => $image_title,
					'data-large-image'        => $full_size_image[0],
					'data-large-image-width'  => $full_size_image[1],
					'data-large-image-height' => $full_size_image[2],
				);
				echo '<li id="preview01" data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="current woocommerce-product-gallery__image">';
					echo get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
				echo '</li>';
				if(is_array($attachment_ids) && ! empty($attachment_ids)):
					$counter = 2;
					foreach($attachment_ids as $attachment_id):
						$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
						$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
						$thumbnail_post   = get_post( $attachment_id );
						$image_title      = $thumbnail_post->post_content;
						$attributes = array(
							'title'                   => $image_title,
							'data-large-image'        => $full_size_image[0],
							'data-large-image-width'  => $full_size_image[1],
							'data-large-image-height' => $full_size_image[2],
						);
						echo '<li id="preview0' . $counter . '" data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
							echo wp_get_attachment_image( $attachment_id, 'shop_single', false, $attributes );
						echo '</li>';
						$counter++;
					endforeach;
				endif;
			?>
	</ul><!-- .product-gallery-preview -->
	<!-- Thumblist -->
	<ul class="product-gallery-thumblist">
		<?php
			$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
			$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
			$thumbnail_post    = get_post( $post_thumbnail_id );
			$image_title       = $thumbnail_post->post_content;
			$attributes = array(
				'title'                   => $image_title,
				'data-large-image'        => $full_size_image[0],
				'data-large-image-width'  => $full_size_image[1],
				'data-large-image-height' => $full_size_image[2],
			);
			echo '<li data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="active woocommerce-product-gallery__image">';
				echo '<a href="#preview01">';
					echo get_the_post_thumbnail( $post->ID, 'shop_single', $attributes );
				echo '</a>';
			echo '</li>';
			if(is_array($attachment_ids) && ! empty($attachment_ids)):
				$counter = 2;
				foreach($attachment_ids as $attachment_id):
					$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
					$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
					$thumbnail_post   = get_post( $attachment_id );
					$image_title      = $thumbnail_post->post_content;
					$attributes = array(
						'title'                   => $image_title,
						'data-large-image'        => $full_size_image[0],
						'data-large-image-width'  => $full_size_image[1],
						'data-large-image-height' => $full_size_image[2],
					);
					echo '<li data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image">';
						echo '<a href="#preview0' . $counter . '">';
							echo wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
						echo '</a>';
					echo '</li>';
					$counter++;
				endforeach;
			endif;
		?>
	</ul><!-- .product-gallery-thumblist -->
</div><!-- .product-gallery -->
<?php endif; ?>