<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
    <title>Jeux Montessori 0-1 pour les enfants - Des idées de jeux éducatifs pour les tout-petits</title>
    <meta name="description" content="Découvrez les meilleurs jeux Montessori pour les enfants âgés de 0 à 1 an. Des idées de jeux éducatifs pour stimuler leur développement." />
</head>

<body>
    <header>
        <div class="logo">
            <a href="/"><img src="logo.png" alt="Logo" /></a>
        </div>
        <nav>
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="https://storyteed.com/fr/category/education-fr/">Blog</a></li>
            </ul>
        </nav>
        <i class="fas fa-bars"></i>
        <div class="dropdown-menu">
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="https://storyteed.com/fr/category/education-fr/">Blog</a></li>
            </ul>
        </div>
    </header>

    <main>
        <div id="search-box" class="search-container">
            <input id="search-input" type="text" placeholder="Entrer un mot clé..." />
            <button id="search-button">Chercher</button>
        </div>

        <div class="quick-links">
            <span><a title="Activités et Jeux Montessori pour enfants 0-1 an" href="/?s=jeux-montessori-0-1">Jeux Montessori 0 à 1 an</a></span> |
            <span><a title="Activités et Jeux Montessori pour enfants 0-3 ans" href="/?s=jeux-montessori-0-3">Jeux Montessori 0 à 3 ans</a></span> |
            <span><a title="Activités et Jeux Montessori pour enfants 2-4 ans" href="/?s=jeux-montessori-2-4">Jeux Montessori 2 à 4 ans</a></span> |
            <span><a title="Activités et Jeux Montessori pour enfants 2-6 ans" href="/?s=jeux-montessori-2-6">Jeux Montessori 2 à 6 ans</a></span> |
            <span><a title="Activités et Jeux Montessori pour enfants 3-5 ans" href="/?s=jeux-montessori-3-5">Jeux Montessori 3 à 5 ans</a></span> |
            <span><a title="Activités et Jeux Montessori pour enfants 3-7 ans" href="/?s=jeux-montessori-3-7">Jeux Montessori 3 à 7 ans</a></span>
        </div>

        <!-- Create an instance of the DbConnect class -->
        <?php
        // Include DbOperation
        require_once 'DbOperation.php';
        // Include Utils
        require_once 'Utils.php';
        // Create new instance DbOperation
        $db = new DbOperation();

        // Current server url
        $current_url = $_SERVER['REQUEST_URI'];

        if (isset($_GET['s'])) {
            //if (strpos($current_url, '/jeux-montessori-0-1') !== false) {
            // code to run if the URL contains "/jeux-montessori-0-1"
            $games = $db->findGamesByAgeRange(Utils::getLastThreeCharacters($_GET['s']));
        ?>
            <h1>
                Activités & 
                <?php
                echo Utils::add_els_or_ans(Utils::replace_second_last_char(ucwords(str_replace("-", " ", $_GET['s']))));
                ?>
            </h1>
        <?php
        } else {
            // Call the getGames() method -->
            $games = $db->getRandomFeaturedGames();
        ?>
            <h1>Activités & Jeux Montessori</h1>
        <?php
        }

        $quote = $db->getRandomQuote("French");

        ?>

        <!-- Loop through the games data and display it -->

        <table class="montessori-game-list">
            <thead>
                <tr>
                    <th>Name</th>
                    <!--th>Description</th-->
                    <th>Game Type</th>
                    <!--th>Age Range</th-->
                    <th>Skill Developed</th>
                    <!--th>How to Play</th-->
                    <!--th>Materials Needed</th-->
                    <!--th>Difficulty Score</th-->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $game) : ?>
                    <tr>
                        <td><a href="gameDetail.php?id=<?php echo $game['id']; ?>"><?php echo $game['name']; ?></a></td>
                        <!--td><?php echo $game['description']; ?></td-->
                        <td><?php echo $game['game_type']; ?></td>
                        <!--td><?php echo $game['age_range']; ?></td-->
                        <td><?php echo $game['skill_developped']; ?></td>
                        <!--td><?php echo $game['how_to_play']; ?></td-->
                        <!--td><?php echo $game['materials_needed']; ?></td-->
                        <!--td><?php echo $game['difficulty_score']; ?></td-->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>



        <!-- QUOTE -->
        <div id="daily-quote">
            <h2><span class="emoji">💡</span> Clin d'oeil du jour</h2>
            <p id="quote">"<?php echo $quote; ?>"</p>
            <p id="author">- Maria Montessori</p>
        </div>


    </main>


    <footer>
        <p>Jeux Montessori | &copy; 2023 - <a href="https://storyteed.com/fr/category/methode-montessori/">Montessori Blog</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
    <script>
        $(document).ready(function() {
            $("#search-button").click(function(e) {
                e.preventDefault();

                var searchTerm = $("#search-input").val();

                $.ajax({
                    type: "post",
                    url: "search.php",
                    data: {
                        searchTerm: searchTerm
                    },
                    success: function(response) {
                        //var games = JSON.parse(response);

                        // Clear the table
                        $(".montessori-game-list tbody").empty();

                        // Loop through the games data and populate the table
                        response.forEach(function(game) {
                            $(".montessori-game-list tbody").append(
                                "<tr>" +
                                "<td><a href=\"gameDetail.php?id=<?php echo $game['id']; ?>\">" +
                                game.name +
                                "</a></td>" +
                                "<td>" +
                                game.game_type +
                                "</td>" +
                                "<td>" +
                                game.skill_developped +
                                "</td>" +
                                "<td>" +
                                game.difficulty_score +
                                "</td>" +
                                "</tr>"
                            );
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        });
    </script>
</body>

</html>