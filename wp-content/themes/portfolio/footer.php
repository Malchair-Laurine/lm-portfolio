<footer class="footer">
    <div class="footer__container">

        <nav class="footer-navigation"> <!-- Navigation homemade -->
            <h2 class="footer-navigation__title sro">Menu de navigation custom</h2>
            <ul class="footer-navigation__list">
                <?php foreach (dw_get_navigation_links('header') as $link) : ?>
                    <li class="footer-navigation__list-item">
                        <a class="footer-navigation__link" href="<?= $link->href ?>"><?= $link->label ?></a>
                    </li>
                <?php endforeach; ?>

        <div class="footer__bottom">

            <p class="footer__copyright">

            </p>
        </div>
    </div>
</footer>
</body>
</html>
