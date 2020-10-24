
<html>
  <head>
    <meta charset="utf-8" />
    <title>Edit project</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/editGroup.css">
  </head>

  <body>
  <?php 
    require 'script/config.php';
    $ProjectId= $_GET['select'];
    //extracting the data from SQLDatabase
    $sql = "SELECT * FROM project WHERE ProjectID='$ProjectId'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);  // fetch array that consist of data of current row
   ?>
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
        <a class="mdl-navigation__link" href="script/logout.php">Log out</a>
        <div class="mdl-tooltip" data-mdl-for="logout">
        Log out
        </div>
      </nav>
  	</div>
  	</header>

    <div id = "header">
      <h3>Edit project</h3>
    </div>

    <div class = "content">
    <form action="" method="post">
      <!-- Textfield for first and last name with Floating Label -->
      <div>
        <label for="projectName">Project Name:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" name="projectName" value="<?php echo $row['Name']?>">
        </div>
      </div>

      <div>
        <label for="unitCode">Project Unit Code:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" name="unitCode" value="<?php echo $row['unitCode']?>">
        </div>
      </div>
      <div>
        <label for="projectDesc">Project Description:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" name="projectDesc" value="<?php echo $row['Summary']?>">
        </div>
      </div>
      <div>
        <label for="startDate">Project Start Date:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="date" name="startDate" value="<?php echo $row['StartDate']?>">
      </div>
      <div>
        <label for="dueDate">Project Due Date:</label>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="date" name="dueDate" value="<?php echo $row['EndDate']?>">
        </div>
      </div>

      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"  type="submit" name="cancel">
        Cancel
      </button>
      <!-- Accent-colored raised button -->
      <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent"  type="submit" name="edit">
        Done
      </button>
    
      </div>
    </form>
      <!--script-->
      <?php
      if(isset($_POST['edit'])){
        echo "works";
        $ProjectName = $_POST["projectName"];
        $ProjectCode = $_POST["unitCode"];
        $ProjectDesc = $_POST["projectDesc"];
        $StartDate = $_POST["startDate"];
        $EndDate= $_POST["dueDate"];
        $sql2= "UPDATE project SET Name='$ProjectName', unitCode ='$ProjectCode', StartDate ='$StartDate', EndDate ='$EndDate', Summary ='$ProjectDesc' WHERE `ProjectID`='$ProjectId'";
        mysqli_query($db, $sql2);
        header("Location: ../projectInfo.php?select=".$ProjectId);
      } elseif(isset($_POST['cancel'])){
        header("Location: ../projectInfo.php?select=".$ProjectId);
      }
      ?>
    </div>
  </div>
  </body>
</html>
