<section class="container">
    <a href="<?= $router->getUrl('HomePage', []); ?>"><img src="/resources/logo.png" /></a>
    <?php if (isset($exercise) || isset($title)) : ?>
        <span class="exercise-label">
            <?php if (isset($exercise) && !isset($title)) : ?>
                Exercise:
                <a href="<?= $link ?>">
                    <?= htmlspecialchars($exercise->getPublicName()) ?>
                </a>
            <?php elseif (isset($exercise) && isset($title)) :  ?>
                Exercise:
                <span class="exercise-title"><?= htmlspecialchars($title) ?></span>
            <?php else : ?>
                <?= htmlspecialchars($title) ?>
            <?php endif ?>
        </span>
    <?php endif ?>
</section>