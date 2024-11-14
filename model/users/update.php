<?php
    session_start();
    require_once('../../inc/config/constants.php');
    require_once('../../inc/config/db.php');
    require_once('../../inc/errorhandling.php');
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
            
            if ($id === $_SESSION['userid']) {
                $_SESSION['usertype'] = $position;
            }
            
            if ($status === "Disabled" && $id === $_SESSION['userid']) {
                unset($_SESSION['loggedIn']);
                unset($_SESSION['fullName']);
                unset($_SESSION['usertype']);
                session_destroy();
                header('Location: ../../dashboard.php');
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
    
        update("Details Updated Successfully!");
        exit();
    } else if (isset($_POST["submitDelete"])) {

        $idSql = 'SELECT * FROM user where userID = :id LIMIT 1';
        $idSqlStatement = $conn->prepare($idSql);
        $idSqlStatement->execute(['id' => $id]);

        if ($idSqlStatement->rowCount() > 0){
            $found = $idSqlStatement->fetch(PDO::FETCH_ASSOC);

            if ($_SESSION['userid'] == $id) {
                update("You cannot delete yourself!");
                exit();
            }
            // Construct the UPDATE query
            $updateVendorDetailsSql = 'DELETE FROM user WHERE userID = :userID';
            $updateVendorDetailsStatement = $conn->prepare($updateVendorDetailsSql);
            $updateVendorDetailsStatement->execute(['userID' => $id]);

            update("User Deleted Successfully!");
        } else {
            update("No User Selected!");
            exit();
        }
    }

    function showStatus($row) {
        if ($_GET['ACTION'] !== 'EDIT') {
            ?> <div class="col mt-2">
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
            ?> <div class="col mt-2">
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

  <link rel="stylesheet" href="../../vendor/bootstrap/css/cerulean.theme.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- ===== CUSTOM STYLE ===== -->
    <link href="../../assets/css/shop-styles.css" rel="stylesheet">
  <title>JOST System</title>
</head>

<body>
<nav class="navbar navbar-expand-lg fixed-top">
      <div class="container">
      <img src="../../data/item_images/logo.png" width="100px" height="32px" style="margin-right: 10px;">
        <a class="navbar-brand" href="index.php">WRAP <b>IT</b></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
			<!-- <li class="nav-item">
				<form class="form-inline" action="/action_page.php">
					<input class="form-control col-md-8 mr-sm-2" type="text" placeholder="Search">
					<button class="btn btn-success" type="submit">Search</button>
				</form>
			</li> -->
			<li class="nav-item">
        <?php 
          $usertype = "";
          if ($_SESSION['usertype'] === 'Admin') {
            $usertype = "ADMIN";
          } elseif ($_SESSION['usertype'] === 'Reseller') {
            $usertype = "RESELLER";
          } elseif ($_SESSION['usertype'] === 'Employee') {
            $usertype = "EMPLOYEE";
          }
        ?>
				<span class="nav-link">Hey, <?php echo $_SESSION['fullName'] . " <small>" . $usertype . "</small> "; ?></span>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <br>
    <?php
        $vendorDetailsSearchSql = 'SELECT * FROM user where userID = :id LIMIT 1';
        $vendorDetailsSearchStatement = $conn->prepare($vendorDetailsSearchSql);
        $vendorDetailsSearchStatement->execute(['id' => $id]);

        $row = $vendorDetailsSearchStatement->fetch(PDO::FETCH_ASSOC);

        if ($row <= 0) {
            $userID = $row['userID'] ?? 'No user';
        } else {
            $userID = $row['userID'];
        }

    ?>
    <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Details</h3>
      <p class="text-muted">Update Info for <?php echo ucwords($row['fullName'] ?? "") . " (ID: " . $userID . ")"; ?></p>
    </div>

   

    <div class="container d-flex justify-content-center">
        <form action="" method="post" style="width:55vw; min-width:300px;">
            <div id="loginMessage"></div>
			<?php if (isset($_GET['message'])): ?>
                <?php 
                    if (htmlspecialchars($_GET['message']) == "No User Selected!") {
                        ?><div class="alert alert-warning"><?php
                    } else if (htmlspecialchars($_GET['message']) == "You cannot delete yourself!") {
                        ?><div class="alert alert-warning"><?php
                    } else {
                        ?><div class="alert alert-success"><?php
                    }
                ?>
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<?php echo htmlspecialchars($_GET['message']); ?>
				</div>
			<?php endif; ?>
            <div class="row">
                <div class="col mt-2">
                    <label class="form-label">Full Name</label>
                    <input placeholder="Full Name" type="text" class="form-control" name="userDetailsUserFullName" value="<?php echo $row['fullName'] ?? "" ; ?>">
                </div>

                <?php showStatus($row); ?>
                
            <div>
            <div class="row">
                <div class="col mt-2">
                    <label class="form-label">Username</label>
                    <input placeholder="Username" type="text" class="form-control" name="userDetailsUserUsername" id="userDetailsUserUsername" value="<?php echo $row['username'] ?? ""; ?>">
                </div>
                
                <div class="col mt-2">
                    <label class="form-label">Email</label>
                    <input placeholder="Email" type="email" class="form-control" name="userDetailsUserEmail" id="userDetailsUserEmail" value="<?php echo $row['email'] ?? ""; ?>">
                </div>

                <?php showPosition($row); ?>

            </div>
            <div class="row">
                <div class="col mt-2">
                    <label class="form-label">Mobile <small style="font-weight: 500;">(Format: 09123456789)</small></label>
                    <input placeholder="Mobile" type="text" class="form-control" name="userDetailsUserMobile" value="<?php echo $row['mobile'] ?? ""; ?>">
                </div>

                <div class="col mt-2">
                    <label class="form-label">Location</label>
                    <input placeholder="Location" type="text" class="form-control" name="userDetailsUserLocation" value="<?php echo $row['location'] ?? ""; ?>">
                </div>
            </div>
            <br>

            <button type="submit" class="btn btn-success" name="submitUpdate">Update</button>
            <?php echo ($_GET['ACTION'] !== 'EDIT') ? '<button type="submit" class="btn btn-danger" name="submitDelete">Delete</button>' : ''; ?>
            <a href="../../dashboard.php" class="btn btn-light">Cancel</a>
        </form>
        
    </div>
  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="../../vendor/jquery/jquery.min.js"></script>
  <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../vendor/bootbox/bootbox.min.js"></script>
</body>

</html>