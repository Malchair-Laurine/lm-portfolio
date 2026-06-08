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

<section class="skills" id="mes-compétences">
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

    <?php if ($contact_title !== ""): ?>
        <h2 class="contact__title"><?= $contact_title ?></h2>
    <?php endif; ?>


    <?php if (isset($success)) : ?>
        <p class="contact-form__success"><?= $success ?></p>
    <?php endif; ?>

    <?php if (isset($error)) : ?>
        <p class="contact-form__error"><?= $error ?></p>
    <?php endif; ?>

    <?php
    if (isset($_POST['contact_submit'])) {

        // Vérification du nonce (sécurité)
        if (!wp_verify_nonce($_POST['contact_nonce'], 'contact_form')) {
            die('Erreur de sécurité');
        }

        // Récupération et nettoyage des données
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);

        // Validation
        if (empty($name) || empty($email) || empty($message)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!is_email($email)) {
            $error = "L'adresse email n'est pas valide.";
        } else {
            // Envoi de l'email
            $to = get_option('admin_email'); // ou ton email fixe
            $subject = "Nouveau message de contact - $name";
            $body = "Nom : $name\nEmail : $email\n\nMessage :\n$message";
            $headers = [
                    'Content-Type: text/plain; charset=UTF-8',
                    "Reply-To: $email"
            ];

            $sent = wp_mail($to, $subject, $body, $headers);

            if ($sent) {
                $success = "Votre message a bien été envoyé !";
            } else {
                $error = "Une erreur est survenue, veuillez réessayer.";
            }
        }
    }
    ?>

    <div class="contact__container">

        <form class="contact-form" method="POST" action="">
            <?php wp_nonce_field('contact_form', 'contact_nonce'); ?>

            <div class="contact-form__group">
                <label for="name"><?= $name ?></label>
                <input type="text" id="name" name="name" required
                       value="<?= isset($_POST['name']) ? esc_attr($_POST['name']) : '' ?>">
            </div>

            <div class="contact-form__group">
                <label for="email"><?= $email ?></label>
                <input type="email" id="email" name="email" required
                       value="<?= isset($_POST['email']) ? esc_attr($_POST['email']) : '' ?>">
            </div>

            <div class="contact-form__group">
                <label for="phone"><?= $phone_number ?></label>
                <input type="text" id="phone" name="phone" required
                       value="<?= isset($_POST['phone']) ? esc_attr($_POST['phone']) : '' ?>">
            </div>


            <div class="contact-form__group">
                <label for="message"><?= $message ?></label>
                <textarea id="message" name="message"
                          required><?= isset($_POST['message']) ? esc_textarea($_POST['message']) : '' ?></textarea>
            </div>

            <button type="submit" name="contact_submit" class="contact-form__btn">Envoyer</button>
        </form>

        <div class="contact__sidebar">


            <section class="coordonnee-section">


                <?php if ($my_coordonee_title !== ""): ?>
                    <h3 class="coordonnee-section__title"><?= $my_coordonee_title ?></h3>
                <?php endif; ?>

                <div class="coordonnee-section__item">
                <?php if ($my_phone_number_label !== ""): ?>
                    <p class="coordonnee-section__label"><?= $my_phone_number_label ?></p>
                <?php endif; ?>
                <?php if ($my_phone_number !== ""): ?>
                    <p class="coordonnee-section__value"><?= $my_phone_number ?></p>
                <?php endif; ?>
                </div>

                <div class="coordonnee-section__item">
                <?php if ($my_mail_label !== ""): ?>
                    <p class="coordonnee-section__label"><?= $my_mail_label ?></p>
                <?php endif; ?>
                <?php if ($my_mail !== ""): ?>
                    <p class="coordonnee-section__value"><?= $my_mail ?></p>
                <?php endif; ?>
                </div>

                <div class="coordonnee-section__item">
                <?php if ($my_country_label !== ""): ?>
                    <p class="coordonnee-section__label"><?= $my_country_label ?></p>
                <?php endif; ?>
                <?php if ($my_country !== ""): ?>
                    <p class="coordonnee-section__value"><?= $my_country ?></p>
                <?php endif; ?>
                </div>

                <?php if ($contact_image !== ""): ?>
                    <img src="<?= $contact_image ['url'] ?>"
                         alt="<?= $contact_image ['alt'] ?>"
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

