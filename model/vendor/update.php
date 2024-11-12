<?php
session_start();
    require_once('../../inc/config/constants.php');
    require_once('../../inc/config/db.php');
    $id = $_GET["id"];

    if (isset($_POST["submitUpdate"])) {
        $vendorDetailsVendorEmail = htmlentities($_POST['vendorDetailsVendorEmail']);
    
        // Construct the UPDATE query
        $updateVendorDetailsSql = 'UPDATE vendor SET email = :email WHERE vendorID = :vendorID';
        $updateVendorDetailsStatement = $conn->prepare($updateVendorDetailsSql);
        $updateVendorDetailsStatement->execute(['email' => $vendorDetailsVendorEmail, 'vendorID' => $id]);

        $time = date('Y-m-d H:i:s');
        $action = "Vendor Info Updated (Vendor)";
        $insertAuditSql = 'INSERT INTO audit(`time`, userID, usertype, userName, Action) VALUES(:time, :userID, :usertype, :userName, :Action)';

        $insertAuditStatement = $conn->prepare($insertAuditSql);
        $insertAuditStatement->execute(['time' => $time, 'userID' => $_SESSION['userid'], 'usertype' => $_SESSION['usertype'], 'userName' => $_SESSION['fullName'], 'Action' => $action]);

        header('Location: ../../index.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>JOST System</title>
</head>

<body>
    <br>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Vendor Details</h3>
      <p class="text-muted">Update Email Info</p>
    </div>

    <?php
        $vendorDetailsSearchSql = 'SELECT * FROM vendor where vendorID = :id LIMIT 1';
        $vendorDetailsSearchStatement = $conn->prepare($vendorDetailsSearchSql);
        $vendorDetailsSearchStatement->execute(['id' => $id]);

        $row = $vendorDetailsSearchStatement->fetch(PDO::FETCH_ASSOC);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Edit email info</label>
            <input placeholder="Email" type="text" class="form-control" name="vendorDetailsVendorEmail" value="<?php echo $row['email']; ?>">
          </div>

          <!--
        <div class="form-group mb-3">
          <label>Status:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="active" value="Active" <?php  ?>>
          <label for="male" class="form-input-label">Active</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="gender" id="disabled" value="disabled" <?php  ?>>
          <label for="female" class="form-input-label">Disabled</label>
        </div>
        -->
        
        <div>
            <br>
          <button type="submit" class="btn btn-success" name="submitUpdate">Update</button>
          <a href="../../index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>