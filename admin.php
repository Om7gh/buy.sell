<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Admin</title>
  </head>
  <body style="background: #34343a; font-family: Ubuntu;">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="admin.php">Admin Dashboard</a>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="admin.php">Home</a>
            </li>
            <li class="nav-item">
              <a type="button" class="btn nav-link active" href="create.php">Add Admin</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container my-4">
    <table class="table text-white">
    <thead>
      <tr>
        <th>Id</th>
        <th>Email</th>
        <th>Username</th>
      </tr>
    </thead>
    <tbody>
     <?php
     require_once 'connection.php';

     $sql = 'SELECT * FROM users';
     $result = $conn->query($sql);
     if (!$result) {
        die ("Invalid Data !");
     }

     while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
            <th>$row[id]</th>
            <th>$row[username]</th>
            <th>$row[email]</th>
            

            <td>
            <a class='btn btn-success px-6' href='update.php?id=$row[id]'>Edit</a>
            <a class='btn btn-danger px-6' href='delete.php?id=$row[id]'>Delete</a>
            </td>
            </tr>

            ";
     }
     ?>
    </tbody>
  </table>
      </div>
    
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>