<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) :
    the_post(); ?>

    <?php
    $project_description = get_field('project_description');
    $project_image = get_field('project_image');

    $project_design_title = get_field('project_design_title');
    $project_design_desc = get_field('project_design_desc');
    $project_design_image = get_field('project_design_image');

    $project_step_title = get_field('project_step_title');
    $project_step_desc = get_field('project_step_desc');
    $project_step_image = get_field('project_step_image');

    $project_gallery = get_field('project_gallery');
    $project_gallery_images = get_field('project_gallery_images');

    ?>

    <h1> <?= get_the_title() ?> </h1>

    <?php if ($project_description) : ?>
    <p> <?= $project_description ?> </p>
<?php endif; ?>

    <?php if ($project_image) : ?>
    <img src="<?= $project_image['url'] ?>"
         alt=" <?= $project_image ['alt'] ?>"
    >
<?php endif; ?>

    <div>
        <?php if ($project_design_title) : ?>
            <h2> <?= $project_design_title ?> </h2>
        <?php endif; ?>


        <?php if ($project_design_desc) : ?>
            <p> <?= $project_design_desc ?> </p>
        <?php endif; ?>

        <?php if ($project_design_image) : ?>
            <img src="<?= $project_design_image['url'] ?>"
                 alt=" <?= $project_design_image ['alt'] ?>">
        <?php endif; ?>

    </div>

    <div>
        <?php if ($project_step_title) : ?>
            <h2> <?= $project_step_title ?> </h2>
        <?php endif; ?>

        <?php if ($project_step_image) : ?>
            <img src="<?= $project_step_image['url'] ?>"
                 alt=" <?= $project_step_image ['alt'] ?>">
        <?php endif; ?>

    </div>

    <?php if ($project_gallery) : ?>
    <h2 class="gallery"> <?= $project_gallery ?> </h2>
<?php endif; ?>

    <?php foreach ($project_gallery_images as $project_gallery_image): ?>
    <div class="gallery-images">
        <img src="<?= $project_gallery_image['project_gallery_image']['url'] ?>"
             alt="<?= $project_gallery_image['project_gallery_image']['alt'] ?>"
             width="400"
             height="400"
             class="gallery-image"
        >
    </div>
<?php endforeach; ?>

<?php endwhile; else: ?>
    <p> <?php _e('Sorry, no posts matched your criteria'); ?> </p>
<?php endif; ?>
<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>