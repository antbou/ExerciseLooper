<header class="heading managing">
    <?php
    include_once('../templates/_header.html.php');
    ?>
    <meta name="csrf-token" content="<?= $_SESSION['token'] ?>">
</header>

<main class="container">


    <body>
        <div class="row">
            <section class="column">
                <h1>Fields</h1>
                <table class="records">
                    <thead>
                        <tr>
                            <th>Label</th>
                            <th>Value kind</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($exercise->getQuestions() as $question) : ?>
                            <tr>
                                <td><?= htmlspecialchars($question->getValue()) ?></td>
                                <td><?= htmlspecialchars($question->getState()->getname()) ?></td>
                                <td>
                                    <a title="Edit" href="<?= $router->getUrl('EditQuestion', ['idExercise' => $exercise->getId(), 'idQuestion' => $question->getId()]) ?>"><i class="fa fa-edit"></i></a>

                                    <i class="fa fa-trash link" data-confirm="Are you sure?" data-href="<?= $router->getUrl('DeleteQuestion', ['idExercise' => $exercise->getId(), 'idQuestion' => $question->getId()]) ?>" title="Destroy" rel="nofollow" data-method="delete"></i>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <button class="button status" data-confirm="Are you sure? You won&#39;t be able to further edit this exercise" data-href="<?= $router->getUrl('StatusExercise', ['idExercise' => $exercise->getId(), 'slug' => 'answering']) ?>" data-method="put"><i class="fa fa-comment"></i>Complete and be ready for answers</button>
            </section>
            <section class="column">
                <h1>New Field</h1>
                <form action=<?= $router->getUrl('CreateQuestion', ['idExercise' => $exercise->getId()]) ?> accept-charset="UTF-8" method="post">
                    <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />

                    <div class=" field">
                        <label for="field_label">Label</label>
                        <input type="text" name="field[label]" id="field_label" />
                    </div>

                    <div class="field">
                        <label for="field_value_kind">Value kind</label>
                        <select name="field[value_kind]" id="field_value_kind">
                            <?php foreach ($states as $state) : ?>
                                <option <?= ($state->getSlug() == 'SINGLE_LINE') ? 'selected="selected"' : '' ?> value=<?= $state->getSlug() ?>><?= $state->getName() ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="actions">
                        <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field" />
                    </div>
                </form>
            </section>
        </div>
    </body>
</main>