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
        <li class="active"><a href="/DB/">First</a></li>
        <li><a href="/DB/2nd.php">Second</a></li>
        <li><a href="/DB/3rd.php">Third</a></li>
          </ul>
    </nav>

    <div class="full">
        <h1> <u>League of Legends</u> </h1>

    <div class="Query1">
      <form class="Query1-form" action="handle.php" method="post">
        <p>Give Matches where Gold Advantage is greater than:
          <input type="text" name="gold" value=""></p>
        <button id = "first" type="submit" name="query1-submit">send</button>
      </form>

    </div>

    <div class="Query2">
      <form class="Query2-form" action="handle.php" method="post">
        <p>Display Team1 & Team 2 played on date:
          <input type="text" name="date" value=""></p>
        <button id = "second" type="submit" name="query2-submit">send</button>
      </form>
    </div>


    <div class="Query3">
      <form class="Query3-form" action="handle.php" method="post">
        <p><b><i>Count</i></b> Number of Players who has CS per Min = :
          <input type="text" name="CS" value=""></p>
        <button id = "third" type="submit" name="query3-submit">send</button>
      </form>
    </div>


    <div class="Query4">
      <form class="Query4-form" action="handle.php" method="post">
        <p>Display the players who played number of champions with a range of
        <input type="text" name="c1" value=""> to
        <input type="text" name="c2" value=""></p>
        <button id = "fourth" type="submit" name="query4-submit">send</button>
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

      </form>
    </div>

  </body>
</html>
