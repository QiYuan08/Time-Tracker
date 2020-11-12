<?php
  require 'script/overviewEdit_script.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Overview-Edit | Student</title>
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
          <a class="mdl-navigation__link" href="overview.php">Return to Overview</a>
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="script/logout.php">Log out</a>
        </nav>
      </div>
    </header>

<!-- Navigation drawer -->
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Navigation Menu</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="home.php">Home</a>
        <a class="mdl-navigation__link" href="overview.php">Overview</a>
        <?php
        if ($_SESSION['type'] == "Student"){
            $studentID = $_SESSION['id'];
            $projectID = $_SESSION['ProjectID'];
            //extracting data from the database
            $sql = "SELECT * FROM teammembers WHERE ProjectID='$projectID' AND MonashID=$studentID";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            $teamID = $row['TeamID'];
            echo "<a class='mdl-navigation__link' href='taskSummary.php?teamID={$teamID}'>Task Summary</a>";
            echo "<a class='mdl-navigation__link' href='issuesNReports.php?teamID=".$teamID."'>Issues and reports</a>"; 
        }
        ?>
      </nav>
    </div>

    <!-- <?php
            echo '<h2>'. $keepeye . '</h2>';
          ?> -->
<!-- Project Info -->
    <main class="mdl-layout__content">
      <div class="page-content">
        <div class="mdl-grid">
          <div class="mdl-cell mdl-cell--2-col"></div>
          <div class="mdl-cell mdl-cell--8-col">
          <?php
            echo $projectInfo;
          ?>
          </div>

<!-- TeamMember Info -->
            <div id = outputArea>
              <table id = "studentOverview" class="mdl-data-table mdl-js-data-table mdl-data-table--2dp">
                <caption>Your Tasks</caption> <!-- or user's name -->
                <tr>
                  <th>Tasks</th> <!-- fontsize is buggy -->
                  <th>Task Description</th>
                  <th>Estimated Time Spent</th>
                  <th>Actual Time Spent (Hours)</th>
                  <th>Completed</th>
                  <th>Delete</th>
                </tr>

                    <?php
                      echo $taskInfo;
                    ?>

              </table>
            </div>

<!-- Edit Buttons -->
          <div class="mdl-cell mdl-cell--9-col">            
           <!-- <h2 id="totalHour">Total hours spent: <?php echo $totalHour; ?> </h2> sums total hours(second column) -->
            <h2 id="totalHour">Total hours spent:  </h2> <!-- sums total hours(second column) -->
            <div id="button1">
              <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="#popup1">Add Task</a>    
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>

  <!-- popup Modal -->
  <div id="popup1" class="overlay">
    <div class="popup">
      <h2 style="text-align:center">Input your task here</h2>
      <a class="close" href="#">&times;</a>
      <div class="content">
      
      <form action="script/addTask.php" method="post">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input name="task" class="mdl-textfield__input" type="text" id="sample3">
            <label class="mdl-textfield__label" for="">Task</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input name="desc" class="mdl-textfield__input" type="text" id="sample3">
            <label class="mdl-textfield__label" for="">Description</label>
          </div>
          <br>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input name="timespent" class="mdl-textfield__input" type="number" id="sample3" min="0">
            <label class="mdl-textfield__label" for="">Estimated time spent</label>
          </div>
          <br>
          <br>
          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name="save">Save</button>
        </form>

      
      </div>
    </div>
  </div>

  <div id="test"></div>

  <!-- script for event listener for time-->
  <script type="text/javascript">

    // add event listener to column in text
    document.querySelectorAll('.time').forEach(item => {
      item.addEventListener("input", function() {
        var id = this.getAttribute('id');
        var time = document.getElementById(id).innerText;
        console.log(id, time);
        to_updateTime(id, time);

      })
    })

    function to_updateTime(taskID, time) {
      var xhttp;
      xhttp = new XMLHttpRequest(); // make a call to the server
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { // when the server return ok
          console.log('Task Updated');
        }
      };
      xhttp.open("POST", "script/updateTime.php?tId="+taskID+"&t="+time, true);
      xhttp.send();   
    }

    // check wif server to update totalHour every second
    setInterval(function(){
      var xhttp;
      xhttp = new XMLHttpRequest(); // make a call to the server
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { // when the server return ok
          document.getElementById('totalHour').innerHTML = "Total time spent: " + this.responseText;
        }
      };
      xhttp.open("POST", "script/updateTime.php", true);
      xhttp.send();  
      
      }, 100);

  </script>

</body>
</html>
