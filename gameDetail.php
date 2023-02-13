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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      var gameId = getQueryVariable("id");

      $.ajax({
        type: "get",
        url: "getGameDetail.php",
        data: {
          id: gameId
        },

        success: function(game) {
          $("#name").text(game.name);
          $("#description").text(game.description);
          $("#game_type").text(game.game_type);
          $("#age_range").text(game.age_range);
          $("#skill_developped").text(game.skill_developped);
          $("#how_to_play").text(game.how_to_play);
          $("#materials_needed").text(game.materials_needed);
          //$("#difficulty_score").text(game.difficulty_score);
          score(game.difficulty_score);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status);
          alert(thrownError);
        }


      });

      function score(value) {
        
    var difficultyScore = value; // replace with actual score
    var maxDifficulty = 10; // replace with maximum possible score
    //document.getElementById("difficulty_score").innerHTML = difficultyScore;
    document.getElementById("bar").style.width = (difficultyScore / maxDifficulty * 100) + "%";
      }

      function getQueryVariable(variable) {
        var query = window.location.search.substring(1);
        var vars = query.split("&");
        for (var i = 0; i < vars.length; i++) {
          var pair = vars[i].split("=");
          console.log(pair[1]);
          if (pair[0] == variable) {
            return pair[1];
          }
        }
        return false;
      }
    });
  </script>
</head>

<body>
  <header>
    <div class="logo">
      <img src="logo.png" alt="Logo" />
    </div>
    <nav>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Contacts</a></li>
      </ul>
    </nav>
    <i class="fas fa-bars"></i>
    <div class="dropdown-menu">
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="#">Contacts</a></li>
      </ul>
    </div>
  </header>

  <main>
    
  <style>
  .gamedetails {
    width: 80%;
    margin: 0 auto;
    text-align: left;
  }
  
  h3 {
    font-size: 20px;
    font-weight: bold;
    margin-top: 30px;
  }
  
  span {
    font-size: 18px;
  }
  
  strong {
    font-size: 16px;
    margin-top: 20px;
  }
</style>
<div class="gamedetails">
  <h1 id="name"></h1>
  <h3>Description:</h3>
  <p><span id="description"></span></p>
  <h3>Game Type:</h3>
  <p><span id="game_type"></span></p>
  <h3>Age Range:</h3>
  <p><span id="age_range"></span></p>
  <h3>Skill Developed:</h3>
  <p><span id="skill_developped"></span></p>
  <h3>How to Play:</h3>
  <p><span id="how_to_play"></span></p>
  <h3>Materials Needed:</h3>
  <p><span id="materials_needed"></span></p>
  <h3>Difficulty Score:</h3>
  <!--p><span id="difficulty_score"></span></p-->
  <div id="difficulty_score"></div>
  <div class="bar-chart">
    <div class="bar" id="bar"></div>
  </div>
</div>

  </main>


  <footer>
    <p>&copy; Jeux Montessori 2023</p>
  </footer>

</body>

</html>