<?php

$insert = false;
// Connecting to the Database
$servername= "localhost";
$username="root";
$password="";
$database="notes";


// Create a connection
$conn= mysqli_connect($servername, $username, $password,$database);

if (! $conn){   // Die if connections isn't successful
    die("Sorry we failed to connect: ". mysqli_connect_error() );
}



if ($_SERVER['REQUEST_METHOD'] == "POST"){
  
  // $sql="INSERT INTO `notes` (`title`,`description`) VALUES (`$title`,`$description`)";  
  $title = $_POST['title'];
  $description= $_POST['description'];
  
  $sql="INSERT INTO `notes` (`title`,`description`) VALUES ('$title','$description')";  
  $result = mysqli_query($conn,$sql);


  if($result){
    // print "The record has been successfully printed";
    $insert = true;
  }
  else{
    print "the record has NOT been successfully printed";
  }



}


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#myTable').DataTable();
      } )
    </script>
    <title>iNotes - Notes Taking Made Easy</title>
  </head>


  <body>
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
    Launch demo modal
  </button>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              ...
              </div>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
              </div>
          </div>
        </div>
    </div>


    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">PHP CRUD</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

      <?php
        if ($insert){
          echo ' 
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Successs! </strong> Your note has been inserted successfully. 
            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div> ';
        }
      ?>



      <div class="container">
          <h2> Add a note </h2>
        <form action="/CRUD/index.php" method="post">
            <div class="form-group">
              <label for="title">Note Title</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
                <label for="description">Note Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
          </form>
      </div>

      <div class="container my-4">
        <table class="table" id="myTable">
          <thead>
            <tr>
              <th scope="col">S. No.</th>
              <th scope="col">Note Title </th>
              <th scope="col">Note Description</th>
              <th scope="col">Handle</th>
            </tr>
          </thead>
          <tbody>
          <?php 
                  $sql="SELECT * FROM `notes`";
                  $result = mysqli_query($conn,$sql);
                  $sno=0;
                  while($row = mysqli_fetch_assoc($result)){
                    $sno = $sno + 1;

                    echo "<tr>
                      <th scope='row'>" . $sno . "</th>
                      <td>" . $row['title'] . "</td>
                      <td>" . $row['description'] . "</td>
                      <td> <a href='/edit'> Edit </a> <a href='/del'> Delete  </a> </td>
                    </tr>";
                  }
            ?>
        
          </tbody>
        </table>


      </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  </body>
</html>

<style>

    .container{
        padding-top: 30px;
    }

</style>











