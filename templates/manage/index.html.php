<header class="heading results">
    <?php include_once('../templates/_header.html.php'); ?>
    <meta name="csrf-token" content="<?= $_SESSION['token'] ?>">
</header>
<main class="container">

    <body>
        <div class="row">
            <section class="column">
                <h1>Building</h1>
                <table class="records">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($buildedExercises as $buildedExercise) : ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($buildedExercise->title) ?>
                                </td>
                                <td>
                                    <?php if (count($buildedExercise->getQuestions()) >= 1) : ?>
                                        <i class="fa fa-comment link ajax" title="Be ready for answers" rel="nofollow" data-href="<?= $router->getUrl('StatusExercise', ['idExercise' => $buildedExercise->id, 'slug' => 'ANSW']) ?>" data-method="put"></i>
                                    <?php endif; ?>
                                    <a title="Edit" href="<?= $router->getUrl('CreateQuestion', ['idExercise' => $buildedExercise->id]) ?>"><i class="fa fa-edit"></i></a>
                                    <i class="fa fa-trash link ajax" data-confirm="Are you sure?" data-href="<?= $router->getUrl('DeleteExercise', ['idExercise' => $buildedExercise->id]) ?>" title="Destroy" rel="nofollow" data-method="delete"></i>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>
            <section class="column">
                <h1>Answering</h1>
                <table class="records">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($answeredExercises as $answeredExercise) : ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($answeredExercise->title) ?>
                                </td>
                                <td>
                                    <a title="Show Result" href="<?= $router->getUrl('ResultExercise', ['idExercise' => $answeredExercise->id]) ?>"><i class="fa fa-chart-bar"></i></a>
                                    <i class="fa fa-minus-circle link ajax" title="Close" data-href="<?= $router->getUrl('StatusExercise', ['idExercise' => $answeredExercise->id, 'slug' => 'TERM']) ?>" data-method="put"></i>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>
            <section class="column">
                <h1>Closed</h1>
                <table class="records">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($closedExercises as $closedExercise) : ?>
                            <tr>
                                <td>
                                    <?= htmlspecialchars($closedExercise->title) ?>
                                </td>
                                <td>
                                    <a title="Show Result" href="<?= $router->getUrl('ResultExercise', ['idExercise' => $closedExercise->id]) ?>"><i class="fa fa-chart-bar"></i></a>
                                    <i class="fa fa-trash link ajax" data-confirm="Are you sure?" data-href="<?= $router->getUrl('DeleteExercise', ['idExercise' => $closedExercise->id]) ?>" title="Destroy" rel="nofollow" data-method="delete"></i>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>

        </div>
    </body>
</main>