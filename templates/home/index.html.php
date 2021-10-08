<?php

use Looper\core\services\Router;
?>
<header class="dashboard">
    <section class="container">
        <p><img src="/resources/logo.png" /></p>
        <h1>Exercise<br>Looper</h1>
    </section>
</header>

<div class="container dashboard">
    <section class="row">
        <div class="column">
            <a class="button answering column" href="?page=exercises/answering">Take an exercise</a>
        </div>
        <div class="column">
            <a class="button managing column" href=<?= $router->getUrl("CreateExercise", []) ?>>Create an exercise</a>
        </div>
        <div class="column">
            <a class="button results column" href="?page=exercises">Manage an exercise</a>
        </div>
    </section>
</div>