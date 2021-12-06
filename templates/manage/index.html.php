<header class="heading results">
    <?php include_once('../templates/_header.html.php'); ?>
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

                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>

        </div>
    </body>
</main>