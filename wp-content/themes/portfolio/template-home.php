<?php
/*Template Name: HomePage*/
?>

<?php get_header(); ?>

<?php
// typemachine
$typemachine_text = get_field('typemachine_text');

//header
$main_title = get_field('main_title');
$subtitle = get_field('subtitle');

//about me
$description_title = get_field('description_title');
$description_text = get_field('description_text');
$sitting_cartoon = get_field('sitting_cartoon');
$cat_cartoon = get_field('cat_cartoon');

//skills
$skills_title = get_field('skills_title');
$skills_library = get_field('skills_library');
$skills_text = get_field('skills_text');


//projects
$projects_main_title = get_field('projects_main_title');
$filter = get_field('filter');
$filter_query = $_GET['filter'] ?? 'Tous';

//course
$course_title = get_field('course_title');
$flying_cartoon = get_field('flying_cartoon');
$steps = get_field('steps');

//contact
$contact_title = get_field('contact_title');
$contact_image = get_field('contact_image');

$name = get_field('name');
$email = get_field('email');
$phone_number = get_field('phone_number');
$message = get_field('message');

$my_coordonee_title = get_field('my_coordonee_title');
$my_phone_number_label = get_field('my_phone_number_label');
$my_phone_number = get_field('my_phone_number');
$my_mail_label = get_field('my_mail_label');
$my_mail = get_field('my_mail');
$my_country_label = get_field('my_country_label');
$my_country = get_field('my_country');
?>

<!---->
<!--Type machine-->
<!---->

<div class="typemachine">
    <?php if ($typemachine_text !== ""): ?>
        <p class="typemachine__text"><?= $typemachine_text ?></p>
    <?php endif; ?>
</div>


<!---->
<!--header-->
<!---->

<div class="header" id="accueil">
    <?php if ($main_title !== ""): ?>
        <h1 class="header__title"><?= $main_title ?></h1>
    <?php endif; ?>

    <?php if ($subtitle !== ""): ?>
        <h2 class="header__subtitle"><?= $subtitle ?></h2>
    <?php endif; ?>
</div>

<!---->
<!--A propose de moi-->
<!---->

<section class="about-me" id="a-propos-de-moi">
    <div class="about-me__content">
        <?php if ($description_title !== ""): ?>
            <h2 class="about-me__title"><?= $description_title ?></h2>
        <?php endif; ?>

        <?php if ($description_text !== ""): ?>
            <p class="about-me__description"><?= $description_text ?></p>
        <?php endif; ?>
    </div>

    <div class="about-me__images">
        <div class="about-me__bench"></div>
        <?php if ($sitting_cartoon): ?>
            <img src="<?= $sitting_cartoon ['url'] ?>"
                 alt="<?= $sitting_cartoon ['alt'] ?>"
                 width="400"
                 height="400"
                 class="about-me__image about-me__image--sitting"
            >
        <?php endif; ?>

        <?php if ($cat_cartoon !== ""): ?>
            <img src="<?= $cat_cartoon ['url'] ?>"
                 alt="<?= $cat_cartoon ['alt'] ?>"
                 width="400"
                 height="400"
                 class="about-me__image about-me__image--cat"
            >
        <?php endif ?>
    </div>


</section>

<!---->
<!--Mes compétences-->
<!---->

<section class="skills" id="mes-competences">
    <?php if ($skills_title !== ""): ?>
        <p class="skills__title"><?= $skills_title ?></p>
    <?php endif; ?>

    <?php if ($skills_library): ?>
        <div class="skills__container">

            <div class="skills__library-wrapper">
                <img src="<?= $skills_library ['url'] ?>"
                     alt="<?= $skills_library ['alt'] ?>"
                     width="400"
                     height="400"
                     class="skills__illustration"
                >
                <div class="skills__labels">
                    <?php foreach ($skills_text as $index => $skill): ?>
                        <div class="skills__book-text skills__book-text--<?= $index + 1 ?>">
                            <span><?= $skill['skill_text'] ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="skills__shelf"></div>
        </div>
    <?php endif; ?>
</section>

<!---->
<!--Mes projets-->
<!---->

<section class="projects" id="mes-projets">

    <?php
    $terms = get_terms(['project-type']);
    $taxonomy = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : '';

    $args = [
            'post_type' => 'project',
            'post_status' => 'publish',
            'posts_per_page' => 6,
    ];

    if ($taxonomy !== '') {
        $args['tax_query'] = [
                [
                        'taxonomy' => 'project-type',
                        'field' => 'slug',
                        'terms' => $taxonomy,
                ]
        ];
    }
    $query = new WP_Query($args);

    ?>

    <?php if ($projects_main_title !== ""): ?>
        <h2 class="projects__title"><?= $projects_main_title ?></h2>
    <?php endif; ?>

    <nav class="projects__nav">
        <ul class="projects__filter-list">
            <?php foreach ($terms as $term) : ?>
                <li class="projects__filter-item">
                    <a href="/?filter=<?= $term->slug ?>#mes-projets" class="projects__filter-link">
                        <?= $term->name; ?>
                    </a>
                </li>
            <?php endforeach; ?>

        </ul>
    </nav>

    <?php foreach ($filter as $filter_item): ?>
        <?php if (strtolower($filter_query) === strtolower($filter_item['filter_name'])): ?>
            <div class="projects__category-visual">
                <img src="<?= $filter_item['filter_image']['url'] ?>"
                     alt="<?= $filter_item['filter_image']['alt'] ?>"
                     width="400"
                     height="400"
                     class="projects__category-img"
                >
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <div class="projects__grid">
        <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <?php
            $project_title = get_field('project_title');
            $project_book = get_field('project_book');
            $project_image = get_field('project_image');
            ?>
            <?php if ($project_title !== "" && $project_image !== "" && $project_book !== ""): ?>
                <article class="projects__item project-card">

                    <a
                            class="project-card__link"
                            href="<?= get_the_permalink() ?>"
                            title="Lien vers <?= get_the_title() ?>"
                            target="_blank"
                    >

                        <div class="project-card__media">

                            <img
                                    src="<?= $project_book['url'] ?>"
                                    alt="<?= $project_book['alt'] ?>"
                                    width="400"
                                    height="400"
                                    class="project-card__book"
                            >

                            <img
                                    src="<?= $project_image['url'] ?>"
                                    alt="<?= $project_image['alt'] ?>"
                                    width="300"
                                    height="300"
                                    class="project-card__thumbnail"
                            >

                        </div>

                        <h3 class="project-card__title">
                            <?= $project_title ?>
                        </h3>

                    </a>

                </article>
            <?php endif; ?>
        <?php endwhile; else: ?>
            <p class="projects__empty"><?php _e('Sorry, no posts matched your criteria.') ?></p>
        <?php endif;
        wp_reset_postdata(); ?>
    </div>

</section>

<!---->
<!--Mon parcours-->
<!---->

<section class="course" id="mon-parcours">
    <?php if ($course_title !== ""): ?>
        <h2 class="course__title"><?= $course_title ?></h2>
    <?php endif; ?>

    <div class="course__container">

        <div class="course__avatar-container">
            <?php if ($flying_cartoon !== ''): ?>
                <img src="<?= $flying_cartoon['url'] ?>"
                     alt="<?= $flying_cartoon['alt'] ?>"
                     width="400"
                     height="400"
                     class="course__main-image"
                >
            <?php endif; ?>
        </div>


        <div class="course__steps">
            <?php foreach ($steps as $step_item): ?>
                <div class="course__step step">
                    <img src="<?= $step_item['step_image']['url'] ?>"
                         alt="<?= $step_item['step_image']['alt'] ?>"
                         width="400"
                         height="400"
                         class="step__illustration"
                    >
                    <div class="step__content">
                        <h3 class="step__title"><?= $step_item['step_title'] ?></h3>
                        <p class="step__description"><?= $step_item['step_text'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</section>

<!---->
<!--Contact-->
<!---->

<div class="contact" id="contact">

    <?php if (!empty($contact_title)): ?>
        <h2 class="contact__title"><?= esc_html($contact_title) ?></h2>
    <?php endif; ?>

    <div class="contact__container">

        <div class="contact" id="contact">
            <?php
            $form_id = (pll_current_language() === 'fr') ? 'b3a27e8' : '64af3ae';
            echo do_shortcode('[contact-form-7 id="' . $form_id . '"]');
            ?>
        </div>

        <div class="contact__sidebar">
            <section class="coordonnee-section">

                <?php if (!empty($my_coordonee_title)): ?>
                    <h3 class="coordonnee-section__title"><?= esc_html($my_coordonee_title) ?></h3>
                <?php endif; ?>

                <?php if (!empty($my_phone_number)): ?>
                    <div class="coordonnee-section__item">
                        <?php if (!empty($my_phone_number_label)): ?>
                            <p class="coordonnee-section__label"><?= esc_html($my_phone_number_label) ?></p>
                        <?php endif; ?>
                        <p class="coordonnee-section__value"><?= esc_html($my_phone_number) ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($my_mail)): ?>
                    <div class="coordonnee-section__item">
                        <?php if (!empty($my_mail_label)): ?>
                            <p class="coordonnee-section__label"><?= esc_html($my_mail_label) ?></p>
                        <?php endif; ?>
                        <p class="coordonnee-section__value"><?= esc_html($my_mail) ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($my_country)): ?>
                    <div class="coordonnee-section__item">
                        <?php if (!empty($my_country_label)): ?>
                            <p class="coordonnee-section__label"><?= esc_html($my_country_label) ?></p>
                        <?php endif; ?>
                        <p class="coordonnee-section__value"><?= esc_html($my_country) ?></p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($contact_image)): ?>
                    <img src="<?= esc_url($contact_image['url']) ?>"
                         alt="<?= esc_attr($contact_image['alt']) ?>"
                         width="400"
                         height="400"
                         class="contact__image"
                    >
                <?php endif; ?>

            </section>
        </div>
    </div>
</div>


<?php get_footer(); ?>

