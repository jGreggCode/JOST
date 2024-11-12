<?php
    require_once('checkApprovals.php');
?>
<!-- Profile -->
<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-reports-tab">
    <div class="card card-outline-secondary my-4">
        <div class="card-header">Profile</div>
            <div class="card-body">		
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <h5 class="my-3">
                                    <i class='bx bxs-check-shield' style='color:#2d2d2d'  ></i>
                                    <?php echo ucwords($_SESSION['fullName']); ?>
                                </h5>
                                <p class="text-muted mb-1"><?php echo strtoupper($_SESSION['usertype']); ?></p>
                                <p class="text-muted mb-1">
                                    <i class='bx bxs-envelope'></i>
                                    Email: <?php echo $_SESSION['email']; ?>
                                </p>
                                <p class="text-muted mb-1">
                                    <i class='bx bxs-home'></i>
                                    Location: <?php echo $_SESSION['location']; ?>
                                </p>
                                <p class="text-muted mb-4">
                                    <i class='bx bx-mobile'></i>
                                    Phone No: <?php echo $_SESSION['mobile']; ?>
                                </p>
                                <div class="d-flex justify-content-center mb-2">
                                    <button onclick="location.href='model/users/update.php?id=<?php echo $_SESSION['userid']; ?>&ACTION=EDIT'" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Edit Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Full Name</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo ucwords($_SESSION['fullName']); ?></p>
                                    </div>
                                </div>	
                                <?php 
                                    if ($usertype === 'Admin') {
                                        ?>
                                        <hr>
                                        <div class="row">
                                            
                                            <div class="col-sm-3">
                                                <p class="mb-0">Pending Reseller Approval</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $totalDisabledUsersEmployee; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Pending Employee Approval</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $totalDisabledUsersReseller; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <?php
                                    }
                                ?>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Your total Sales</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">PHP <?php echo $_SESSION['sales']; ?></p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Your total Sold</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $_SESSION['sold'] ?? 0; ?> product/s</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Total Company Sales</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0">PHP <?php echo $_SESSION['companysales']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- Profile -->