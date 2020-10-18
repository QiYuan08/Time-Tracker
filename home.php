<?php
    session_start() # get the session variable
?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- styles for project 'cards' using MDL -->
    <style>
        .project > .mdl-card__title,
        .project > .mdl-card__actions,
        .project > .mdl-card__actions > .mdl-button {
            display:flex;
            box-sizing: border-box;
            align-items: center;
            color: #000;
        }
    </style>
  </head>

  <body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  	<header class="mdl-layout__header">
  	    <div class="mdl-layout__header-row">
        <!-- Ttile -->
  	        <span class="mdl-layout-title" >Home</span>
        <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
        <!-- Navigation -->
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="script/logout.php">Log out</a>
        </nav>
  	    </div>
  	</header>

    <main class="mdl-layout__content">
        <div id = "header">
            <br>
            <?php
            if ($_SESSION['type'] == "Teacher"){
                echo '<h2>Choose project to edit / view </h2>';
            } else if ($_SESSION['type'] == "Student"){
                echo '<h2>Choose project to view</h2>';
            }
            ?>
            
            <br>
        </div>
        <div class="page-content">
            <form action="script/projectInfoDis.php" method="get">
                <div class="mdl-grid" id="lockerDisplay">
                    <?php
                    require 'script/config.php';
                    if ($_SESSION['type'] == "Teacher"){
                        $teacherID = $_SESSION['id'];
                        $sql = "SELECT * FROM project WHERE MonashID='$teacherID'";
                        $projects = mysqli_query($db, $sql);
                        $output = ' ';
                        while($row = $projects->fetch_assoc()) {
                            $output .= '<div class="mdl-cell mdl-cell--4-col">';
                            $output .= '<div class="mdl-card mdl-shadow--2dp project">';
                            $output .= '<div class="mdl-card__title mdl-card--expand">';
                            $output .=  "<h3>{$row['unitCode']}</h3>";
                            $output .= "<p> {$row['Name']}</p>";
                            $output .= '</div>';
                            $output .= '<div class="mdl-card__actions mdl-card--border" >';
                            $output .= "<button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' value={$row['ProjectID']} name='select' id='select'>";
                            $output .= 'Select';
                            $output .= '</button>';
                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '</div>';
                        }
                    } else if ($_SESSION['type'] == "Student"){
                        $sql = "SELECT * FROM teammembers WHERE MonashID=".$_SESSION['id']. "";
                        $project = mysqli_query($db, $sql);
                        $output = ' ';
                        while($row = $project->fetch_assoc()) {
                            $projectID = $row['ProjectID'];
                            $sql = "SELECT  * FROM project WHERE ProjectID='$projectID'";
                            $result = mysqli_query($db, $sql);
                            $innerRow = mysqli_fetch_assoc($result);

                            $output .= '<div class="mdl-cell mdl-cell--4-col">';
                            $output .= '<div class="mdl-card mdl-shadow--2dp project">';
                            $output .= '<div class="mdl-card__title mdl-card--expand">';
                            $output .=  "<h3>{$innerRow['unitCode']}</h3>";
                            $output .= "<p> {$innerRow['Name']}</p>";
                            $output .= '</div>';
                            $output .= '<div class="mdl-card__actions mdl-card--border" >';
                            $output .= "<button class='mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect' value={$innerRow['ProjectID']} name='select' id='select'>";
                            $output .= 'Select';
                            $output .= '</button>';
                            $output .= '</div>';
                            $output .= '</div>';
                            $output .= '</div>';
                        } 
                    }
                    echo $output;
                    ?>
                    
                </div>
            </form>
            
        </div>
        <!-- Colored FAB button -->
        <?php
            # show fab button only if user is teacher
            if ($_SESSION['type'] == "Teacher"){
                echo '<button class="mdl-button mdl-js-button mdl-button--fab mdl-button--colored">
                        <a class="material-icons" id="addButton" href = "../createProject.php">add</a>
                      </button>
                      </button>
                      <div class="mdl-tooltip" data-mdl-for="addButton">
                      Add new project
                      </div>';
            }
        ?>
    </main>

    </div>
  </div>
  </body>
</html>
