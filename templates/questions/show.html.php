<header class="heading results">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>
<main class="container">
    <h1><?= $question->value ?></h1>
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <th>Content</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($question->getResponses() as $response) : ?>
                <tr>
                    <td>
                        <a href="<?= $router->getUrl('ShowSeriesAnswer', ['idExercise' => $exercise->id, 'idSerie' => $response->getSerie()->id]) ?>"><?= htmlspecialchars($response->getSerie()->date) ?> UTC</a>
                    </td>
                    <td><?= htmlspecialchars($response->value) ?></td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>

</main>