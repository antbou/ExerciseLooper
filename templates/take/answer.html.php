<header class="heading answering">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>

<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>
    <form action=<?= $router->getUrl('SaveAnswer', ['idUser' => $focusExercise->getId()]) ?> accept-charset="UTF-8" method="post">

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

        <?php
        foreach ($focusExercise->getQuestions() as $question) {
        ?>
            <div class=" field">
                <label for="exercise_title"><?= $question->getValue() ?></label>
                <?php
                if ($question->getValueKind() == $questionState::SINGLE_LINE) { ?>
                    <input id="fulfillment_answers_attributes__value" type="text" name="">
                <?php
                } else {
                ?>
                    <textarea name="" id="fulfillment_answers_attributes__value"></textarea>
                <?php
                }
                ?>
                <input type="hidden" name="id" value="<?= $question->getId() ?>">
            </div>
        <?php
        }
        ?>

        <div class="actions">
            <input type="submit" name="commit" value="Save" data-disable-with="Save">
        </div>
    </form>

</main>