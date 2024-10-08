<?php
/* Template Name: Archive Search */  
get_header(); ?>
<section id="search-form">
	<div class="container w-80">   
		<div class="row">
			<div class="col-12 col-md-12">
				<h3>Search Courses</h3>
				<form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
					<input type="text" name="s" placeholder="Search Courses"/>
					<input type="hidden" name="post_type" value="courses" /> <!-- // hidden 'courses' value -->
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
		<div class="row">
			<div class="col-12 col-md-12">       
				<?php if ( have_posts() ) : ?>
					<ul class="equal courses">
						<?php while ( have_posts() ) : the_post();   
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
							/*$locs = get_the_terms( get_the_ID(), 'location' ); 
							$locations = "";
							foreach($locs as $loc){
								$locations .= $loc->slug . " ";
							}
							$levels = get_the_terms( get_the_ID(), 'experience_level' ); 
							$lvls = "";
							foreach($levels as $level){
								$lvls .= $level->slug . " ";
							} */
							?>
							<li class="course <?php echo $deliveries;?> <?php //echo $locations; ?> <?php echo $industry; ?>" data-price="<?php echo str_replace( ',', '', get_field('course_fee') );?>">
								<?php echo get_the_post_thumbnail( get_the_ID(), array(380,250), array( 'class' => 'related-course-image' ) );
								
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
					</ul>
				<?php else:
					echo "<p class='no-courses'>No results were found. Please try again. </p>"; ?>
				<?php endif; ?>
			</div>
		</div>
   </div><!-- container -->    
</section><!-- search-form -->
<?php get_footer(); ?>