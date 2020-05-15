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
          <li><a href="/DB/2nd.php">Second</a></li>
          <li class="active"><a href="/DB/3rd.php">Third</a></li>
          </ul>
      </nav>
      <div class="full">
          <h1> <u>League of Legends</u></h1>

      <div class="Query9">
        <form class="Query9-form" action="handle.php" method="post">
          <p>Fetch Sum of Player kills along with CS per min & no of wards =:
            <input type="text" name="champ" value=""></p>
          <button id="nineth" type="submit" name="query9-submit">send</button>
        </form>
    </div>

    <div class="Query10">
      <form class="Query10-form" action="handle.php" method="post">
        <p>Display Tournament Name, Match ID & Team Name which was conducted on date =:
          <input type="text" name="tid" value=""></p>
        <button id="tenth" type="submit" name="query10-submit">send</button>
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
  </body>
</html>
