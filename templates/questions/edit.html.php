<header class="heading managing">
    <?php
    include_once('../templates/_header.html.php');
    ?>
    <meta name="csrf-token" content="<?= $_SESSION['token'] ?>">
</header>

<main class="container">
    <h1>Editing Field</h1>
    <form action=<?= $router->getUrl('EditQuestion', ['idExercise' => $exercise->getId(), 'idQuestion' => $question->getId()]) ?> accept-charset="UTF-8" method="post">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
        <div class=" field">
            <label for="field_label">Label</label>
            <input type="text" name="field[label]" id="field_label" value="<?= $question->getValue() ?>" />
        </div>
        <div class="field">
            <label for="field_value_kind">Value kind</label>
            <select name="field[value_kind]" id="field_value_kind">
                <?php foreach ($states as $state) : ?>
                    <option <?= ($question->getState() == $state) ? 'selected="selected"' : '' ?> value=<?= $state->getSlug() ?>><?= $state->getName() ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="actions">
            <input type="submit" name="commit" value="Update Field" data-disable-with="Update Field" />
        </div>
    </form>
</main>