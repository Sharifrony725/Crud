<?php 
$db = mysqli_connect("localhost" , "root" ,"" ,"crud");
$msg = "";
$name = "";
$email = "";
$btnTxt = "+ADD";
$btnValue  = "addData";
$id = "";
if(isset($_POST['addData'])){
//$myEmail = mysqli_real_escape_string('', '$_POST[email]');

 $myName =  mysqli_real_escape_string($db, $_POST['name']);
 $myEmail = mysqli_real_escape_string($db,  $_POST['gmail']);
 if(empty($myName) || empty($myEmail)){
    $msg = "
<div class=\"alert alert-success\" role=\"alert\">
  Please all inputs!
</div>
";
 }
 else{
    $sql = "INSERT INTO users(name , gmail) VALUES('$myName' , '$myEmail')";
    $run = mysqli_query($db , $sql);
    if($run){
    $msg = "
    <div class=\"alert alert-success\" role=\"alert\">
      Data Submitted.
    </div>
    ";
    }else{
        $msg = "
        <div class=\"alert alert-danger\" role=\"alert\">
          Data Submit failed!
        </div>
        ";
    }
 }

//echo "Email : $myEmail <br/> password : $myPassword ";
// $sql = "INSERT INTO users(name , gmail) VALUES('$myName' , '$myEmail')";
// $run = mysqli_query($db , $sql);
// if($run){
// $msg = "
// <div class=\"alert alert-success\" role=\"alert\">
//   Data Submitted.
// </div>
// ";
// }else{
//     $msg = "
//     <div class=\"alert alert-danger\" role=\"alert\">
//       Data Submit failed!
//     </div>
//     ";
// }
}
if(isset($_POST['edit']))
{
 $id =  $_POST['edit_id'];
 $sql = "SELECT * FROM users WHERE id ='$id' "; 
 $run = mysqli_query($db , $sql);
 $row = mysqli_fetch_assoc($run);
 $name = $row['name'];
 $email = $row['gmail'];
 $btnTxt = "Update";
 $btnValue = "updateData";
}

if(isset($_POST['updateData']))
{
    $id = $_POST['edit_id'];
    $myName =  mysqli_real_escape_string($db, $_POST['name']);
    $myEmail = mysqli_real_escape_string($db,  $_POST['gmail']);
    $sql = "UPDATE users SET name = '$myName' , gmail = '$myEmail' WHERE id = '$id' ";
    $run = mysqli_query($db , $sql);
    if($run){
        $msg = "
            <div class=\"alert alert-success\" role=\"alert\">
              Data Successfully Updated!
            </div>
            ";
    }else{
         echo "failed";
    }
}
if(isset($_POST['delete'])){
$id = $_POST['delete_id'];
$sql = "DELETE FROM users WHERE id = '$id' ";
$run = mysqli_query($db , $sql);
if($run){
    $msg = "
        <div class=\"alert alert-danger\" role=\"alert\">
          Data Deteled Successfully!
        </div>
        ";
}
}

?>
<!DOCTYPE html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Crud</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-4 mt-5">
            <form method="post"  action="crud.php" style="border:1px solid gray; padding: 10px ; border-radius: 5px;">
            <h2 style="text-align: center;">Input Form</h2>
                <?php 
                    echo $msg;
                ?>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="hidden" name="edit_id" value="<?php echo $id ?>">
                    <input type="text" class="form-control"  name="name" value="<?php echo $name?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Gmail</label>
                    <input type="email" class="form-control" name="gmail" value="<?php echo $email ?>">
                </div>

                <!-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> -->
                <button type="submit" class="btn btn-primary" name="<?php echo $btnValue ?>">
                 <?php echo $btnTxt?>
                 </button>
                </form>
            </div>
            <div class="col-lg-8 mt-5">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Gamil</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>

                    <tbody>
                    <?php 
                        $sql = "SELECT * FROM users ";
                        $run = mysqli_query($db , $sql);
                        while($row = mysqli_fetch_assoc($run)){
                            $name = $row['name'];
                            $email = $row['gmail'];
                            $id = $row['id'];
                            echo "
                            <tr>
                            <td>$name</td>
                            <td> $email</td>
                      
                            <td>
                            <form action =\"crud.php\" method = \"post\">

                            <input type = \"hidden\" name  = \"edit_id\" value = \"$id\">
                            <button type=\"submit\" name = \"edit\" class=\"btn btn-primary\">Edit</button>
                            </form>
                            </td>

                            <td>
                            <form action =\"crud.php\" method = \"post\">
                            <input type = \"hidden\" name  = \"delete_id\" value = \"$id\">
                            <button type=\"submit\"  name = \"delete\"class=\"btn btn-danger\">Delete</button>
                            </form>
                            </td>
                            </tr>
                            ";
                        }
                    ?>
                    </tbody>


                <!-- 
                    <tr>
                    <td>Mark</td>
                    <td>mark@gmail.com</td>
                    <td><button type="submit" class="btn btn-primary">Edit</button></td>
                    <td><button type="submit" class="btn btn-danger">Edit</button></td>
                    </tr>
                
                
</table>
            
            </div>
        </div>
    </div>



    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" >
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
  </body>
</html>   