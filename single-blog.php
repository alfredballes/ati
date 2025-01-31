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
					<h2 class="course-title"><?php the_title(); ?></h2>
				</div>
			</div>
		</section>
	
	<?php endwhile; ?>
<?php endif; ?>