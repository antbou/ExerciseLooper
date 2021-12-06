<header class="heading managing">
    <?php
    include_once('../templates/_header.html.php');
    ?>
    <meta name="csrf-token" content="<?= $_SESSION['token'] ?>">
</header>

<main class="container">
    <table>
        <thead>
            <tr>
                <th>Take</th>
                <?php
                foreach ($exercise->getQuestions() as $question) :
                ?>
                    <th><a href="/exercises/579/results/834"><?= $question->value ?></a></th>
                <?php
                endforeach;
                ?>
            </tr>
        </thead>

        <tbody>
            <?php
            foreach ($exercise->getSeries() as $serie) :
            ?>
                <tr>
                    <td><a href="/exercises/579/fulfillments/380"><?= $serie->date ?> UTC</a></td>
                    <?php
                    foreach ($serie->getResponses() as $response) :
                    ?>
                        <td class="answer">
                            <?php if (strlen($response->value) <= 0) : ?>
                                <i class="fa fa-times empty"></i>
                            <?php elseif (strlen($response->value) <= 9) : ?>
                                <i class="fa fa-check short"></i>
                            <?php elseif (strlen($response->value) >= 10) : ?>
                                <i class="fa fa-check-double filled"></i>
                            <?php endif ?>
                        </td>
                    <?php
                    endforeach;
                    ?>
                </tr>
            <?php
            endforeach;
            ?>
        </tbody>
    </table>

</main>