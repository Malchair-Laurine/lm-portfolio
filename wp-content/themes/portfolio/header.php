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

<!-- Navigation homemade -->
<header class="main-header">
    <nav class="navigation">
        <h2 class="navigation__title sro">Menu de navigation custom</h2>

        <button class="navigation__burger" aria-label="Ouvrir le menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

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
</header>
<h1 class="sro"><?= get_the_title() ?></h1>

