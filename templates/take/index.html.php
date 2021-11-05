<header class="heading answering">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>

<main class="container">

    <body>
        <h1>Take</h1>

        <ul class="ansering-list">
            <?php foreach ($ as $) : ?>
                <li class="row">
                    <div class="column card">
                    <div class="title"><?= $->name ?></div>
                    <a class="button" href="/exercises/<?= $->id ?>/fulfillments/new">
                    </div>
                   
                </li>
            <?php endforeach ?>
        </ul>

    </body>


</main>