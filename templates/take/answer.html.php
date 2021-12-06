<header class="heading answering">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>

<main class="container">
    <h1>Your take</h1>
    <?php if (isset($edit)) : ?>
        <p>Bookmark this page, it's yours. You'll be able to come back later to finish.</p>
    <?php else : ?>
        <p>If you'd like to come back later to finish, simply submit it with blanks</p>
    <?php endif; ?>
    <form action=<?= $route ?> accept-charset="UTF-8" method="post">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <?php if (isset($edit)) : ?>
            <?php foreach ($serie->getResponses() as $key => $response) : ?>
                <div class=" field">
                    <label for="fulfillment_answers_attributes__value"><?= htmlspecialchars($response->getQuestion()->value) ?></label>
                    <?php if ($response->getQuestion()->getState() == $states['SINGLE_LINE']) : ?>
                        <input value="<?= htmlspecialchars($response->value) ?>" type="text" name="fulfillment[answers_attributes][response<?= $response->id ?>]" id="fulfillment_answers_attributes__value">
                    <?php else : ?>
                        <textarea name="fulfillment[answers_attributes][response<?= $response->id ?>]" id="fulfillment_answers_attributes__value"><?= htmlspecialchars($response->value) ?></textarea>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <?php foreach ($exercise->getQuestions() as $key => $question) : ?>
                <div class=" field">
                    <label for="fulfillment_answers_attributes__value"><?= htmlspecialchars($question->value) ?></label>
                    <?php if ($question->getState() == $states['SINGLE_LINE']) : ?>
                        <input type="text" name="fulfillment[answers_attributes][question<?= $question->id ?>]" id="fulfillment_answers_attributes__value">
                    <?php else : ?>
                        <textarea name="fulfillment[answers_attributes][question<?= $question->id ?>]" id="fulfillment_answers_attributes__value"></textarea>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="actions">
            <input type="submit" name="commit" value="Save" data-disable-with="Save">
        </div>
    </form>

</main>