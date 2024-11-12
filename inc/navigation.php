	<!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
      <div class="container">
      <img src="data/item_images/logo.png" width="100px" height="32px" style="margin-right: 10px;" alt="was">
        <a class="navbar-brand" href="index.php">Wrap IT</a>
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
				<span class="nav-link">Welcome <?php echo "<b>" . $usertype . "</b> " . $_SESSION['fullName']; ?></span>
            </li>
			<li class="nav-item">
				<span class="nav-link"> | </span>
            </li>
			<li class="nav-item">
				<a class="nav-link" href="model/login/logout.php">
				    Log Out
				</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>