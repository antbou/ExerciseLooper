<header class="heading results">
    <?php include_once('../templates/_header.html.php'); ?>
    <meta name="csrf-token" content="<?= $_SESSION['token'] ?>">
</header>
<main class="container">

    <body>
        <div class="row">
            <section class="column">
                <h1></h1>
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
                                    <?= $buildedExercise->title ?>
                                </td>
                                <td>
                                    <?php
                                    if (count($buildedExercise->getQuestions()) >= 1) {
                                    ?>
                                        <i class="fa fa-comment status link" data-confirm="Are you sure? You won&#39;t be able to further edit this exercise" data-href="<?= $router->getUrl('StatusExercise', ['idExercise' => $buildedExercise->id, 'slug' => 'answering']) ?>" data-method="put"></i>
                                    <?php
                                    }
                                    ?>
                                    <i></i>
                                    <a title="Edit" href="<?= $router->getUrl('EditExercise', ['idExercise' => $buildedExercise->id]) ?>"><i class="fa fa-edit"></i></a>
                                    <i class="fa fa-trash link" data-confirm="Are you sure?" data-href="<?= $router->getUrl('DeleteExercise', ['idExercise' => $buildedExercise->id]) ?>" title="Destroy" rel="nofollow" data-method="delete"></i>

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>
            <section class="column">
                <h1></h1>
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
                                    <?= $answeredExercise->title ?>
                                </td>
                                <td>
                                    <a title="Show Result" href="<?= $router->getUrl('ResultExercise', ['idExercise' => $answeredExercise->id]) ?>"><i class="fa fa-chart-bar"></i></a>
                                    <i class="fa fa-minus-circle link" data-href=" <?= $router->getUrl('ClosedExercise', ['idExercise' => $answeredExercise->id]) ?>"></i>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>
            <section class="column">
                <h1></h1>
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
                                    <?= $closedExercise->title ?>
                                </td>
                                <td>
                                    <a title="Show Result" href="<?= $router->getUrl('ResultExercise', ['idExercise' => $closedExercise->id]) ?>"><i class="fa fa-chart-bar"></i></a>
                                    <i class="fa fa-trash link" data-confirm="Are you sure?" data-href="<?= $router->getUrl('DeleteExercise', ['idExercise' => $closedExercise->id]) ?>" title="Destroy" rel="nofollow" data-method="delete"></i>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>

        </div>
    </body>
</main>