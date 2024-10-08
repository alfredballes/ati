<?php
/*
 * The template for displaying single page of blog.
 *
 * @package ATI
 * @developer Alfred Balles
 * @since ATI Australia 1.0
 */

 get_header(); ?>


 <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();?>
		<section id="course-details">
            <div class="container w-80">
                <div class="row">
					<h1 class="course-title"><?php the_title(); ?></h1>
				</div>
			</div>
		</section>
		
		<?php $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		if(!empty($post_thumbnail_id)) {
			$img_ar =  wp_get_attachment_image_src( $post_thumbnail_id, 'full' ); ?>    
			<section style="background-image: url(<?php echo $img_ar[0]; ?>)" class="featured-image-section"></section>
		<?php } ?>
		
		<section id="post-details">
			<div class="container w-80">
                <div class="row justify-content-end">
					<div class="col-12 col-lg-8 blog-content">
						<?php the_content(); ?>

						<?php if(get_field('show_view_all_courses_button') == 1 && get_field('link') != "" ) { ?>
							<?php $term = get_field('link'); ?>
							<a href="<?php echo get_term_link($term->term_id); ?>" title="View All Courses" class="button1 view_courses">View All Courses <i class="fa-solid fa-angle-right"></i></a>
						<?php } ?>
					</div>
					
					<div class="col-12 col-lg-4 related-courses">
						<?php $related1 = get_field('related_course_1'); 
						if($related1 != '') {
						?>
							<div class="course" data-price="<?php echo str_replace( ',', '', get_field('course_fee') );?>">
								<a href="<?php echo get_permalink($related1->ID); ?>"><?php echo get_the_post_thumbnail( $related1->ID, array(380,250), array( 'class' => 'related-course-image' ) ); ?> </a>
								<?php
								$term_obj_list = get_the_terms( $related1->ID, 'industries' ); 
								$term_id = $term_obj_list[0]->term_id;
								$term_tax = $term_obj_list[0]->taxonomy;
								$icon = get_field( 'course_icon_cat', $term_tax . '_'. $term_id ); ?>
									
								<div class="cat-info">
									<?php if($icon!="") { ?>
										<img src="<?php echo $icon; ?>" width="25" height="25">
									<?php } ?>
									<span class="industry-name"><?php echo $term_obj_list[0]->name; ?></span>
								</div>
								
								<div class="course-info">
									<h5 class="entry-title"><a href="<?php echo get_permalink($related1->ID); ?>"><?php echo $related1->post_title; ?></a></h5>
									<p class="course-code"><?php echo get_field('course_code', $related1->ID); ?></p>
									
									<?php
									$study_mode = get_the_terms( $related1->ID, 'delivery' ); 
									$modes = "";
									foreach($study_mode as $mode){
										$modes .= $mode->name . ", ";
									}
									?>
									<div class="modes">
										<span class="info-label">Study Mode:</span>&nbsp;
										<span class="info-value"><?php echo rtrim($modes, ", "); ?></span>
									</div>
									
									<div class="modes">
										<span class="info-label">Course Fee:</span>&nbsp;
										<span class="info-value price">
											<?php if(get_field('course_fee', $related1->ID) != '') { 
												echo "$" . get_field('course_fee', $related1->ID); 
											} ?>
										</span>
									</div>
									
									
									<div class="excerpt"><?php echo do_shortcode($related1->post_excerpt); ?></div>
									
									<a class="button1" href="<?php echo get_permalink($related1->ID); ?>">View More Details <i class="fa-solid fa-angle-right"></i></a>
									
								</div>
								
							</div><!-- related1 -->
						<?php } ?>
						
						<?php $related2 = get_field('related_course_2'); 
						if($related2 != '') {
						?>
							<div class="course" data-price="<?php echo str_replace( ',', '', get_field('course_fee') );?>">
								<a href="<?php echo get_permalink($related2->ID); ?>"><?php echo get_the_post_thumbnail( $related2->ID, array(380,250), array( 'class' => 'related-course-image' ) ); ?> </a>
								<?php
								$term_obj_list = get_the_terms( $related2->ID, 'industries' ); 
								$term_id = $term_obj_list[0]->term_id;
								$term_tax = $term_obj_list[0]->taxonomy;
								$icon = get_field( 'course_icon_cat', $term_tax . '_'. $term_id ); ?>
									
								<div class="cat-info">
									<?php if($icon!="") { ?>
										<img src="<?php echo $icon; ?>" width="25" height="25">
									<?php } ?>
									<span class="industry-name"><?php echo $term_obj_list[0]->name; ?></span>
								</div>
								
								<div class="course-info">
									<h5 class="entry-title"><a href="<?php echo get_permalink($related1->ID); ?>"><?php echo $related2->post_title; ?></a></h5>
									<p class="course-code"><?php echo get_field('course_code', $related2->ID); ?></p>
									
									<?php
									$study_mode = get_the_terms( $related2->ID, 'delivery' ); 
									$modes = "";
									foreach($study_mode as $mode){
										$modes .= $mode->name . ", ";
									}
									?>
									<div class="modes">
										<span class="info-label">Study Mode:</span>&nbsp;
										<span class="info-value"><?php echo rtrim($modes, ", "); ?></span>
									</div>
									
									<div class="modes">
										<span class="info-label">Course Fee:</span>&nbsp;
										<span class="info-value price">
											<?php if(get_field('course_fee', $related2->ID) != '') { 
												echo "$" . get_field('course_fee', $related2->ID); 
											} ?>
										</span>
									</div>
									
									<div class="excerpt"><?php echo do_shortcode($related2->post_excerpt); ?></div>
									
									<a class="button1" href="<?php echo get_permalink($related2->ID); ?>">View More Details <i class="fa-solid fa-angle-right"></i></a>
									
								</div>
								
							</div><!-- related2 -->
						<?php } ?>
						
						<?php $related3 = get_field('related_course_3'); 
						if($related3 != '') {
						?>
							<div class="course" data-price="<?php echo str_replace( ',', '', get_field('course_fee') );?>">
								<a href="<?php echo get_permalink($related3->ID); ?>"><?php echo get_the_post_thumbnail( $related3->ID, array(380,250), array( 'class' => 'related-course-image' ) ); ?> </a>
								<?php
								$term_obj_list = get_the_terms( $related3->ID, 'industries' ); 
								$term_id = $term_obj_list[0]->term_id;
								$term_tax = $term_obj_list[0]->taxonomy;
								$icon = get_field( 'course_icon_cat', $term_tax . '_'. $term_id ); ?>
									
								<div class="cat-info">
									<?php if($icon!="") { ?>
										<img src="<?php echo $icon; ?>" width="25" height="25">
									<?php } ?>
									<span class="industry-name"><?php echo $term_obj_list[0]->name; ?></span>
								</div>
								
								<div class="course-info">
									<h5 class="entry-title"><a href="<?php echo get_permalink($related1->ID); ?>"><?php echo $related3->post_title; ?></a></h5>
									<p class="course-code"><?php echo get_field('course_code', $related3->ID); ?></p>
									
									<?php
									$study_mode = get_the_terms( $related3->ID, 'delivery' ); 
									$modes = "";
									foreach($study_mode as $mode){
										$modes .= $mode->name . ", ";
									}
									?>
									<div class="modes">
										<span class="info-label">Study Mode:</span>&nbsp;
										<span class="info-value"><?php echo rtrim($modes, ", "); ?></span>
									</div>
									
									<div class="modes">
										<span class="info-label">Course Fee:</span>&nbsp;
										<span class="info-value price">
											<?php if(get_field('course_fee', $related3->ID) != '') { 
												echo "$" . get_field('course_fee', $related3->ID); 
											} ?>
										</span>
									</div>
									
									<div class="excerpt"><?php echo do_shortcode($related3->post_excerpt); ?></div>
									
									<a class="button1" href="<?php echo get_permalink($related3->ID); ?>">View More Details <i class="fa-solid fa-angle-right"></i></a>
								
								</div>
								
							</div><!-- related3 -->
						<?php } ?>
						
						<?php if(get_field('show_view_all_courses_button') == 1 && get_field('link') != "" ) { ?>
							<a href="<?php echo get_term_link($term->term_id); ?>" title="View All Courses" class="button1 view_courses">View All Courses <i class="fa-solid fa-angle-right"></i></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

		<!-- Related Articles -->
		<section id="related-articles" class="pad-80">
			<div class="container w-80">
				<div class="row">
					<div class="col-12 col-lg-8">
						<?php 
						$categories = get_the_category( $post->ID );
						$term_id = $categories[0]->term_id;
						$slug = $categories[0]->slug;
						
						$the_query = new WP_Query( array(
							'post_type' => 'post',
							'posts_per_page' => 2,
							'post__not_in' => array($post->ID),
							'tax_query' => array(
								array (
									'taxonomy' => 'category',
									'field' => 'slug',
									'terms' => $slug,
								)
							),
						) );

						if($the_query->have_posts()) : ?>
							<ul class="courses">
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<li class="course blue">
									<?php echo get_the_post_thumbnail( get_the_ID(), array(380,250), array( 'class' => 'related-course-image' ) ); ?>
									<div class="course-info">
										<h5 class="entry-title"><?php the_title(); ?></h5>
										<p class="post-meta">
										<?php $term_obj_list = get_the_terms( get_the_ID(), 'category' ); 
												$term_id = $term_obj_list[0]->term_id; ?>
												<a href="<?php echo get_term_link($term_id); ?>" rel="tag"><?php echo $term_obj_list[0]->name; ?></a>
										</p>
										<div class="excerpt">
										<?php if(has_excerpt(get_the_ID())) {
											echo wp_trim_words(get_the_excerpt(), 20, '[...]'); 
										} else {
											echo strip_shortcodes(wp_trim_words(get_the_content(), 20, '[...]'));
										}
										?>
									</div>
										<a class="more-link" href="<?php the_permalink(); ?>">Read More</a>
									</div>
								</li>
							<?php endwhile; ?>
							</ul>
							
						<?php else: 
								echo "<h3 class='no-courses'>There are no related articles for this Industry.</h3>";
							
						endif;

						/* Restore original Post Data 
						 * NB: Because we are using new WP_Query we aren't stomping on the 
						 * original $wp_query and it does not need to be reset.
						*/
						wp_reset_postdata();
						?>
					</div>
					<div class="col-12 col-lg-4" id="discover">
						<img decoding="async" width="81" height="76" alt="news-icon-blue" title="news-icon-blue" data-src="https://ansicvpn.com/wp-content/uploads/2024/05/news-icon-blue.svg" class="wp-image-249191 lazyloaded" src="https://ansicvpn.com/wp-content/uploads/2024/05/news-icon-blue.svg">
						<h3>Discover the<br> Latest Trends</h3>
						<p>Stay up to date with our<br> informative blog posts</p>
						<a class="button1" href="https://ansicvpn.com/articles/" data-icon="5">View Latest News <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</section>
		<!-- End Related Articles -->
	
	<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>