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
$skills_text_1 = get_field('skills_text_1');
$skills_text_2 = get_field('skills_text_2');
$skills_text_3 = get_field('skills_text_3');
$skills_text_4 = get_field('skills_text_4');


//projects
$projects_main_title = get_field('projects_main_title');
$filter = get_field('filter');
$filter_query = $_GET['filter'] ?? 'Tous';

//course
$course_title = get_field('course_title');
$steps = get_field('steps');

//contact
$contact_title = get_field('contact_title');
$contact_image = get_field('contact_image');
?>

<div class="typemachine">
    <?php if ($typemachine_text !== ""): ?>
        <p class="typemachine__text"><?= $typemachine_text ?></p>
    <?php endif; ?>
</div>

<div class="header">
    <?php if ($main_title !== ""): ?>
        <h1 class="header__title"><?= $main_title ?></h1>
    <?php endif; ?>

    <?php if ($subtitle !== ""): ?>
        <h2 class="header__subtitle"><?= $subtitle ?></h2>
    <?php endif; ?>
</div>

<div class="about-me">
    <?php if ($description_title !== ""): ?>
        <h2 class="about-me__h2"><?= $description_title ?></h2>
    <?php endif; ?>

    <?php if ($description_text !== ""): ?>
        <p class="about-me__text"><?= $description_text ?></p>
    <?php endif; ?>

    <?php if ($sitting_cartoon): ?>
        <img src="<?= $sitting_cartoon ['url'] ?>"
             alt="<?= $sitting_cartoon ['alt'] ?>"
             width="400"
             height="400"
             class="about-me__cartoon1"
        >
    <?php endif; ?>

    <?php if ($cat_cartoon !== ""): ?>
        <img src="<?= $cat_cartoon ['url'] ?>"
             alt="<?= $cat_cartoon ['alt'] ?>"
             width="400"
             height="400"
             class="about-me__cartoon2"
        >

    <?php endif ?>

</div>

<div class="skills">
    <?php if ($skills_title !== ""): ?>
        <p class="skills__title"><?= $skills_title ?></p>
    <?php endif; ?>

    <?php if ($skills_library): ?>
        <img src="<?= $skills_library ['url'] ?>"
             alt="<?= $skills_library ['alt'] ?>"
             width="400"
             height="400"
             class="skills__library"
        >
    <?php endif; ?>

</div>


<div class="projects" id="mes-projets">

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

    <div>
        <ul>
            <li>
                <?php foreach ($terms as $term) : ?>
                    <a href="/?filter=<?= $term->slug ?>#mes-projets" class="projects__filter">
                        <?= $term->name; ?>
                    </a>
                <?php endforeach; ?>
            </li>
        </ul>
    </div>

    <?php foreach ($filter as $filter_item): ?>
        <?php if (strtolower($filter_query) === strtolower($filter_item['filter_name'])): ?>
            <div class="filter">
                <img src="<?= $filter_item['filter_image']['url'] ?>"
                     alt="<?= $filter_item['filter_image']['alt'] ?>"
                     width="400"
                     height="400"
                     class="filter__image"
                >
            </div>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
        <?php
        $project_title = get_field('project_title');
        $project_book = get_field('project_book');
        $project_image = get_field('project_image');
        ?>
        <?php if ($project_title !== "" && $project_image !== "" && $project_book !== ""): ?>
            <section class="project">
                <div class="project__content">
                    <h2><?= $project_title ?></h2>
                    <img src="<?= $project_book['url'] ?>"
                         alt="<?= $project_book['alt'] ?>"
                         width="400"
                         height="400"
                         class="project__image-svg"
                    >
                    <img src="<?= $project_image['url'] ?>"
                         alt="<?= $project_image['alt'] ?>"
                         width="400"
                         height="400"
                         class="project__image"
                    >
                </div>
                <a class="project__link" href="<?= get_the_permalink() ?>" title="Lien vers mon projet"
                   : <?= get_the_title() ?> target="_blank">
                    Découvrir mon projet
                </a>
            </section>
        <?php endif; ?>
    <?php endwhile; else: ?>
        <p><?php _e('Sorry, no posts matched your criteria.') ?></p>
    <?php endif;
    wp_reset_postdata(); ?>

</div>


<div class="course">
    <?php if ($course_title !== ""): ?>
        <h2 class="course__title"><?= $course_title ?></h2>
    <?php endif; ?>

    <?php foreach ($steps as $step_item): ?>
        <div class="steps">
            <h3 class="steps__title"><?= $step_item['step_title'] ?></h3>
            <p class="step__text"><?= $step_item['step_text'] ?></p>
            <img src="<?= $step_item['step_image']['url'] ?>"
                 alt="<?= $step_item['step_image']['alt'] ?>"
                 width="400"
                 height="400"
                 class="steps__image"
            >
        </div>
    <?php endforeach; ?>
</div>

<div class="contact">

    <?php if ($contact_title !== ""): ?>
        <h2 class="contact__title"><?= $contact_title ?></h2>
    <?php endif; ?>

    <?php if ($contact_image !== ""): ?>
        <img src="<?= $contact_image ['url'] ?>"
             alt="<?= $contact_image ['alt'] ?>"
             width="400"
             height="400"
             class="contact__image"
        >
    <?php endif; ?>



</div>


<?php get_footer(); ?>
