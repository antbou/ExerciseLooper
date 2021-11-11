<header class="heading answering">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>

<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>
    <?= var_dump($focusExercise) ?>
    <form action=<?= $router->getUrl('SaveAnswer', ['idExercise' => $focusExercise->getId()]) ?> accept-charset="UTF-8" method="post">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />

        foreach
        <div class=" field">
            <label for="field_label">Label</label>
            <input type="text" name="field[label]" id="field_label" />
        </div>

        <div class="field">
            <label for="field_value_kind">Value kind</label>
            <select name="field[value_kind]" id="field_value_kind">
                <option selected="selected" value="SINGLE_LINE">Single line text</option>
                <option value="SINGLE_LINE_LIST">List of single lines</option>
                <option value="MULTI_LINE">Multi-line text</option>
            </select>
        </div>

        <div class="actions">
            <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field" />
        </div>
    </form>

</main>