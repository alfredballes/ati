<?php
/*
 * The template for displaying archive courses.
 *
 * @package ATI
 * @developer Alfred Balles
 * @since ATI Australia 1.0
 */

 get_header(); ?>
 <section id="search-form">
	<div class="container w-80">   
		<div class="row">
			<div class="col-12 col-md-12">
				<h1>Search Courses</h1>
				<form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
					<input type="text" name="s" placeholder="Search Courses"/>
					<input type="hidden" name="post_type" value="courses" /> <!-- // hidden 'courses' value -->
					<input type="submit" alt="Search" value="Search" class="search-btn" />
				</form>
			</div>
		</div>
	</div>
</section> 

<!-- Industry -->
<section id="industry" class="pad-80">
	<div class="container w-80">
		<div class="row">
			<div class="col-12">
				<h3>Explore Courses</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3">
				<label for="delivery" class="label">Delivery Method</label>
				<?php $terms = get_terms([
							'taxonomy' => 'delivery',
							'hide_empty' => true,
						]); ?>
					
					<select name="delivery" id="delivery" class="filter3" style="width: 90%">
						<option value="all">All</option>
					<?php foreach ($terms as $term){ ?>
						<option value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
					<?php } ?>
					</select>
			</div>
			<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3">
				<label for="industries" class="label">Industries</label>
				<?php $terms = get_terms([
							'taxonomy' => 'industries',
							'hide_empty' => true,
						]); ?>
					
					<select name="industries" id="industries2" class="filter3" style="width: 90%">
						<option value="all">All</option>
					<?php foreach ($terms as $term){ ?>
						<option value="<?php echo $term->slug; ?>" <?php if(get_queried_object()->slug == $term->slug) { echo "selected";} ?>><?php echo $term->name; ?></option>
					<?php } ?>
					</select>
			</div>
			<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-3 sort-col">
				<label for="sort" class="label">Sort By</label>
					<select name="sort" id="sort" style="width: 90%">
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
				) );
				
				if($the_query->have_posts()) : ?>
					<ul class="equal courses">

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
						}*/
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

<!-- start your journey -->
<section id="start-your-journey" class="pad-80">
	<div class="container w-80">
		<div class="row">
			<div class="col-12">
				<h3>Start Your Learning Journey</h3>
				<p>If you are unsure if we offer RPL for a course, contact us <a href="<?php bloginfo( 'url' ); ?>/contact/">here</a> for more information</p>
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
				<p>Fill out the form below, and we’ll get back to you within 48 hours.</p>
				<a href="<?php bloginfo( 'url' ); ?>/contact/" class="button1">Send Inquiry Now&nbsp;<i class="fa-solid fa-angle-right"></i></a>
			</div>
		</div>
	</div>
</section>
<!-- END Still -->

<?php get_footer(); ?>
