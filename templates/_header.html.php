<section class="container">
    <a href="<?= $router->getUrl('HomePage', []); ?>"><img src="/resources/logo.png" /></a>
    <?php if (isset($exercise) || isset($title)) : ?>
        <span class="exercise-label">

            <?php if (isset($exercise)) : ?>
                Exercise:
                <a href="<?= $router->getUrl('CreateQuestion', ['idExercise' => $exercise->id]) ?>">
                    <?= $exercise->getPublicName() ?>
                </a>
            <?php else : ?>
                <?= $title ?>
            <?php endif ?>
        </span>
    <?php endif ?>
</section>