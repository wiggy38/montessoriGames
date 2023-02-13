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

    <style>
      .form-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
      }
      label {
        font-weight: bold;
        margin-top: 20px;
      }
      input[type="text"], textarea {
        width: 300px;
        height: 40px;
        font-size: 16px;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid gray;
        border-radius: 5px;
      }
      textarea {
        height: 100px;
      }
      input[type="submit"] {
        width: 150px;
        height: 40px;
        font-size: 18px;
        margin-top: 20px;
        border: none;
        border-radius: 5px;
        background-color: lightblue;
        color: white;
        cursor: pointer;
      }
    </style>

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
    <div class="form-container">
      <h2>Insert Game Data</h2>
      <form action="insert.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" required><br><br>
        
        <label for="game_type">Game Type:</label>
        <input type="text" id="game_type" name="game_type" required><br><br>
        
        <label for="min_age">Minimum Age:</label>
        <input type="number" id="min_age" name="min_age" required><br><br>
        
        <label for="max_age">Maximum Age:</label>
        <input type="number" id="max_age" name="max_age" required><br><br>
        
        <label for="age_range">Age Range:</label>
        <input type="text" id="age_range" name="age_range" required><br><br>
        
        <label for="skill_developped">Skill Developed:</label>
        <input type="text" id="skill_developped" name="skill_developped" required><br><br>
        
        <label for="how_to_play">How to Play:</label>
        <textarea id="how_to_play" name="how_to_play" required></textarea><br><br>
        
        <label for="materials_needed">Materials Needed:</label>
        <textarea id="materials_needed" name="materials_needed" required></textarea><br><br>
        
        <label for="difficulty_score">Difficulty Score:</label>
        <input type="number" id="difficulty_score" name="difficulty_score" required><br><br>
      </form>
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