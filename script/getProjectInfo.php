<?php

require 'config.php';
session_start();

$projectInfo = ""; # string to echo projectInfo header
$teamInfo = "";    # string to echo teamInfo table
$id = $_SESSION['id'];
$projectId = $_SESSION['ProjectID'];
$teamId = NULL;
$teamMembers = []; # array to store id for each team members
$keepeye = "";

# get info for this project from project table cuz already has the projectId in the url from home.php
$sql = "SELECT * FROM project WHERE ProjectID='$projectId'";
$result = mysqli_query($db, $sql);
$project_row = mysqli_fetch_array($result);

# getting user teamID for this project from teammembers table
$sql = "SELECT * FROM teammembers WHERE MonashId='$id' AND ProjectID='$projectId'";
$result = mysqli_query($db, $sql);
$member_row = mysqli_fetch_assoc($result);
$teamId = $member_row['TeamID'];
$keepeye .= $teamId .", ";
$keepeye .= $projectId .", ";

# getting team name from teamList table
$sql = "SELECT * FROM teamlist WHERE TeamID='$teamId' AND ProjectID='$projectId'";
$result = mysqli_query($db, $sql);
$team_row = mysqli_fetch_assoc($result);

# displaying project info
# there should be already be a project for user to enter here
# so checking for null project is skipped
$projectInfo = '<div id="studentSort">
                    <h1>Project Name : ' . $project_row['Name'].
                    '<br>Start Date : '. $project_row['StartDate'].
                    '<br>Due Date : ' . $project_row['EndDate'].
                    '<br>
                    <br>Team Name : '. $team_row['TeamName'].
                    '</h1>
                </div>';