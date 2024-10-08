<?php
/* Template Name: Search Courses*/        
get_header(); ?>
<section id="search-form">
	<div class="container w-80">   
		<div class="row">
			<div class="col-12 col-md-12">
				<h1>Search Courses</h1>
				<form role="search" action="<?php echo site_url('/'); ?>" method="get" id="searchform">
					<input type="text" name="s" placeholder="Search for your course:"/>
					<input type="hidden" name="post_type" value="courses" /> <!-- // hidden 'courses' value -->
					<input type="submit" alt="Search" value="Search" class="search-btn" />
				</form>
			</div>
		</div>
	</div>
</section> 
<?php get_footer(); ?>