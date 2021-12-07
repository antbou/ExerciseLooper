<header class="heading results">
    <?php
    $title = $exercise->title;
    include_once('../templates/_header.html.php');
    ?>
</header>
<main class="container">
    <h1><?= $serie->date ?></h1>
    <dl class="answer">
        <?php foreach ($serie->getResponses() as $key => $response) : ?>
            <dt><?= htmlspecialchars($response->getQuestion()->value) ?></dt>
            <dd><?= htmlspecialchars($response->value) ?></dd>
        <?php endforeach; ?>

    </dl>
</main>