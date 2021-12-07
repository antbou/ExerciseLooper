<section class="container">
    <a href="<?= $router->getUrl('HomePage', []); ?>"><img src="/resources/logo.png" /></a>
    <?php if (isset($exercise) || isset($title)) : ?>
        <span class="exercise-label">
            <?php if (isset($exercise) && !isset($title)) : ?>
                Exercise:
                <a href="<?= $link ?>">
                    <?= $exercise->getPublicName() ?>
                </a>
            <?php elseif (isset($exercise) && isset($title)) :  ?>
                Exercise:
                <span class="exercise-title"><?= $title ?></span>
            <?php else : ?>
                <?= $title ?>
            <?php endif ?>
        </span>
    <?php endif ?>
</section>