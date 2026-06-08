<footer class="footer">
    <div class="footer__container">

        <nav class="footer__navigation"> <!-- Navigation homemade -->
            <h2 class="footer__navigation__title">Navigation</h2>
            <ul class="footer__navigation__list">
                <?php foreach (dw_get_navigation_links('header') as $link) : ?>
                    <li class="footer__navigation__list-item">
                        <a class="footer__navigation__link" href="<?= $link->href ?>"><?= $link->label ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>


                <div class="footer__socials">
                    <h2 class="footer__socials__title">Suivez-moi</h2>
                    <ul class="footer__socials__list">
                        <li class="footer__socials__list-item">
                            <a class="footer__socials__link" href="https://github.com/..." target="_blank">Github</a>
                        </li>
                        <li class="footer__socials__list-item">
                            <a class="footer__socials__link" href="https://instagram.com/..."
                               target="_blank">Instagram</a>
                        </li>
                    </ul>
                </div>
    </div>

    <div class="footer__bottom">
        <p class="footer__copyright"></p>
    </div>
</footer>
</body>
</html>
