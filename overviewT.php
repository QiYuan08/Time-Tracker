<!DOCTYPE html>
<html>
<head>
  <title>Overview | Teacher</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
  <link rel="stylesheet" href="css/overview.css"> <!-- styles/overview.css -->
  <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="theme-color" content="#ffffff">
</head>

<!-- Header -->
<body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <span class="mdl-layout-title">Monash Time Tracker</span>
        <div class="mdl-layout-spacer"></div>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="">Log out</a>
        </nav>
      </div>
    </header>

<!-- Navigation drawer -->
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Navigation Menu</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="overview.html">Overview</a>
        <a class="mdl-navigation__link" href="visualisation.html">Visualisation</a>
        <a class="mdl-navigation__link" href="issuesNReports.html">Issues and Reports</a>
      </nav>
    </div>

<!-- Project Info -->
<main class="mdl-layout__content">
  <div class="page-content">
    <div class="mdl-grid">
      <div class="mdl-cell mdl-cell--2-col"></div>
      <div class="mdl-cell mdl-cell--8-col">
        <div id="studentSort">
        <!--getting the project information--> 
        <?php
        $teamId = $_GET['teamID'];
        //extracting data from the database 
        require 'script/config.php';
        $sql = "SELECT * FROM teamlist WHERE TeamID='$teamId'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_assoc($result);
        $ProjectId = $row['ProjectID'];

        //extracting project information
        $sql2 = "SELECT * FROM project WHERE ProjectID='$ProjectId'";
        $result2 = mysqli_query($db, $sql2);
        $projectInfo = mysqli_fetch_assoc($result2);

        //extracting team information
        $sql3 = "SELECT * FROM teamlist WHERE TeamID='$teamId'";
        $result3 = mysqli_query($db, $sql3);
        $teamInfo = mysqli_fetch_assoc($result3);

        ?>
          <h1>Project Name: <?php echo $projectInfo['unitCode']." ".$projectInfo['Name']; ?>
          <br>Teacher In Charge: Dr.Ema
          <br>Start Date: <?php echo $projectInfo['StartDate']; ?>
          <br>Due Date: <?php echo $projectInfo['EndDate']; ?>
          <br>
          <br>Team Name: <?php echo $teamInfo['TeamName']; ?>
          <br>Team Members: 
          <form action="" method="post">
          <?php
            $sql4 = "SELECT * FROM teammembers WHERE TeamID='$teamId' ";
            $result4= mysqli_query($db, $sql4);
            $output = ' ';
            if(mysqli_num_rows($result4)== 0){
                $output .= 'No team members in this team';
            } else {
                while($row = $result4->fetch_assoc()) {
                    $output .= '<span class="mdl-chip mdl-chip--contact">';
                    $output .= "<span class='mdl-chip__contact mdl-color--teal mdl-color-text--white material-icons'>";
                    $output .= 'person_outline';
                    $output .=  "</span>";
                    $output .= "<span class='mdl-chip__text'>";
                    $output .= $row["Name"];
                    $output .= '</span>';
                    $output .= "</span>";
                    $output .= "<button class='material-icons' name='delete' id='delete' type='submit' value={$row['MonashID']}>delete</button>";
                    $output .= '<br>';                
                }
            }  
            echo $output;
            ?>
 
           
          </h1>
        </div>
      </div>

<!-- Team Info -->
      <div id = 'outputArea'>
        <table id = "studentOverview" class="mdl-data-table mdl-js-data-table mdl-data-table--2dp">
          <tr>
            <td>Name</td>
            <td>Time Spent</td>
            <td>Progress</td>
            <td>Edit</td>
          </tr>
          <tr>
            <td><div contenteditable>Amy</div></td> <!-- student's name from somewhere -->
            <td><div contenteditable>57 Hours</div></td> <!-- total time from overviewEdit -->
            <td><div contenteditable>100%</div></td> <!-- %tasks ticked from overviewEdit -->
            <td><a href = "overviewEdit.html" target = "_self">Edit</a></td> <!-- or overviewView depending on user, view instead of edit-->
          </tr>
          <tr>
            <td><div contenteditable>Ben</div></td> <!-- loop for student2 -->
            <td><div contenteditable>27 Hours</div></td>
            <td><div contenteditable>1%</div></td>
            <td><a href = "overviewEdit.html" target = "_self">Edit</a></td>
          </tr>
          <tr>
            <td><div contenteditable>Chris</div></td> <!-- loop for student2 -->
            <td><div contenteditable>1 Hours</div></td>
            <td><div contenteditable>69%</div></td>
            <td><a href = "overviewEdit.html" target = "_self">Edit</a></td>
          </tr>
        </table>
      </div>

<!-- Edit Buttons -->
            <div class="mdl-cell mdl-cell--9-col">
              <div id="button1">
                <br>
                <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name='addStudent' >Add Student</button> 
              </div>
              </form>
            </div>
            <!-- code for adding a student-->
            <?php 
            if(isset($_POST['addStudent'])){
                header("Location: ../addStudent.php?teamID=".$_GET['teamID']);
                exit();
            }else if(isset($_POST['delete'])){
               $MonashId = $_POST['delete']; 
               $sql5= "DELETE FROM teammembers WHERE MonashID='$MonashId'";
               $result5= mysqli_query($db, $sql5);
               header("Location: ../overviewT.php?teamID=".$_GET['teamID']);
               exit();
            }?>
            ?>
        </div>
      </div>
    </main>
  </div>
  <!-- <script src="scripts/shared.js" charset="utf-8"></script> -->
  <script src="scripts/overview.js"></script>
</body>
</html>
