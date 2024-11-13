<?php
    require_once('checkApprovals.php');
?>
<!-- Profile -->
<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-reports-tab">
    <div class="card card-outline-secondary my-4">
        <div class="card-header">Profile</div>
            <div class="card-body">
                <!-- START HERE -->
                <h5 class="profile-heading">Profile Insights</h5>
                <div class="insights">
                    <div class="sales">
                        <span class="material-icons-sharp">point_of_sale</span>
                        <div class="middle">
                            <div class="lef">
                                <h4>Total Sales</h4>
                                <h5 class="text-muted">PHP <?php echo $_SESSION['sales']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="income">
                        <span class="material-icons-sharp">data_thresholding</span>
                        <div class="middle">
                            <div class="lef">
                                <h4>Total Sold</h4>
                                <h5 class="text-muted"><?php echo $_SESSION['sold'] ?? 0; ?> product/s</h5>
                            </div>
                        </div>
                    </div>
                    <div class="sales">
                        <span class="material-icons-sharp">analytics</span>
                        <div class="middle">
                            <div class="lef">
                                <h4>JASDY Total Sales</h4>
                                <h5 class="text-muted">PHP <?php echo $_SESSION['companysales']; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <h5 class="my-3">
                                    <i class='bx bxs-badge-check' style='color:#44d24e;' ></i>
                                    <?php echo ucwords($_SESSION['fullName']); ?> <small>UID: 0112</small>
                                </h5>
                                <p class="text-muted mb-1"><?php echo strtoupper($_SESSION['usertype']); ?></p>
                                <p class="text-muted mb-1">
                                    Profile Status: <?php echo $_SESSION['status']; ?>
                                </p>
                                <div class="d-flex justify-content-center mb-2">
                                    <button onclick="location.href='model/users/update.php?id=<?php echo $_SESSION['userid']; ?>&ACTION=EDIT'" type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">
                                    <i class='bx bx-edit'></i> Edit Profile</button>
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
                                        <?php
                                    }
                                ?>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo ucwords($_SESSION['email']); ?></p>
                                    </div>
                                </div>	
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Phone No</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo ucwords($_SESSION['mobile']); ?></p>
                                    </div>
                                </div>	
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Location</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo ucwords($_SESSION['location']); ?></p>
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