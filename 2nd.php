<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <div class="wrapper">
      <nav class="row">
        <ul class="header-panel">
          <li><a href="/DB/">First</a></li>
          <li class="active"><a href="/DB/2nd.php">Second</a></li>
          <li><a href="/DB/3rd.php">Third</a></li>
          </ul>
      </nav>

      <div class="full">
          <h1> <u>League of Legends</u></h1>
      <div class="Query5">
        <form class="Query5-form" action="handle.php" method="post">
          <p>Team Name and Sponsor Name whose number of player:
            <input type="text" name="player" value=""></p>
          <button id = "fifth" type="submit" name="query5-submit">send</button>
        </form>
      </div>

      <div class="Query6">
        <form class="Query6-form" action="handle.php" method="post">
          <p>Fetch Player's Name and Role whose Kills are greater than:
            <input type="text" name="kills" value=""></p>
          <button id = "sixth" type="submit" name="query6-submit">send</button>
        </form>
      </div>

      <div class="Query7">
        <form class="Query7-form" action="handle.php" method="post">
          <p>Team Name and Sponsor Name whose number of player:
            <input type="text" name="player" value=""></p>
          <button id = "seventh" type="submit" name="query7-submit">send</button>
        </form>
      </div>

      <div class="Query8">
        <form class="Query8-form" action="handle.php" method="post">
          <p>Display the player name along with their number of mages played <b>==></b>
          <!--  <input type="text" name="skills" value="">--></p>
          <<button id = "eigth" type="submit" name="query8-submit">send</button>
        </form>
      </div>

      <div class="Button1">
        <form action="connection.php" method="post">
          <button id = "insert1" type="submit" name="insert-button">Insert</button>
        </form>
      </div>

      <div>
        <form action="deletion.php" method="post">
          <button id = "delete1" type="submit" name="delete-button">Delete</button>
        </form>
      </div>

      <div>
        <form action="connection.php" method="post">
          <button id = "create1" type="submit" name="create-button">Create</button>
        </form>
      </div>

    </div>
      </div>
  </body>
</html>
