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
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      height: 200,
      plugins: 'advlist autolink lists link image charmap print preview anchor',
      toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist outdent indent | link image',
    });
  </script>

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
            $.each(game, function(key, value) {
                $('#' + key).val(value);
            });
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
      <form id="gameForm" class="form-container" action="insert.php" method="post">
      <input type="hidden" id="id" name="id">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required><br><br>
      
      <label for="description">Description:</label>
      <textarea id="description" name="description" required></textarea><br><br>
      
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
      
      <input name="form_action" type="submit" value="Submit">
    </form>
    </div>

    
    <!-- SUBMIT FORM -->
    <div id="loader" style="display:none;">
  <img src="loader.gif" alt="Loading..." />
</div>



    </main>


    <footer>
        <p>Jeux Montessori | &copy; 2023 - <a href="https://storyteed.com/fr/category/methode-montessori/">Montessori Blog</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
  document.getElementById("gameForm").addEventListener("submit", function(event) {
    event.preventDefault();
    showLoader();
    submitForm();
  });

  function submitForm() {
    // collect form data and send it to the server
    // or process the data locally

    // for example:
    const formData = new FormData(document.getElementById("gameForm"));
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "insert.php", true);
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        hideLoader();
        alert('done!');
      }
    };
    xhr.send(formData);
  }

  function showLoader() {
    document.getElementById("loader").style.display = "block";
  }

  function hideLoader() {
    document.getElementById("loader").style.display = "none";
  }
</script>

</body>

</html>