<?php
/* Template Name: Search */  
get_header(); ?>
<section id="search-form">
	<div class="container w-80">   
		<div class="row">
			<div class="col-12 col-md-12">
				<h1>Search</h1>
				<form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
					<input type="text" name="s" placeholder="Search"/>
					<input type="submit" alt="Search" value="Search" class="search-btn" />
				</form>
			</div>
		</div>
	</div>
</section> 

<section id="search-results" class="pad-80">
	<div class="container w-80">   
		<div class="row">
			<div class="col-12 col-md-12">
				<h3>Search Result for : <?php echo htmlentities($s, ENT_QUOTES, 'UTF-8'); ?> </h3>  
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-md-12">       
				<?php if ( have_posts() ) : ?>
					<ul class="courses">
						<?php while ( have_posts() ) : the_post(); 
						
							global $post;
							$post_type = get_post_type($post->ID); 
							
							if($post_type == 'courses') { 
							
								$study_mode = get_the_terms( get_the_ID(), 'delivery' ); 
								$deliveries = "";
								foreach($study_mode as $mode){
									$deliveries .= $mode->slug . " ";
								}
								$inds = get_the_terms( get_the_ID(), 'industries' ); 
								$industry = "";
								foreach($inds as $ind){
									$industry .= $ind->slug . " ";
								}
								?>
								<li class="course <?php echo $deliveries;?> <?php //echo $locations; ?> <?php echo $industry; ?>" data-price="<?php echo str_replace( ',', '', get_field('course_fee') );?>">
									<a href="<?php the_permalink(); ?>">
										<?php echo get_the_post_thumbnail( get_the_ID(), array(380,250), array( 'class' => 'related-course-image' ) ); ?>
									</a>
									
									<?php 									
									$term_obj_list = get_the_terms( $post->ID, 'industries' ); 
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
										<h5 class="entry-title"><?php the_title(); ?></h5>
										<div class="course-code"><?php the_field('course_code'); ?></div>
										
										<?php
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
												<?php if(get_field('course_fee') != '') { 
													echo "$" . get_field('course_fee'); 
												} ?>
											</span>
										</div>
										
										<div class="excerpt"><?php the_excerpt(); ?></div>
										
										<a class="button1" href="<?php the_permalink(); ?>">View More Details <i class="fa-solid fa-angle-right"></i></a>
										
									</div>
									
								</li>
							<?php } else { ?>
							
								<li class="course">
									<?php if ( has_post_thumbnail() ) {
										echo get_the_post_thumbnail( get_the_ID(), array(380,250), array( 'class' => 'related-course-image' ) );
									} else { ?>
										<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/default-featured-image.jpg" alt="<?php the_title(); ?>" />
									<?php } 
									
									$categories = get_the_category();
									if ( ! empty( $categories ) ) { ?>
										<div class="cat">
											<span class="industry-name"><?php echo esc_html( $categories[0]->name ); ?></span>
										</div>	
									<?php } ?>
									
									<div class="course-info">
										<h5 class="entry-title"><?php the_title(); ?></h5>
										
										<div class="excerpt">
											<?php if(has_excerpt(get_the_ID())) {
												the_excerpt(); 
											} else {
												echo strip_shortcodes(wp_trim_words(get_the_content(), 50, '...'));
											}
											?>
										</div>
										
										<a class="button4" href="<?php the_permalink(); ?>">Read More</a>
									</div>
									
								</li>
							<?php } ?>
						<?php endwhile; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
   </div><!-- container -->    
</div><!-- search-form -->

<?php get_footer(); ?>