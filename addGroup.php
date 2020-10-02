
<html>
  <head>
    <meta charset="utf-8" />
    <title>Add group</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/createProject.css">
  </head>

  <body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  	<header class="mdl-layout__header">
  	<div class="mdl-layout__header-row">
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" id = "homeButton" href="home.php">Home</a>
      </nav>
      <div class="mdl-tooltip" data-mdl-for="homeButton">
        Back to home
        </div>
    <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" id="logout" href="">Log out</a>
        <div class="mdl-tooltip" data-mdl-for="logout">
        Log out
        </div>
      </nav>
  	</header>

    <div id = "header">
      <h3>Add Group</h3>
    </div>
    <?php
    if(isset($_GET['error'])){
        if($_GET['error'] == "emptyfields"){
            echo "<p align='center'> Fill in all fields! </p>";
        }
    }
    ?>
    <div class = "content">
    <form action=" " METHOD="POST">
      <!-- Textfield for first and last name with Floating Label -->
      <div>
        <label for="groupName">Group Name:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="groupName" name="groupName">
        </div>
      </div>

      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"  name="cancel">
        Cancel
      </button>
      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent"  name="create">
        Done
      </button>
      </div>
    </div>
    </form>
  </div>
  <!--script-->
  <?php
$ProjectId = intval($_GET['select']);
if(isset($_POST["create"])){
    // connect to db
    require 'script/config.php';

    //list of the variables inputted by the user
    $GroupName = $_POST["groupName"];
    

    if(empty($GroupName)) {
        header("Location: ./addGroup.php?error=emptyfields&groupName=".$GroupName."&select=".$ProjectId);
        //sends the user to the page identified in the header in the html and ensures that the user doesn't need to fill the fields that were filled before
        exit(); //exits the code when the user doesn't fill out all the inputs
    } else {
        $sql = "INSERT INTO teamlist (TeamID, TeamName, ProjectID) VALUES ('','$GroupName','$ProjectId')";
        mysqli_query($db, $sql);
        header("Location: ./projectInfo.php?select=".$ProjectId); //ends the process for creating a new project
        exit(); //exits the code

    }
} elseif(isset($_POST["cancel"])){
    header("Location: ./projectInfo.php?select=".$ProjectId);
    exit();
} 
?>
  </body>
</html>
