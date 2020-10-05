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
          <a class="mdl-navigation__link" href="script/logout.php">Log out</a>
        </nav>
      </div>
    </header>

<!-- Navigation drawer -->
<div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Navigation Menu</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="overview.php">Overview</a>
        <a class="mdl-navigation__link" href="visualisation.php">Visualisation</a>
        <a class="mdl-navigation__link" href="issuesNReports.html">Issues and Reports</a>
      </nav>
    </div>

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
                <?php
                  echo $caption;
                ?>
                <tr>
                  <th>Tasks</th> <!-- fontsize is buggy -->
                  <th>Time Spent (Hours)</th>
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
            <h2>Total hours spent: <?php echo $totalHour; ?> </h2> <!-- sums total hours(second column) -->
            <div id="button1">
              <button><a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" href="#popup1">Add Task</a></button>                        
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
            <label class="mdl-textfield__label" for="">task</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input name="timespent" class="mdl-textfield__input" type="number" id="sample3" min="0">
            <label class="mdl-textfield__label" for="">Time Spend</label>
          </div>
          <br>
          <label class="mdl-checkbox mdl-js-checkbox mdl-js-ripple-effect" for="checkbox-2">
            <input name="isComplete" type="checkbox" id="checkbox-2" class="mdl-checkbox__input">
            <span class="mdl-checkbox__label">Completed</span>
          </label>
          <br>
          <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored" name="save">Save</button>
        </form>

      
      </div>
    </div>
  </div>

  <div id="test"></div>

  <!-- <script src="scripts/shared.js" charset="utf-8"></script> -->
  <script src="scripts/overview.js"></script>
</body>
</html>
