<?php
$terms = get_terms(['project_type']);
$taxonomy = isset($_GET['filter']) ? sanitize_text_field($_GET['filter']) : '';

$args = [
        'post_type' => 'project',
        'post_status' => 'publish',
        'posts_per_page' => 6,
];

if ($taxonomy !== '') {
    $args['tax_query'] = [
        [
            'taxonomy' => 'project_type',
            'field' => 'slug',
            'terms' => $taxonomy,
        ]
    ];
}
$query = new WP_Query($args);

?>

<h1>Mes projets <?= $taxonomy ?></h1>

<div>
    <ul>
        <li>
            <?php foreach ($terms as $term) : ?>
            <a href="/projets?filter=<?= $term->slug ?>">
                <?= $term->name; ?>
            </a>
            <?php endforeach; ?>
            <a href="/projets?filter=web">
                <?= $term->name; ?>
            </a>
            <a href="/projets?filter=mobile">
                <?= $term->name; ?>
            </a>
        </li>
    </ul>
</div>

<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
<section>
    <h2><?= get_the_title() ?></h2>
    <p><?= get_the_excerpt() ?></p>
    <a href="<?= get_the_permalink() ?>" title="Lien vers mon projet" : <?= get_the_title() ?> target="_blank">
        <?= __hepl('Découvrir mon projet'); ?>
    </a>
</section>
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.')?></p>
<?php endif; wp_reset_postdata(); ?>

