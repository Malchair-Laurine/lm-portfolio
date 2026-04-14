<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= get_the_title() ?> portfolio></title>
    <link rel="stylesheet" type="text/css" href="<?= dw_asset('css'); ?>">
    <script src="<?= dw_asset('js') ?>" defer></script>
</head>
<body>
<h1 class="sro"><?= get_the_title() ?></h1>
<!--<nav>  Menu de navigation par Wordpress
  <h2 class="sro">Menu de navigation</h2>
  wp_nav_menu([
          'theme_location' => 'header',
          'container' => false,
          'menu_class' => 'ul-container',
          'container_class' => 'div-container',
  ]);

</nav> -->

<nav class="navigation"> <!-- Navigation homemade -->
    <h2 class="navigation__title sro">Menu de navigation custom</h2>
    <ul class="navigation__list">
        <?php foreach (dw_get_navigation_links('header') as $link) : ?>
            <li class="navigation__list-item">
                <a class="navigation__link" href="<?= $link->href ?>"><?= $link->label ?></a>
            </li>
        <?php endforeach; ?>

        <?php foreach (pll_the_languages(['raw' => true]) as $lang): ?>
            <li class="navigation__list-item-language <?= $lang['current_lang'] ? 'navigation__list-item-language--active' : '' ?>">
                <a class="navigation__link-language" lang="<?= $lang['locale'] ?>" hreflang="<?= $lang['locale'] ?>"
                   href="<?= $lang['url'] ?>"><?= strtoupper($lang['slug']) ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

