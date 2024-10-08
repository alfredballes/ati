<?php
/*
 * The template for displaying industries page of course.
 *
 * @package ATI
 * @developer Alfred Balles
 * @since ATI Australia 1.0
 */

 get_header(); ?>
<!-- course details -->
<section id="course-details">
	<div class="container w-80">
		<div class="row">
			<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xxl-6 d-flex title-icon">
				<?php $industry = get_queried_object(); 
					//print_r($industry);
					$icon = get_field( 'course_icon_cat', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id );
				?>
				<img src="<?php echo $icon; ?>"><h1><?php echo get_queried_object()->name; ?></h1>
			</div>
			<div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xxl-6 description">
				<p><?php echo get_queried_object()->description; ?></p>
			</div>
		</div>
	</div>
</section><!-- END course details -->

<!-- Industry -->
<section id="industry" class="pad-80">
	<div class="container w-80">
		<div class="row">
			<div class="col-12">
				<h3>Explore Courses</h3>
				<form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
					<input type="text" name="s" placeholder="Search Courses"/>
					<input type="hidden" name="post_type" value="courses" /> <!-- // hidden 'courses' value -->
					<input type="submit" alt="Search" value="Search" class="search-btn" />
				</form>
			</div>
		</div>
		<div class="row">
			<?php $args = array(
						'numberposts' => -1,
						'post_type' => 'courses',
						'tax_query' => array(
							array(
								'taxonomy' => 'industries',
								'field' => 'slug',
								'terms' => get_queried_object()->slug,
							),
						),
					);

					$cat_posts  = get_posts($args);

					$my_post_ids = wp_list_pluck ($cat_posts, 'ID');
			?>
			<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3"> 
				<label for="delivery" class="label">Delivery Method</label>
				<?php $terms    = wp_get_object_terms ($my_post_ids, 'delivery'); ?>
					
					<select name="delivery" id="delivery" class="filter" style="width: 100%">
						<option value="all">All</option>
					<?php foreach ($terms as $term){ ?>
						<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
					<?php } ?>
					</select>
			</div>
			<!--<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3">
				<label for="industries" class="label">Industries</label>
				<?php /*$terms = get_terms([
							'taxonomy' => 'industries',
							'hide_empty' => true,
						]); ?>
					
					<select name="industries" id="industries">
						<option value="all">All</option>
					<?php foreach ($terms as $term){ ?>
						<option value="<?php echo $term->slug; ?>" <?php if(get_queried_object()->slug == $term->slug) { echo "selected";} ?>><?php echo $term->name; ?></option>
					<?php } */ ?>
					</select>
			</div>-->
			<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3 sort-col">
				<label for="sort" class="label">Sort By</label>
					<select name="sort" id="sort" style="width: 100%">
						<option value="sort">Sort</option>
						<option value="ascending">A-Z</option>
						<option value="descending">Z-A</option>
						<option value="price-asc">Price - Low to High</option>
						<option value="price-desc">Price - High to Low</option>
					</select>
			</div>
		</div>
		
		<!-- courses -->
		<div class="row">
			<div class="col-12">
				<?php $the_query = new WP_Query( array(
					'post_type' => 'courses',
					'posts_per_page' => -1,
					'post__not_in' => array( 255074 ),
					'orderby' => 'date',
					'order'   => 'DESC',
					'tax_query' => array(
						array (
							'taxonomy' => 'industries',
							'field' => 'slug',
							'terms' => get_queried_object()->slug,
						)
					),
				) );
				
				if($the_query->have_posts()) : ?>
					<ul class="courses equal">

				<?php while ( $the_query->have_posts() ) :
					$the_query->the_post(); 
						$study_mode = get_the_terms( get_the_ID(), 'delivery' ); 
						$deliveries = "";
						foreach($study_mode as $mode){
							$deliveries .= $mode->slug . " ";
						}
						
						/*$locs = get_the_terms( get_the_ID(), 'location' ); 
						$locations = "";
						foreach($locs as $loc){
							$locations .= $loc->slug . " ";
						} */
						?>
						<li class="course <?php echo $deliveries;?> <?php //echo $locations; ?>" data-price="<?php echo str_replace( ',', '', wp_strip_all_tags(get_field('course_fee') ) );?>">
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
								<h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<div class="course-code"><a href="<?php the_permalink(); ?>"><?php the_field('course_code'); ?></a></div>
								
								<?php
								$modes = "";
								foreach($study_mode as $mode){
									$modes .= $mode->name . "<br>";
								}
								?>
								<div class="study modes">
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
				<?php endwhile; ?>
					<ul>
				
				<?php else: 
					echo "<h3 class='no-courses'>There are no courses for this Industry.</h3>";
				
				endif;

				/* Restore original Post Data 
				 * NB: Because we are using new WP_Query we aren't stomping on the 
				 * original $wp_query and it does not need to be reset.
				*/
				wp_reset_postdata();
				
				?>
			</div>
		</div>
		<!-- end courses -->
	</div>
</section><!-- END Industry -->

<!-- Advantages section -->
<?php if(get_field( 'advantages', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id ) != '') { ?>
	<section id="advantages" class="pad-80">
		<div class="container w-80">
			<div class="row">
				<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 image-col">
					<img src="<?php the_field('advantages_image', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id); ?>" class="bordered more-image">
					
				</div>
				<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<!-- More text right col -->
					<div class="more-text-right">
						<h3>Advantages and Skills You Gain</h3>
						<?php the_field('advantages', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id); ?>
					</div>
					<?php if(get_field( 'what_to_expect', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id ) != '') { ?>
						<div class="more-text-right">
							<h3>What to Expect</h3>
							<?php the_field('what_to_expect', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id); ?>
						</div>
					<?php } ?>
					<!-- End More text right col -->
					
				</div>
			</div>
		</div>
	</section><!-- End Advantages -->
<?php } ?>

<!-- Why section -->
<?php if(get_field( 'why_content', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id ) != '') { ?>
	<section id="why" class="pad-80">
		<div class="container w-80">
			<div class="row">
				<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<!-- More text right col -->
					<div class="more-text">
						<h3><?php the_field('why_title', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id); ?></h3>
						<?php the_field('why_content', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id); ?>
					</div>
					<?php if(get_field( 'potential_career_paths', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id ) != '') { ?>
						<div class="more-text potential_career_paths">
							<h3>Potential Career Paths</h3>
							<?php the_field('potential_career_paths', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id); ?>
						</div>
						<!-- End More text right col -->
					<?php } ?>
				</div>
				<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 more-info-right">
					<img src="<?php the_field('why_image', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id); ?>" class="bordered more-image">
				</div>
			</div>
			<div class="row justify-content-center testimonials-row">
				<div class="col-12 col-md-10">
					<!-- testimonials -->
					<?php echo do_shortcode('[divi_library_shortcode id="248380"]'); ?>
					<!-- end testimonials -->
				</div>
			</div>
		</div>
	</section><!-- End Why -->
<?php } ?>

<!-- FAQs -->
<?php if(get_field('faqs', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id) != '') { ?>
<section id="faqs" class="pad-80">
	<div class="container w-80">
		<div class="row">
			<div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<img src="<?php bloginfo( 'url' ); ?>/wp-content/uploads/2024/04/faqs.png" width="94" height="86">
				<h3>Frequently Asked Questions</h3>
			</div>
			<div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 more-info-right">
				<?php $faqs = get_field('faqs', get_queried_object()->taxonomy . '_'. get_queried_object()->term_id);
					if(!empty($faqs)){ ?>
						<div class="accordion" id="faq">
							<?php $count = 0;
							$expanded = "true"; 
							$show = "show";
							$collapsed = "";
							foreach($faqs as $faq){ 
								if($count > 0 ) {
									$expanded = "false";
									$show = "";
									$collapsed = "collapsed";
								} ?>
								<div class="accordion-item">
									<h2 class="accordion-header" id="heading<?php echo $count; ?>">
									  <button class="accordion-button <?php echo $collapsed; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $count; ?>" aria-expanded="<?php echo $expanded; ?>" aria-controls="collapse<?php echo $count; ?>">
										<?php echo $faq['faq_question']; ?>
									  </button>
									</h2>
									<div id="collapse<?php echo $count; ?>" class="accordion-collapse collapse <?php echo $show; ?>" aria-labelledby="heading<?php echo $count; ?>" data-bs-parent="#faq">
									  <div class="accordion-body">
										<?php echo $faq['faq_answer']; ?>
									  </div>
									</div>
								</div>
							<?php $count++;
							} ?>
						</div>
					<?php } ?>
				<!-- Hidden at James' request <p class="visit">Visit our Frequently Asked Questions page for further answers</p> -->
				<a class="button1" href="<?php bloginfo('url');?>/faq/">Frequently Asked Questions</a>
			</div>
		</div>
	</div>
</div>
<?php } ?>
<!-- End FAQs -->

<!-- Related Articles -->
<section id="related-articles" class="pad-80">
	<div class="container w-80">
		<div class="row">
			<div class="col-12">
				<h3>Related Articles</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-lg-12">
				<?php $the_query = new WP_Query( array(
					'post_type' => 'post',
					'posts_per_page' => 3,
					'tax_query' => array(
						array (
							'taxonomy' => 'category',
							'field' => 'slug',
							'terms' => get_queried_object()->slug,
						)
					),
				) );

				if($the_query->have_posts()) : ?>
					<ul class="courses">
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<li class="course">
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
		</div>
	</div>
</section>
<!-- End Related Articles -->

<!-- start your journey -->
<section id="start-your-journey" class="pad-80">
	<div class="container w-80">
		<div class="row">
			<div class="col-12">
				<h3>Start Your Learning Journey</h3>
				<p>Explore our diverse range of courses tailored to elevate your career—click here to find your perfect fit! </p>
				<a href="<?php bloginfo( 'url' ); ?>/courses/" class="ul-button button2">Find a Course</a>
			</div>
		</div>
	</div>
</section>
<!-- END start your journey -->

<!-- Still -->
<section id="still-have-question" class="pad-80">
	<div class="container w-80">
		<div class="row">
			<div class="col-12">
				<h3>Still Have a Question About Our <?php echo get_queried_object()->name; ?>?</h3>
				<p>Contact our experienced team via message or phone</p>
				<a href="<?php bloginfo( 'url' ); ?>/contact/" class="button1">Send Inquiry Now&nbsp;<i class="fa-solid fa-angle-right"></i></a>
			</div>
		</div>
	</div>
</section>
<!-- END Still -->

<?php get_footer(); ?>