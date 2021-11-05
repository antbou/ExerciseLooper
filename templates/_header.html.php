<section class="container">
    <a href="<?= $router->getUrl('HomePage', []); ?>"><img src="/resources/logo.png" /></a>
    <span class="exercise-label">

        <?php if (isset($exercise)) : ?>
            Exercise:
            <a href="<?= $router->getUrl('CreateQuestion', ['idExercise' => $exercise->getId()]) ?>">
                <?= $exercise->getPublicName() ?>
            </a>
        <?php else : ?>
            <?= $title ?>
        <?php endif ?>
    </span>
</section>