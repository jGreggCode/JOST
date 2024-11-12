<?php
    session_start();
    require_once('../../inc/config/constants.php');
    require_once('../../inc/config/db.php');
    $id = $_GET["id"];

    if (isset($_POST["submitUpdate"])) {
        $fullName = htmlentities($_POST['userDetailsUserFullName']);
        $username = htmlentities($_POST['userDetailsUserUsername']);
        $mobile = htmlentities($_POST['userDetailsUserMobile']);
        $location = htmlentities($_POST['userDetailsUserLocation']);
        $email = htmlentities($_POST['userDetailsUserEmail']);

        if ($_GET['ACTION'] === 'ADMIN') {
            $position = htmlentities($_POST['userDetailsUserPosition']);
            $status = htmlentities($_POST['userDetailsUserStatus']);
            $updateVendorDetailsSql = 'UPDATE user SET fullName = :fullName, usertype = :usertype, username = :username, email = :email, status = :status, mobile = :mobile, location = :location  WHERE userID = :userID';
            $updateVendorDetailsStatement = $conn->prepare($updateVendorDetailsSql);
            $updateVendorDetailsStatement->execute(['fullName' => $fullName, 'usertype' => $position, 'username' => $username, 'email' => $email, 'status' => $status, 'mobile' => $mobile, 'location' => $location, 'userID' => $id]);
            
            $_SESSION['usertype'] = $position;
            if ($status === "Disabled") {
                header('Location: ../../index.php');
                exit();
            }
        } else if ($_GET['ACTION'] === 'EDIT') {
            // Construct the UPDATE query
            $updateVendorDetailsSql = 'UPDATE user SET fullName = :fullName, username = :username, email = :email, mobile = :mobile, location = :location  WHERE userID = :userID';
            $updateVendorDetailsStatement = $conn->prepare($updateVendorDetailsSql);
            $updateVendorDetailsStatement->execute(['fullName' => $fullName, 'username' => $username, 'email' => $email, 'mobile' => $mobile, 'location' => $location, 'userID' => $id]);
            
            $_SESSION['fullName'] = $fullName;
            $_SESSION['mobile'] = $mobile;
            $_SESSION['location'] = $location;
            $_SESSION['email'] = $email;
        }

        $time = date('Y-m-d H:i:s');
		$action = "User Info Updated (User)";
        $insertAuditSql = 'INSERT INTO audit(`time`, userID, usertype, userName, Action) VALUES(:time, :userID, :usertype, :userName, :Action)';

        $insertAuditStatement = $conn->prepare($insertAuditSql);
        $insertAuditStatement->execute(['time' => $time, 'userID' => $_SESSION['userid'], 'usertype' => $_SESSION['usertype'], 'userName' => $_SESSION['fullName'], 'Action' => $action]);
    
        header('Location: ../../index.php');
        exit();
    } else if (isset($_POST["submitDelete"])) {
        if ($_SESSION['userid'] == $id) {
            echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>You cannot delete yourself!</div>';
            exit();
        }
        // Construct the UPDATE query
        $updateVendorDetailsSql = 'DELETE FROM user WHERE userID = :userID';
        $updateVendorDetailsStatement = $conn->prepare($updateVendorDetailsSql);
        $updateVendorDetailsStatement->execute(['userID' => $id]);

        header('Location: ../../index.php#usersSearchTab');
        exit();
    }

    function showStatus($row) {
        if ($_GET['ACTION'] !== 'EDIT') {
            ?> <div class="col">
                    <label class="form-label">Status</label>
                    <select class="form-control" name="userDetailsUserStatus" id="userDetailsUserStatus">
                        <?php 
                            if ($row['status'] === 'Active') {
                                ?><option selected value="Active">Active</option>
                                <option value="Disabled">Disabled</option>
                                <?php
                            } else {
                                ?><option value="Active">Active</option>
                                <option selected value="Disabled">Disabled</option>
                                <?php
                            }
                        ?>
                        
                    </select>
                </div>
            <?php
        }
    }

    function showPosition($row) {
        if ($_GET['ACTION'] !== 'EDIT') {
            ?> <div class="col">
                    <label class="form-label">Position</label>
                    <select class="form-control" name="userDetailsUserPosition" id="userDetailsUserPosition">
                        <?php 
                            if ($row['usertype'] === 'Admin') {
                                ?><option selected value="Admin">Admin</option>
                                <option value="Employee">Employee</option>
                                <option value="Reseller">Reseller</option>
                                <?php
                            } else if ($row['usertype'] === 'Employee') {
                                ?><option value="Admin">Admin</option>
                                <option selected value="Employee">Employee</option>
                                <option value="Reseller">Reseller</option>
                                <?php
                            } else {
                                ?><option value="Admin">Admin</option>
                                <option value="Employee">Employee</option>
                                <option selected value="Reseller">Reseller</option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
            <?php
        }
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
    <?php
        $vendorDetailsSearchSql = 'SELECT * FROM user where userID = :id LIMIT 1';
        $vendorDetailsSearchStatement = $conn->prepare($vendorDetailsSearchSql);
        $vendorDetailsSearchStatement->execute(['id' => $id]);

        $row = $vendorDetailsSearchStatement->fetch(PDO::FETCH_ASSOC);

    ?>
    <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Details</h3>
      <p class="text-muted">Update Info for <?php echo ucwords($row['fullName']) . " (ID: " . $row['userID'] . ")"; ?></p>
    </div>

   

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row">
                <div class="col">
                    <label class="form-label">Full Name</label>
                    <input placeholder="Full Name" type="text" class="form-control" name="userDetailsUserFullName" value="<?php echo $row['fullName']; ?>">
                </div>

                <?php showStatus($row); ?>
                
            <div>
            <div class="row">
                <div class="col">
                    <label class="form-label">Username</label>
                    <input placeholder="Username" type="text" class="form-control" name="userDetailsUserUsername" id="userDetailsUserUsername" value="<?php echo $row['username']; ?>">
                </div>
                
                <div class="col">
                    <label class="form-label">Email</label>
                    <input placeholder="Email" type="text" class="form-control" name="userDetailsUserEmail" id="userDetailsUserEmail" value="<?php echo $row['email']; ?>">
                </div>

                <?php showPosition($row); ?>

            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label">Mobile</label>
                    <input placeholder="Mobile" type="text" class="form-control" name="userDetailsUserMobile" value="<?php echo $row['mobile']; ?>">
                </div>

                <div class="col">
                    <label class="form-label">Location</label>
                    <input placeholder="Location" type="text" class="form-control" name="userDetailsUserLocation" value="<?php echo $row['location']; ?>">
                </div>
            </div>
            <br>

            <button type="submit" class="btn btn-success" name="submitUpdate">Update</button>
            <?php echo ($_GET['ACTION'] !== 'EDIT') ? '<button type="submit" class="btn btn-danger" name="submitDelete">Delete</button>' : ''; ?>
            
            <a href="../../index.php" class="btn btn-light">Cancel</a>
        </form>
    </div>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>