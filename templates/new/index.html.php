<header class="heading managing">
    <?php
    include_once('../templates/_header.html.php');
    ?>
</header>

<main class="container">

    <body>
        <h1>New Exercise</h1>

        <form action="/exercises" accept-charset="UTF-8" method="post">
            <div class="field">
                <label for="exercise_title">Title</label>
                <input type="text" name="exercise[title]" id="exercise_title" />
            </div>

            <div class="actions">
                <input type="hidden" name="authenticity_token" value="3VCCEDy2nEgIsT3P6pQHzmt/9nZnEDXiD/IJSvOHOJeq4bku+TsLFBz7c+xmwU2D435hgS2l1LDPsP4YMwtMyg==" />
                <input type="submit" name="commit" value="Create Exercise" data-disable-with="Create Exercise" />
            </div>
        </form>

    </body>


</main>