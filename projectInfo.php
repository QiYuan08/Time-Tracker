<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Project information</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/projectInfo.css">
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
      </nav>
      <div class="mdl-tooltip" data-mdl-for="logout">
        Log out
        </div>
  	</div>
  	</header>
<?php
    require 'script/config.php';
    $ProjectId = intval($_GET['select']);
    //extracting the data from SQLDatabase
    $sql = "SELECT * FROM project WHERE ProjectID='$ProjectId'";
    $result = mysqli_query($db, $sql);
    $resultCheck = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);  // fetch array that consist of data of current row
    $ProjectName = $row["Name"];
    $ProjectCode = $row["unitCode"];
    $StartDate = $row["StartDate"];
    $EndDate = $row["EndDate"];
    $ProjectDesc = $row["Summary"];
    //extracting the teams
    $sql2 = "SELECT * FROM teamlist WHERE ProjectID='$ProjectId'";
    $result2 = mysqli_query($db, $sql2);
    $teamNo = mysqli_num_rows($result2);
    ?>
    <div id = "header">
        <form action="" method="post">
        <h3>Information of this Project
        <button class="material-icons" name="edit" id="edit">edit</button>
        <div class="mdl-tooltip" data-mdl-for="edit">
        Edit project
        </div>
        </form>
      <!--script-->
      <?php 
      if(isset($_POST["edit"])){
          header("Location: ./editProject.php?select=".$ProjectId);
      }?>
      </h3>
    </div>
    <div class = "content">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--6-col">
                <div>
                    <label for="projectTitle">Project Title:</label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="projectTitle">
                    <?php echo $ProjectName; ?> 
                    </div>
                </div>

                <div>
                    <label for="projectDesc">Project Description:</label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="projectDesc">
                    <?php echo $ProjectDesc; ?>
                    </div>
                </div>

                <div>
                    <label for="numTeam">No. of Teams:</label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="numTeam">
                    <?php echo $teamNo; ?>
                    </div>
                </div>

                <div>
                    <label for="projectStartDate">Project Start Date:</label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="startDate"> 
                    <?php echo $StartDate; ?>
                    </div>
                </div>

                <div>
                    <label for="projectDueDate">Project Due Date:</label>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" id="dueDate">
                    <?php echo $EndDate; ?>
                    </div>
                </div>
            </div>

        
            <!-- Textfield for first and last name with Floating Label -->

            <div class="mdl-cell mdl-cell--6-col">
                <h5>List of groups in this project: </h5>
                <form action=" " method="post">
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id = "addGroup" name="addGroup">
                Add Group
                </button>
                <div class="mdl-tooltip" data-mdl-for="addGroup">
                Add new group
                </div>
            </form>
        <?php
        if(isset($_POST["addGroup"])){
           header("Location: ../addGroup.php?select=".$ProjectId);
        }
        ?>
        <!-- Contact Chip -->
        <?php
        require 'script/config.php';

        $sql = "SELECT * FROM teamlist WHERE ProjectID='$ProjectId'";
        $projects = mysqli_query($db, $sql);
        $output = ' ';
        $num = 0;
        while($row = $projects->fetch_assoc()) {
            $num += 1;
            $output .= '<span class="mdl-chip mdl-chip--contact">';
            $output .= '<span class="mdl-chip__contact mdl-color--teal mdl-color-text--white" onclick = "window.location.href="overview.html">';
            $output .= $num;
            $output .=  "</span>";
            $output .= '<span class="mdl-chip__text" id="view" onclick = "window.location.href="overview.html"">';
            $output .= $row["TeamName"];
            $output .= '</span>';
            $output .= "</span>";
            $output .= '<br>';                
        }
        echo $output;
        ?>
       </div>
    </div>
</div>
    
  </body>
</html>
