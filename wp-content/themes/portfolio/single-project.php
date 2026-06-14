<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
    // 1. Centralisation de la récupération des champs ACF
    $project_description = get_field('project_description');
    $project_view = get_field('project_view');
    $project_step_title = get_field('project_step_title');
    $project_step_desc = get_field('project_step_desc');
    $project_design_title = get_field('project_design_title');
    $project_design_desc = get_field('project_design_desc');
    $project_design_image = get_field('project_design_image');
    $functionalities_title = get_field('functionalities_title');
    $functionalities_text = get_field('functionalities_text');
    $conclusion_title = get_field('conclusion_title');
    $conclusion = get_field('conclusion');
    $project_gallery = get_field('project_gallery');
    $project_gallery_images = get_field('project_gallery_images');
    $project_links = get_field('project_links');
    $project_links_title = get_field('project_links_title');
    ?>

    <main class="project-container" itemscope itemtype="https://schema.org/CreativeWork">

        <header class="project-header">
            <div class="project-header__content">
                <h1 class="project-header__title" itemprop="name"><?= get_the_title() ?></h1>
                <?php if ($project_description) : ?>
                    <p class="project-header__description" itemprop="description"><?= $project_description ?></p>
                <?php endif; ?>
            </div>

            <?php if ($project_view) : ?>
                <div class="project-header__img-wrapper">
                    <img src="<?= esc_url($project_view['url']) ?>" alt="<?= esc_attr($project_view['alt']) ?>"
                         class="project-header__image" itemprop="image">
                </div>
            <?php endif; ?>
        </header>

        <section class="step-section" itemprop="step" itemscope itemtype="https://schema.org/HowToSection">
            <?php if ($project_step_title) : ?>
                <h2 class="step-section__title" itemprop="name"><?= $project_step_title ?></h2>
            <?php endif; ?>

            <?php if ($project_step_desc) : ?>
                <div class="step-section__description dynamic-content" itemprop="text">
                    <?= $project_step_desc ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="design-section" itemprop="hasPart" itemscope itemtype="https://schema.org/CreativeWork">
            <div class="design-section__content">
                <?php if ($project_design_title) : ?>
                    <h2 class="design-section__title" itemprop="name"><?= $project_design_title ?></h2>
                <?php endif; ?>

                <?php if ($project_design_desc) : ?>
                    <div class="design-section__description dynamic-content" itemprop="description"><?= $project_design_desc ?></div>
                <?php endif; ?>
            </div>

            <?php if ($project_design_image) : ?>
                <div class="design-section__img-wrapper">
                    <img src="<?= esc_url($project_design_image['url']) ?>"
                         alt="<?= esc_attr($project_design_image['alt']) ?>" class="design-section__image" itemprop="image">
                </div>
            <?php endif; ?>
        </section>

        <section class="functionality-section" itemprop="hasPart" itemscope itemtype="https://schema.org/CreativeWork">
            <?php if ($functionalities_title) : ?>
                <h2 class="functionality-section__title" itemprop="name"><?= $functionalities_title ?></h2>
            <?php endif; ?>

            <?php if ($functionalities_text) : ?>
                <div class="functionality-section__description dynamic-content" itemprop="description"><?= $functionalities_text ?></div>
            <?php endif; ?>
        </section>

        <?php if ($conclusion_title || $conclusion) : ?>
            <section class="conclusion-section" itemprop="hasPart" itemscope itemtype="https://schema.org/CreativeWork">
                <?php if ($conclusion_title) : ?>
                    <h2 class="conclusion-section__title" itemprop="name"><?= $conclusion_title ?></h2>
                <?php endif; ?>
                <?php if ($conclusion) : ?>
                    <div class="conclusion-section__description" itemprop="description"><?= $conclusion ?></div>
                <?php endif; ?>
            </section>
        <?php endif; ?>

        <section class="link-section" itemprop="relatedLink">
            <?php foreach ($project_links as $key => $project_link): ?>
                <a href="<?= htmlspecialchars($project_link['one_link']) ?>" itemprop="url">
                    <?= htmlspecialchars($project_links_title[$key]['one_link_title']) ?>
                </a>
            <?php endforeach; ?>
        </section>

        <section class="gallery-section">
            <?php if ($project_gallery) : ?>
                <h2 class="gallery-section__title"><?= $project_gallery ?></h2>
            <?php endif; ?>

            <?php if (!empty($project_gallery_images)) : ?>
                <div class="gallery-grid" itemprop="associatedMedia" itemscope itemtype="https://schema.org/ImageGallery">
                    <?php foreach ($project_gallery_images as $image_data):
                        // S'assure de cibler le bon sous-champ selon votre config de répéteur ACF
                        $img = isset($image_data['project_gallery_image']) ? $image_data['project_gallery_image'] : $image_data;
                        if ($img) : ?>
                            <div class="gallery-item" itemprop="associatedMedia" itemscope itemtype="https://schema.org/ImageObject">
                                <img src="<?= esc_url($img['url']) ?>" alt="<?= esc_attr($img['alt']) ?>"
                                     class="gallery-image" itemprop="contentUrl">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

    </main>

<?php endwhile;
else: ?>
    <p><?php _e('Sorry, no posts matched your criteria'); ?></p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>