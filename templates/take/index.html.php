<header class="heading answering">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>

<main class="container">

    <body>
        <ul class="ansering-list">

            <?php foreach ($exercisesAnswered as $exerciseAnswered) : ?>
                <li class="row">
                    <div class="column card">
                        <div class="title"><?= $exerciseAnswered->title; ?></div>
                        <a class="button" href=<?= $router->getUrl('showAnswer', ['idExercise' => $exerciseAnswered->id]) ?>>Take it</a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>

    </body>


</main>