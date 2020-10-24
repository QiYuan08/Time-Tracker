<!DOCTYPE html>
<?php require 'script/config.php';
session_start();?>
<?php 
    if(isset($_POST['submit'])) {
        $comment = $_POST['comment'];
        if(!empty($comment)){
             $issueId = $_GET['select'];
            echo "hi";
            $teacherId = $_SESSION['id'];
            $sql4 = "INSERT INTO comment (Comment, IssueId, MonashId, CommentId) VALUES ('$comment','$issueId','$teacherId', '')";
            mysqli_query($db, $sql4);
            header("Location: ./issueDescriptionStudent.php?select=".$issueId); 
            exit(); 
        } 
        
    }?>
<html>
  <head>
    <meta charset="utf-8" />
    <title>Issue description</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/issueDescription.css">
  </head>

  <body>
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  	<header class="mdl-layout__header">
  	<div class="mdl-layout__header-row">
      	<span class="mdl-layout-title" > Issues and report </span>
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

    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Navigation Menu</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="home.php">Home</a>
        <?php 
        $IssueId= intval($_GET['select']);
        $sql6 = "SELECT * FROM issue WHERE IssueId='$IssueId'";
        $result6 = mysqli_query($db, $sql6);
        $row6 = mysqli_fetch_assoc($result6); 
        $teamId = $row6['TeamId'];
        echo "<a class='mdl-navigation__link' href='overview.php?teamID={$teamId}'>Overview</a>"; ?>
        <?php echo "<a class='mdl-navigation__link' href=taskSummary.php>Task Summary</a>"; ?>
        <?php echo "<a class='mdl-navigation__link' href='issuesNReports.php?teamID={$teamId}'>Issues and reports</a>"; ?>
      </nav>
    </div>
    <?php
    
    $IssueId= intval($_GET['select']);
    //extracting the data from SQLDatabase
    $sql = "SELECT * FROM issue WHERE IssueId='$IssueId'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);  // fetch array that consist of data of current row
    $student = $row["MonashId"];
    $title = $row["Title"];
    $Description = $row["Description"];
    //extracting the teams
    $sql2 = "SELECT * FROM user WHERE MonashId='$student'";
    $result2 = mysqli_query($db, $sql2);
    $studentInfo = mysqli_fetch_assoc($result2);
    $studentName =$studentInfo["FullName"];
    ?>
    <div id = "header">
      <h3>Team Issue</h3>
    </div>

    <div class = "content">
      <div class="mdl-grid">
        <div class="mdl-cell mdl-cell--6-col">
          <div>
            <label for="issueTitle">Issue Title:</label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <?php echo $title;?>
            </div>
          </div>

          <div>
            <label for="description">Description:</label>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <?php echo $Description;?>
            </div>
          </div>

        </div>
      <!-- Textfield for first and last name with Floating Label -->

      <div class="mdl-cell mdl-cell--8-col">
      <h5>Comments: </h5>

<ul class="demo-list-three mdl-list">
<?php
    $issueId = $_GET['select'];
    $sql3 = "SELECT * FROM comment WHERE IssueId='$issueId'";
    $result3 = mysqli_query($db, $sql3);
    $output = ' ';
    while($row= $result3->fetch_assoc()) {
        $commenter = $row['MonashId'];
        $sql4 = "SELECT * FROM user WHERE MonashId='$commenter'";
        $result4 = mysqli_query($db, $sql4);
        $commenterInfo = mysqli_fetch_assoc($result4);
        if($commenterInfo['type']== "Student"){
            $name = $commenterInfo['FullName'];
            $output .= '<li class="mdl-list__item mdl-list__item--three-line">';
            $output .= '<span class="mdl-list__item-primary-content">';
            $output .= '<i class="material-icons mdl-list__item-avatar">person</i>';
            $output .= '<p>';
            $output .= $row['Comment'];
            $output .= "</p>";
            $output .= '</span>';
            $output .= '</li>';
        } else {
            $name = $commenterInfo['FullName'];
            $output .= '<li class="mdl-list__item mdl-list__item--three-line">';
            $output .= '<span class="mdl-list__item-primary-content">';
            $output .= '<i class="material-icons mdl-list__item-avatar">person</i>';
            $output .=  "<span>$name</span>";
            $output .= '<p>';
            $output .= $row['Comment'];
            $output .= "</p>";
            $output .= '</span>';
            $output .= '</li>';
        }
        
    }
    echo $output;
    ?>
</ul>
    <form action="" method="post">
      <textarea name="comment" rows="4" cols="120"></textarea>
      <br><br>

      <button id="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" name="submit" ">
        Submit
      </button>
    </form> 

    
      </div>
    </div>
  </div>
  </body>
</html>