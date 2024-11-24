<?php
    require_once('checkApprovals.php');
?>
<!-- Profile -->
<div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-reports-tab">
    <div class="card card-outline-secondary my-4">
        <div class="card-header">PROFILE
            <button onclick="location.href='model/users/update.php?id=<?php echo $_SESSION['userid']; ?>&ACTION=EDIT'" type="button" data-mdb-button-init data-mdb-ripple-init class="btn float-right btn-sm btn-edit-profile">
            <i class='bx bx-edit'></i> Edit Profile</button>
        </div>
            <div class="card-body">
                <!-- START HERE -->
                <h5 class="profile-heading">INSIGHTS <span class="heading-arrow">></span></h5>
                <div class="insights">
                    <div class="sales">
                        <span class="material-icons-sharp">point_of_sale</span>
                        <div class="middle">
                            <div class="lef">
                                <h5>Your Total Sales</h5>
                                <h5 class="text-muted">PHP <?php echo $_SESSION['sales']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="income">
                        <span class="material-icons-sharp">data_thresholding</span>
                        <div class="middle">
                            <div class="lef">
                                <h5>Your Total Sold</h5>
                                <h5 class="text-muted"><?php echo $_SESSION['sold'] ?? 0; ?> product/s</h5>
                            </div>
                        </div>
                    </div>
                    <div class="sales">
                        <span class="material-icons-sharp">analytics</span>
                        <div class="middle">
                            <div class="lef">
                                <h5>JOST Total Sales</h5>
                                <h5 class="text-muted">PHP <?php echo $_SESSION['companysales']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="sales">
                        <span class="material-icons-sharp">analytics</span>
                        <div class="middle">
                            <div class="lef">
                                <h5>JOST Total Customer</h5>
                                <h5 class="text-muted"><?php echo $_SESSION['companysales']; ?></h5>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if ($_SESSION['usertype'] === 'Admin') {
                            ?>
                            <div class="expenses">
                                <span class="material-icons-sharp">bar_chart</span>
                                <div class="middle">
                                    <div class="lef">
                                        <h5>JOST Total Expense</h5>
                                        <h5 class="text-muted">PHP <?php echo $_SESSION['companyexpense'] ?? 0; ?></h5>
                                    </div>
                                </div>
                            </div> <?php
                        }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card mb-4">
                            <div class="card-body text-center">
                                <h5 class="my-3" style="max-width: 400px; margin: 0 auto;">
                                <?php echo ucwords($_SESSION['fullName']); ?><span class="material-icons-sharp material-icons-sharp-user" style="font-size: .9rem;">verified</span> <small><?php echo '(UID: ' . $_SESSION['userid'] . ')';?></small>
                                </h5>
                                <p class="text-muted mb-1"><?php echo strtoupper($_SESSION['usertype']); ?></p>
                                <p class="text-muted mb-1" style="font-size: .7rem;">
                                    Account Status: <?php echo $_SESSION['status']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="card mb-4 pb-5">
                            <div class="card-body text-left">
                                <h5 class="my-3">JOST Profile</h5>
                                <p class="text-muted text-center">Jasdy Office Supplies Trading aim is to provide you with products at reasonable prices, so that you can stock up on necessary supplies without breaking the bank. <hr></p>
                                <p class="text-muted mb-1">Facebook <span class="heading-arrow">></span> <a href="https://www.facebook.com/jasdyOStrading/"><small>Jasdy Office Supplies Trading </small></a></p>
                                <p class="text-muted mb-1">Contact <span class="heading-arrow">></span> +63 906 236 4630</p>
                                
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
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?php echo $_SESSION['email']; ?></p>
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
                                <?php 
                                    if ($usertype === 'Admin') {
                                        ?>
                                        <hr style="background-color: var(--color-primary);">
                                        <div class="row">
                                            
                                            <div class="col-sm-3">
                                                <p class="mb-0">Pending Reseller Approval</p>
                                            </div>
                                            <div class="col-sm-9">
                                                <p class="text-muted mb-0"><?php echo $totalDisabledUsersReseller; ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <p class="mb-0">Pending Employee Approval</p>
                                            </div>
                                            <div class="col-sm-9">
                                            <p class="text-muted mb-0"><?php echo $totalDisabledUsersEmployee; ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>

                                <?php
                                    if ($usertype === 'Admin') {
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-6 mt-2">
                                                <p class="text-muted mb-0" style="font-size: .8rem;">| Go to <b>Search/Track</b> <span class="heading-arrow">></span> <b>Accounts</b> to approve accounts</p>
                                            </div>  
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- Profile -->