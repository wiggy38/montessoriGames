<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        var gameId = getQueryVariable("id");
        console.log(gameId);
        $.ajax({
          type: "GET",
          url: "getGameDetail.php",
          data: { id: gameId },
          dataType: "json",
          success: function(game) {
            $("#name").text(game.name);
            $("#description").text(game.description);
            $("#game_type").text(game.game_type);
            $("#age_range").text(game.age_range);
            $("#skill_developped").text(game.skill_developped);
            $("#how_to_play").text(game.how_to_play);
            $("#materials_needed").text(game.materials_needed);
            $("#difficulty_score").text(game.difficulty_score);
          }
        });

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
    <h1 id="name"></h1>
    <p><strong>Description:</strong></p>
    <p><span id="description"></span></p>
    <p><strong>Game Type:</strong></p>
    <p><span id="game_type"></span></p>
    <p><strong>Age Range:</strong></p>
    <p><span id="age_range"></span></p>
    <p><strong>Skill Developed:</strong></p>
    <p><span id="skill_developped"></span></p>
    <p><strong>How to Play:</strong></p>
    <p><span id="how_to_play"></span></p>
    <p><strong>Materials Needed:</strong></p>
    <p><span id="materials_needed"></span></p>
    <p><strong>Difficulty Score:</strong></p>
    <p><span id="difficulty_score"></span></p>
  </body>
</html>
