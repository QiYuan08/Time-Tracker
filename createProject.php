
<html>
  <head>
    <meta charset="utf-8" />
    <title>Create project</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-orange.min.css" />
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link rel="stylesheet" href="css/createProject.css">
  </head>
  <body>
	<div class="create">
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
                </nav>
                <div class="mdl-tooltip" data-mdl-for="logout">
                Back to home
                </div>
            </div>
        </header>
        <form action="script/createP.php" method="post" align="center">
            <div id = "header">
                <h3>Create new project</h3>
            </div>
            <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == "emptyfields"){
                    echo "<p> Fill in all fields! </p>";
                }
            }
            ?>

            <!-- Textfield for first and last name with Floating Label -->
            <div>
                <label for="projectName">Project Name:</label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="projectName" name="projectName">
                </div>
            </div>

            <div>
                <label for="unitCode">Project Unit Code:</label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="unitCode" name="unitCode">
                </div>
            </div>

            <div>
                <label for="projectDesc">Project Description:</label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="projectDesc" name="projectDesc">
                </div>
            </div>

            <div>
                <label for="startDate">Project Start Date:</label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="date" id="startDate" name ="startDate" >
                </div>
            </div>

            <div>
                <label for="dueDate">Project Due Date:</label>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="date" id="dueDate" name="dueDate">
                </div>
            </div>

            <!-- Accent-colored raised button -->
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"  name="cancel" type="submit">
                Cancel
            </button>
            <!-- Accent-colored raised button -->
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent" name="create" type ="submit">
                Done
            </button>
        </form>
        </div>
    </div> 
</body>
</html>
