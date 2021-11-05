<section class="container">
    <a href=<?= $router->getUrl('HomePage', []); ?>><img src="/resources/logo.png" /></a>
    <span class="exercise-label"><?= (isset($exercise) ? $exercise->getPublicName() : $title) ?></span>
</section>