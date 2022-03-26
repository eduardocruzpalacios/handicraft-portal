<?php

$connection = mysqli_connect("localhost", "root", "", "handicraft");

if (!$connection) {
  die('Connection error');
}

// USERS

function login($id, $password)
{
  global $connection;

  $query = "SELECT id FROM users WHERE
    users.id = '$id' AND users.password = '$password'";

  $result = mysqli_query($connection, $query);

  if (mysqli_fetch_row($result)) {
    return true;
  } else {
    return false;
  }
}

function userIdExists($id)
{
  global $connection;

  $query = "SELECT id FROM users WHERE users.id = '$id'";

  $result = mysqli_query($connection, $query);

  if (mysqli_fetch_row($result)) {
    return true;
  } else {
    return false;
  }
}

function userEmailExists($email)
{
  global $connection;

  $query = "SELECT email FROM users WHERE users.email = '$email'";

  $result = mysqli_query($connection, $query);

  if (mysqli_fetch_row($result)) {
    return true;
  } else {
    return false;
  }
}

function createUser($id, $email, $password)
{
  global $connection;

  $query = "INSERT INTO users (id, email, password) VALUES (?, ?, ?)";

  $stmt = $connection->prepare($query);

  $stmt->bind_param('sss', $id, $email, $password);

  $result = $stmt->execute();

  if ($result) {
    return true;
  } else {
    return false;
  }
}

// HANDICRAFT
function readAllHandicraft()
{
  global $connection;

  $query = "SELECT * FROM handicraft";

  $result = mysqli_query($connection, $query);

  if ($result) {
    return $result;
  } else {
    return false;
  }
}

function readHandicraftByUserid($userid)
{
  global $connection;

  $query = "SELECT * FROM handicraft WHERE userid LIKE '$userid'";

  $result = mysqli_query($connection, $query);

  if ($result) {
    return $result;
  } else {
    return false;
  }
}

function readHandicraftById($id)
{
  global $connection;

  $query = "SELECT * FROM handicraft WHERE id LIKE '$id'";

  $result = mysqli_query($connection, $query);

  if ($result) {
    return $result;
  } else {
    return false;
  }
}

function createHandicraft($dateupload, $userid, $title, $description, $fragile, $weight, $imgname)
{
  global $connection;

  $query = "INSERT INTO handicraft (dateupload, userid, title, description, fragile, weight, imgname) VALUES (?, ?, ?,?, ?, ?, ?)";

  $stmt = $connection->prepare($query);

  $stmt->bind_param('ssssiis', $dateupload, $userid, $title, $description, $fragile, $weight, $imgname);

  $result = $stmt->execute();

  if ($result) {
    return true;
  } else {
    return false;
  }
}

function deleteHandicraft($id)
{
  global $connection;

  $query = "DELETE FROM handicraft WHERE id = ?";

  $stmt = $connection->prepare($query);

  $stmt->bind_param('s', $id);

  $result = $stmt->execute();

  if ($result) {
    return true;
  } else {
    return false;
  }
}

function updateHandicraftNoImg($id, $title, $description, $fragile, $weight)
{
  global $connection;

  $query = "UPDATE handicraft SET title = ?, description = ?, fragile = ?, weight = ? WHERE id = ?";

  $stmt = $connection->prepare($query);

  $stmt->bind_param('ssiii', $title, $description, $fragile, $weight, $id);

  $result = $stmt->execute();

  if ($result) {
    return true;
  } else {
    return false;
  }
}

function updateHandicraft($id, $title, $description, $fragile, $weight, $imgname)
{
  global $connection;

  $query = "UPDATE handicraft SET title = ?, description = ?, fragile = ?, weight = ?, imgname = ? WHERE id = ?";

  $stmt = $connection->prepare($query);

  $stmt->bind_param('ssiisi', $title, $description, $fragile, $weight, $imgname, $id);

  $result = $stmt->execute();

  if ($result) {
    return true;
  } else {
    return false;
  }
}

?>