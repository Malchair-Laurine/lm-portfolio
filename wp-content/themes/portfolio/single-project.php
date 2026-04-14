<?php get_header(); ?>

<?php
$project_title = get_field('project_title');
$project_description = get_field('project_description');
$project_image = get_field('project_image');

$project_design_title = get_field('project_design_title');
$project_design_desc = get_field('project_design_desc');
$project_design_image = get_field('project_design_image');

$project_step_title = get_field('project_step_title');
$project_step_desc = get_field('project_step_desc');
$project_step_image = get_field('project_step_image');

$project_gallery= get_field('project_gallery');

?>

<?php if ( have_posts() ) : while (have_posts() ) : the_post(); ?>
        <h2><?= get_the_title() ?></h2>
        <p><?= get_the_excerpt() ?></p>
        <a href="<?= get_the_permalink() ?>" title="Lien vers mon projet" : <?= get_the_title() ?> target="_blank">
            Découvrir mon projet
        </a>
<?php endwhile; else: ?>
    <p><?php _e('Sorry, no posts matched your criteria.')?></p>
<?php endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>
