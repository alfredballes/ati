<?php
/*
Template Name: Course No Price
Template Post Type: courses
*/

 get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post();?>
		<!-- course details section -->
        <section id="course-details">
            <div class="container w-80">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-8 white-bg">
						
						<?php $term_obj_list = get_the_terms( $post->ID, 'industries' ); 
						$term_id = $term_obj_list[0]->term_id;
						$term_tax = $term_obj_list[0]->taxonomy;
						$icon = get_field( 'course_icon_cat', $term_tax . '_'. $term_id ); ?>
						<div class="industry">
							<a href="<?php echo get_term_link($term_id); ?>">
								<i class="fa-solid fa-angle-left"></i> 
								<span class="industry-name"><?php echo $term_obj_list[0]->name; ?></span>
							</a>
						</div>

                        <h1 class="course-title"><?php the_title(); ?></h1>
                        <div class="course-code"><?php the_field('course_code');?></div>
						
						<?php if(get_field('show_price_on_mobile') == 1) { ?>
							<div class="course-fee mobile-only">Cost $<span><?php the_field('course_fee');?></span></div>
						<?php } ?>
                            
                        <!-- Calendar Button -->
                        <div class="single-course__calendar mobile-only">
							<?php $price_links_data = get_field('purchase_price_and_links');
							if(get_field('upcoming_courses_button') == 1 || get_field('course_type') == "in-person") { ?>
								<a href="#campus-links" class="single-course__btn outline mobile-only">View Calendar</a>
							<?php } ?>
                            
							<?php if((!empty($price_links_data) && get_field('show_enrol_button') == 1) && get_field('upcoming_courses_button') == 1) { ?>
								<div class="or mobile-only">Or</div>
							<?php } ?>

							<?php 
                                $html_output = '';
                                if(!empty($price_links_data) && get_field('show_enrol_button') == 1){
                                    foreach($price_links_data as $pld){
                                        $html_output .= '<a href="'.$pld['purchase_link'].'" class="single-course__btn outline green mobile-only">Start Online Today</a>';
                                    }
                                }
                                print $html_output;
                            ?>
							
                        </div>
                        <!-- End of Calendar Button -->
						
						<select class="mb10 form-control mobile-only" id="tab_selector">
							<option value="#description-box">Overview</option>
							<?php if(str_contains(get_the_title($post->ID), "Non-Accredited")) { 
								// show nothing
							} else { ?>
								<option value="#units-box">Units</option>
								<option value="#pre-requisites-box">Prerequisites</option>
								<option value="#licensing-box">Licensing</option>
							<?php } ?>
							<option value="#duration-box">Duration</option>
							<option value="#cost-box">Cost</option>
							<?php if(get_field('show_funding') == 1) { ?>
								<option value="#funding-box">Funding</option>
							<?php  } ?>
						</select>
						
                        <!-- Content Tab--->
							<ul class="nav nav-tabs desktop-only" id="single_course-tabs">
								<li class="nav-item">
								    <a class="nav-link et_smooth_scroll_disabled active" data-toggle="tab" href="#description-box">Overview</a>
								</li>
                                <?php if(str_contains(get_the_title($post->ID), "Non-Accredited")) { 
									// show nothing
								} else { ?>
									<li class="nav-item">
										<a class="nav-link et_smooth_scroll_disabled" data-toggle="tab" href="#units-box">Units</a>
									</li>
									<li class="nav-item">
										<a class="nav-link et_smooth_scroll_disabled" data-toggle="tab" href="#pre-requisites-box">Prerequisites</a>
									</li>
									<li class="nav-item">
										<a class="nav-link et_smooth_scroll_disabled" data-toggle="tab" href="#licensing-box">Licensing</a>
									</li>
								<?php } ?>
								<li class="nav-item">
								    <a class="nav-link et_smooth_scroll_disabled" data-toggle="tab" href="#duration-box">Duration</a>
								</li>
								<li class="nav-item">
								    <a class="nav-link et_smooth_scroll_disabled" data-toggle="tab" href="#cost-box">Cost</a>
								</li>
								<?php if(get_field('show_funding') == 1) { ?>
								<li class="nav-item">
								    <a class="nav-link et_smooth_scroll_disabled" data-toggle="tab" href="#funding-box">Funding</a>
								</li>
								<?php  } ?>
								<?php if(get_field('course_type') == "in-person") { ?>
									<li class="nav-item">
										<a class="enrol-link" href="#campus-links">Calendar <i class="fa-solid fa-angle-right"></i></a>
									</li>
								<?php } ?>
								<?php if(get_field('enrol_link') != "") { ?>
									<li class="nav-item">
										<a class="enrol-link" href="<?php the_field('enrol_link'); ?>">Enrol</a>
									</li>
								<?php } ?>
								
							</ul>
							<!-- End of Content Tab -->
							<!-- Content Tab panes -->
							<div class="tab-content" id="single_course-tabs-content">
								<div id="description-box" class="tab-pane active">
									<div class="right-img">
										<?php if(get_field('funding_available') == 1) { ?>
											<a href="<?php bloginfo('url');?>/funded-training/"><img src="<?php bloginfo('url'); ?>/wp-content/uploads/2024/11/government-funding3.png"></a>
											<br>
										<?php } ?>
										<?php if(get_field('show_same_day_certificate') == 1) { ?>
											<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2024/07/Same-Day-Certificate-224x300-1.png">
										<?php } ?>
										<?php if(get_field('best_price_enable') == 1) { ?>
											<br>
											<img class="second" src="<?php bloginfo('url'); ?>/wp-content/uploads/2024/06/best-price-e1729749867768.png">
										<?php } ?>
									</div>
									<?php the_content(); ?>
								</div>
								<div id="units-box" class=" tab-pane fade">
									<?php the_field('units'); ?>
								</div>
								<div id="pre-requisites-box" class=" tab-pane fade">
									<?php the_field('pre-requisites'); ?>
								</div>
								<div id="licensing-box" class=" tab-pane fade">
									<?php the_field('licensing'); ?>
								</div>
								<div id="cost-box" class=" tab-pane fade">
									<div class="right-img">
										<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2024/11/Apple-Pay.png">
										<br>
										<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2024/11/Google-Pay.png">
										<br>
										<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2024/11/mastercard.png">
										<br>
										<img src="<?php bloginfo('url'); ?>/wp-content/uploads/2024/11/visa.png">
									</div>
									<?php the_field('costs'); ?>
									<?php if((int)trim(get_field('best_price_enable')) == 1){ ?>
										<p class="best-price"><small><img style="float: left;" src="<?php print bloginfo('url'); ?>/wp-content/uploads/2024/04/best-price.png" alt="Best Price" width="64" height="53"><span>We guarantee to beat any comparable competitor pricing (conditions apply)<br/>Please contact us if you do happen to find a better price. </span></small></p>
									<?php } ?>
									<?php if((int)trim(get_field('enable_csq_available_to_students')) == 1){ ?>
										<div class="csq-container">
											<p><strong><small>CSQ funding available to eligible students</small></strong></p>
											<p><strong><small><img src="<?php print get_stylesheet_directory_uri(); ?>/images/CSQ-Logo-Tagline-RGB.jpg" alt="" width="349" height="53"></small></strong></p>
											<p><strong><small>To find out more information </small></strong><strong><small><a href="/funding-available" target="_blank">Click Here</a></small></strong><strong><em>.</em></strong></p>
										</div>
									<?php } ?>
								</div>
								<div id="duration-box" class=" tab-pane fade">
									<?php the_field('duration'); ?>
								</div>
								<?php if(get_field('funding') != "" && get_field('show_funding') == 1) { ?>
									<div id="funding-box" class=" tab-pane fade">
										<?php the_field('funding'); ?>
									</div>
								<?php } ?>
							</div>
                        <!-- End of Content Tab panes -->
						
						<div id="courses-link"></div>

                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 white-bg-sidebar">
						
						<!--<div class="course-fee desktop-only">Cost $<span><?php #the_field('course_fee');?></span></div>-->
                            
                        <!-- Calendar Button -->
                        <div class="single-course__calendar desktop-only">
                            <?php /*if((int)trim(get_field('display_calendar')) == 1){ 
                                    if(get_field('calendar_enroll') != ''){
                                ?>
                                <a href="<?php the_field('calendar_enroll'); ?>" target="_blank" title="Book course in Course Calendar page" class="single-course__btn">Calendar/Enrol Now <i class="fa-solid fa-angle-right"></i></a>
                            <?php }
                                    } */ ?>
                            <?php 
                                $price_links_data = get_field('purchase_price_and_links');
                                $html_output = '';
                                if(!empty($price_links_data) && get_field('show_enrol_button') == 1){
                                    foreach($price_links_data as $pld){
                                        $html_output .= '<a href="'.$pld['purchase_link'].'" class="single-course__btn desktop-only">Start Online Today  <i class="fa-solid fa-angle-right"></i></a>';
                                    }
                                }
                                print $html_output;
                            ?>
							<?php if($term_obj_list[0]->name == "Justice Services") { ?>
								<div class="or desktop-only">Or</div>
								<a href="#campus-links" class="single-course__btn desktop-only">Zoom <i class="fa-solid fa-angle-right"></i></a>
							<?php } ?>
							<?php if((!empty($price_links_data) && get_field('show_enrol_button') == 1) && get_field('upcoming_courses_button') == 1) { ?>
								<div class="or desktop-only">Or</div>
							<?php } ?>
							<?php if(get_field('upcoming_courses_button') == 1 || get_field('course_type') == "in-person") { ?>
								<a href="#campus-links" class="single-course__btn blue desktop-only">View Calendar <i class="fa-solid fa-angle-right"></i></a>
							<?php } ?>
                        </div>
                        <!-- End of Calendar Button -->
						<div class="single-course__calendar">
							<?php if( is_single( ('certificate-ii-in-security-operations') ) ) { ?>
								<a href="<?php echo get_permalink(246499); ?>" class="single-course__btn orange">Apply for Funding <i class="fa-solid fa-angle-right"></i></a>
							<?php } ?>
						</div>
						
						<!-- Course Image -->
						<?php echo get_the_post_thumbnail( $post_id, array( 282, 259), array( 'class' => 'aligncenter course-image' ) ); ?>
						<!-- End Course Image -->
						
						<!-- Student Flyer -->
						<div class="student-flyer">
							<?php if( get_field('student_flyer') != '') { ?>
								<a href="<?php the_field('student_flyer'); ?>" class="button1 blue" target="_blank">Download Student Flyer</a>
							<?php } ?>
							<?php if($term_obj_list[0]->name == "Security Courses") { ?>
								<a href="<?php bloginfo('url');?>/security-career-information-sessions/" class="button1 career-info">Career Info Sessions</a>
							<?php } ?>
						</div>
						<!-- End Student Flyer -->

                    </div>
                </div>
            </div><!-- .container -->
        </section><!-- #course-details -->
		
		<?php if(get_field('sandgate_workshops') != '' || get_field('logan_workshops') != '' || get_field('zoom_classes') != '' || get_field('albion_workshops') != '' || get_field('zoom_classes') != '' || get_field('rothwell_workshops') != '') { ?>
			<section id="campus-links">
				<div class="container">
					<div class="row justify-content-md-center">
						<div class="col-12 col-lg-8">
							<h4>Upcoming Courses</h4>
							<h2 style="text-align: center;"><?php the_title(); ?></h2>
						</div>
					</div>
					<div class="row justify-content-md-center">
						<div class="col-12 col-lg-12 grey-bg desktop-only">
							<h3>Select Training Campus</h3>
							
							<?php if(get_field('albion_workshops') != '') { ?>
								<div class="course-loc <?php if(get_field('zoom_classes') != '' && is_single('provide-first-aid-cpr')) echo "1_3"; ?>">
									<a href="#upcoming" data-id="albion" class="single-course__btn workshop-link et_smooth_scroll_disabled">Albion QLD 4010</a>
								</div>
							<?php } ?>
							
							<?php /* if(get_field('sandgate_workshops') != '') { ?>
								<div class="course-loc <?php if(get_field('zoom_classes') != '' && is_single('provide-first-aid-cpr')) echo "1_3"; ?>">
									<a href="#upcoming" data-id="sandgate" class="single-course__btn workshop-link et_smooth_scroll_disabled">Sandgate QLD 4017</a>
								</div>
							<?php } */ ?>
							
							<?php if(get_field('logan_workshops') != '') { ?>
								<div class="course-loc <?php if(get_field('zoom_classes') != '' && is_single('provide-first-aid-cpr')) echo "1_3"; ?>">
									<a href="#upcoming" data-id="logan" class="single-course__btn workshop-link et_smooth_scroll_disabled">Logan QLD 4114</a>
								</div>
							<?php } ?>
							
							<?php if(get_field('ipswich_workshops') != '') { ?>
								<div class="course-loc <?php if(get_field('zoom_classes') != '' && is_single('provide-first-aid-cpr')) echo "1_3"; ?>">
									<a href="#upcoming" data-id="ipswich" class="single-course__btn workshop-link et_smooth_scroll_disabled">Ipswich QLD 4305</a>
								</div>
							<?php } ?>
							
							<?php if(get_field('rothwell_workshops') != '') { ?>
								<div class="course-loc <?php if(get_field('zoom_classes') != '' && is_single('provide-first-aid-cpr')) echo "1_3"; ?>">
									<a href="#upcoming" data-id="rothwell" class="single-course__btn workshop-link et_smooth_scroll_disabled">Rothwell QLD 4022</a>
								</div>
							<?php } ?>
							
							<?php if(get_field('zoom_classes') != '') { ?>
								<div class="course-loc <?php if(get_field('zoom_classes') != '' && is_single('provide-first-aid-cpr')) echo "1_3"; ?>">
									<a href="#upcoming" data-id="zoom" class="single-course__btn workshop-link et_smooth_scroll_disabled">Zoom Classes</a>
								</div>
							<?php } ?> 
						</div>
						<div class="col-12 col-lg-8 grey-bg mobile-only">
							<h3>Select Training Campus</h3>
							<select id="workshop-link">
								<option value="all">All</option>
								<?php if(get_field('albion_workshops') != '') { ?>
									<option value="albion">Albion QLD 4010</option>
								<?php } ?>
								<?php if(get_field('ipswich_workshops') != '') { ?>
									<option value="ipswich">Ipswich QLD 4305</option>
								<?php } ?>
								<?php if(get_field('logan_workshops') != '') { ?>
									<option value="logan">Logan QLD 4129</option>
								<?php } ?>
								<?php /* if(get_field('sandgate_workshops') != '') { ?>
									<option value="sandgate">Sandgate QLD 4017</option>
								<?php } */ ?>
								<?php if(get_field('rothwell_workshops') != '') { ?>
									<option value="rothwell">Rothwell QLD 4022</option>
								<?php } ?>
								<?php if(get_field('zoom_classes') != '') { ?>
									<option value="zoom">Zoom Classes</option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		
		<!-- Upcoming Courses -->
		<?php if(get_field('show_upcoming_courses') == 1) { ?>
		<section id="upcoming" class="pad-80">
            <div class="container w-80">
				<div class="row">
					<div class="col-12">
						<?php the_field('upcoming_courses_shortcode'); ?>
					</div>
				</div>
			</div>
		</section>
		<?php } ?>
		<!-- END - Upcoming Courses -->
		
		<!-- Albion Courses -->
		<?php if(get_field('albion_workshops') != '') { ?>
			<section id="albion" class="pad-80 courses-table" style="display: none;">
				<div class="container w-80">
					<div class="row">
						<div class="col-12">
							<?php the_field('albion_workshops'); ?>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		<!-- END - Albion Courses -->
		
		<!-- Ipswich Courses -->
		<?php if(get_field('ipswich_workshops') != '') { ?>
			<section id="ipswich" class="pad-80 courses-table" style="display: none;">
				<div class="container w-80">
					<div class="row">
						<div class="col-12">
							<?php the_field('ipswich_workshops'); ?>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		<!-- END - Ipswich Courses -->
				
		<!-- Logan Courses -->
		<?php if(get_field('logan_workshops') != '') { ?>
			<section id="logan" class="pad-80 courses-table" style="display: none;">
				<div class="container w-80">			
					<div class="row">
						<div class="col-12">
							<?php the_field('logan_workshops'); ?>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		<!-- END - Logan Courses -->
		
		<!-- Sandgate Courses -->
		<?php if(get_field('sandgate_workshops') != '') { ?>
			<section id="sandgate" class="pad-80 courses-table" style="display: none;">
				<div class="container w-80">
					<div class="row">
						<div class="col-12">
							<?php the_field('sandgate_workshops'); ?>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		<!-- END - Sandgate Courses -->
		
		<!-- Rothwell Courses -->
		<?php if(get_field('rothwell_workshops') != '') { ?>
			<section id="rothwell" class="pad-80 courses-table" style="display: none;">
				<div class="container w-80">
					<div class="row">
						<div class="col-12">
							<?php the_field('rothwell_workshops'); ?>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		<!-- END - Rothwell Courses -->
		
		<!-- Zoom Classes -->
		<?php if(get_field('zoom_classes') != '') { ?>
			<section id="zoom" class="pad-80 courses-table" style="display: none;">
				<div class="container w-80">
					<div class="row">
						<div class="col-12">
							<?php the_field('zoom_classes'); ?>
						</div>
					</div>
				</div>
			</section>
		<?php } ?>
		<!-- END - Zoom Classes	-->
		
		<!--<button type="button" class="button1 launch-btn" data-toggle="modal" data-target="#enrolmentEnquiry">
		  Enrolment Enquiry
		</button>-->
		
		<!-- More Information section -->
		<?php if(get_field('more_text_right_column') != '' && get_field('more_text_left_column') != '') { ?>
			<section id="more-information" class="pad-80">
				<div class="container w-80">
					<div class="row">
						<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<!-- More Image -->
							<img src="<?php the_field('more_image'); ?>" class="bordered more-image">
							<!-- End More Image -->
							
						</div>
						<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 more-info-right">
							<!-- More text right col -->
							<div class="more-text-right more-text">
								<?php the_field('more_text_right_column'); ?>
							</div>
							<!-- End More text right col -->
							
						</div>
					</div>
					
					<div class="row">
						<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<!-- More text left col -->
							<div class="more-text-left more-text">
								<?php the_field('more_text_left_column'); ?>
							</div>
							<!-- End More text left col -->
						</div>
						<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 more-info-right">
							<!-- testimonials -->
							<?php echo do_shortcode('[divi_library_shortcode id="248380"]'); ?>
							<!-- end testimonials -->
						</div>
					</div>
				</div>
			</section><!-- End More information -->
		<?php } ?>
		
		<!-- Related Courses -->
        <section id="related-courses" class="pad-80">
            <div class="container w-80">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<h3>Related Courses</h3>
						<?php

						// You might need to use wp_reset_query(); 
						// here if you have another query before this one

						global $post;

						$current_post_type = get_post_type( $post );
						$term_obj_list = get_the_terms( $post->ID, 'industries' ); 
						//print_r($term_obj_list);
						$term_id = $term_obj_list[0]->term_id;
						$term_tax = $term_obj_list[0]->taxonomy;

						// The query arguments
						$args = array(
							'posts_per_page' => 10,
							'order' => 'DESC',
							'orderby' => 'ID',
							'post_type' => $current_post_type,
							'post__not_in' => array( $post->ID, 255074 ),
							'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => $term_tax,
								'field'    => 'ID',
								'terms'    => array($term_obj_list[0]->term_id)
								 )
							),
							
						);

						// Create the related query
						$rel_query = new WP_Query( $args );

						// Check if there is any related posts
						if( $rel_query->have_posts() ) : 
						?>
						<div id="related" class="lazy slider" data-sizes="50vw">
						<?php
							// The Loop
							while ( $rel_query->have_posts() ) :
								$rel_query->the_post();
						?>
								<div class="related-post">
									<a href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark" class="related-link">
										<?php echo get_the_post_thumbnail( get_the_ID(), array(282,181), array( 'class' => 'related-course-image' ) ); ?>
<!-- 										<p class="entry-title"><?php //the_title() ?></p> -->
										<p class="learn-more"><?php the_title() ?><span><i class="fa-solid fa-arrow-right"></i></span></p>
									</a>
								</div>
						<?php
							endwhile;
						?>
						</div><!-- #related -->
						<?php
						endif;

						// Reset the query
						wp_reset_query();

						?>
					</div>
				</div>
			</div>
		</section>
		<!-- End Related Courses -->
		
		<!-- Start your journney section -->
		<?php echo do_shortcode('[divi_library_shortcode id="248396"]'); ?>
		<!-- end start your journey section -->
		
		<!-- Study Pathways -->
		<?php if(get_field('study_pathways') != '' && get_field('other_related_courses') != '' & get_field('assessment_information') != "") { ?>
		<section id="study-pathways" class="pad-80">
            <div class="container w-80">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6">
						<strong>Study Pathways</strong>
						<?php the_field('study_pathways'); ?>
						<strong>Other Related Course:</strong>
						<?php the_field('other_related_courses'); ?>
					</div>
					<div class="col-12 col-xs-12 col-sm-12 col-md-6 col-lg-6 more-info-right">
						<strong>Assessment Information:</strong>
						<?php the_field('assessment_information'); ?>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<!-- End Study Pathways -->
		
		<!-- FAQs -->
		<?php if(get_field('faqs') != '') { ?>
		<section id="faqs" class="pad-80">
            <div class="container w-80">
                <div class="row">
                    <div class="col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
						<img src="<?php bloginfo( 'url' ); ?>/wp-content/uploads/2024/04/faqs.png" width="94" height="86">
						<h3>Frequently Asked Questions</h3>
					</div>
					<div class="col-12 col-xs-12 col-sm-12 col-md-9 col-lg-9 more-info-right">
						<?php $faqs = get_field('faqs');
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
					<div class="col-12 col-lg-8">
						<?php 
						$term_id = $term_obj_list[0]->term_id;
						$slug = $term_obj_list[0]->slug;
						
						$the_query = new WP_Query( array(
							'post_type' => 'post',
							'posts_per_page' => 2,
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
												<?php echo $term_obj_list[0]->name; ?>
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
					<div class="col-12 col-lg-4">
						<img decoding="async" width="81" height="76" alt="news-icon-blue" title="news-icon-blue" data-src="https://ansicvpn.com/wp-content/uploads/2024/05/news-icon-blue.svg" class="wp-image-249191 lazyloaded" src="https://ansicvpn.com/wp-content/uploads/2024/05/news-icon-blue.svg">
						<h3>Discover the<br> Latest Trends</h3>
						<p>Stay up to date with our<br> informative blog posts</p>
						<a class="button1" href="https://ansicvpn.com/articles/" data-icon="5">View Latest News <i class="fa fa-angle-right"></i></a>
					</div>
				</div>
			</div>
		</section>
		<!-- End Related Articles -->
		
		<!-- Still have a question -->
		<?php echo do_shortcode('[divi_library_shortcode id="248483"]'); ?>
		<!-- End Still have a question -->
		
		<!-- Modal -->
		<div class="modal fade" id="enrolmentEnquiry" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Enrolment Enquiry Form</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			  <div class="modal-body">
				<div id="zf_div_yGADlv573bT9WZ6KPsoGk23RPsFzU4Px3z8i7ZUWBHY"></div><script type="text/javascript">(function() {
						try{
						var f = document.createElement("iframe");
						f.src = 'https://forms.zohopublic.com.au/ansicgroup1/form/EnrolmentEnquiry/formperma/yGADlv573bT9WZ6KPsoGk23RPsFzU4Px3z8i7ZUWBHY?zf_rszfm=1';
						f.style.border="none";
						f.style.height="864px";
						f.style.width="100%";
						f.style.transition="all 0.5s ease";
						f.setAttribute("aria-label", 'Enrolment\x20Enquiry');

						var d = document.getElementById("zf_div_yGADlv573bT9WZ6KPsoGk23RPsFzU4Px3z8i7ZUWBHY");
						d.appendChild(f);
						window.addEventListener('message', function (){
						var evntData = event.data;
						if( evntData && evntData.constructor == String ){
						var zf_ifrm_data = evntData.split("|");
						if ( zf_ifrm_data.length == 2 || zf_ifrm_data.length == 3 ) {
						var zf_perma = zf_ifrm_data[0];
						var zf_ifrm_ht_nw = ( parseInt(zf_ifrm_data[1], 10) + 15 ) + "px";
						var iframe = document.getElementById("zf_div_yGADlv573bT9WZ6KPsoGk23RPsFzU4Px3z8i7ZUWBHY").getElementsByTagName("iframe")[0];
						if ( (iframe.src).indexOf('formperma') > 0 && (iframe.src).indexOf(zf_perma) > 0 ) {
						var prevIframeHeight = iframe.style.height;
						var zf_tout = false;
						if( zf_ifrm_data.length == 3 ) {
						iframe.scrollIntoView();
						zf_tout = true;
						}
						if ( prevIframeHeight != zf_ifrm_ht_nw ) {
						if( zf_tout ) {
						setTimeout(function(){
						iframe.style.height = zf_ifrm_ht_nw;
						},500);
						} else {
						iframe.style.height = zf_ifrm_ht_nw;
						}
						}
						}
						}
						}
						}, false);
						}catch(e){}
						})();</script>
			  </div>
			</div>
		  </div>
		</div>
		
    <?php endwhile; ?>
<?php endif; ?>

<?php  get_footer(); ?>