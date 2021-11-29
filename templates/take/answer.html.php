<header class="heading answering">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>

<main class="container">
    <h1>Your take</h1>
    <p>If you'd like to come back later to finish, simply submit it with blanks</p>
    <form action=<?= $router->getUrl('SaveAnswer', ['idExercise' => $exercise->id]) ?> accept-charset="UTF-8" method="post">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <?php foreach ($exercise->getQuestions() as $key => $question) : ?>
            <input type="hidden" name="id" value="<?= $question->id ?>">
            <div class=" field">
                <label for="fulfillment_answers_attributes__value"><?= htmlspecialchars($question->value) ?></label>
                <?php if ($question->getState() == $states['SINGLE_LINE']) : ?>
                    <input type="text" name="fulfillment[answers_attributes][question<?= $question->id ?>]" id="fulfillment_answers_attributes__value">
                <?php else : ?>
                    <textarea name="fulfillment[answers_attributes][question<?= $question->id ?>]" id="fulfillment_answers_attributes__value"></textarea>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
        <div class="actions">
            <input type="submit" name="commit" value="Save" data-disable-with="Save">
        </div>
    </form>

</main>