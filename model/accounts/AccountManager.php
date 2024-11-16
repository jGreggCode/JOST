<?php
	session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
    require_once('../../send.php');

    class AccountManager {
        private $db;
    
        // Constructor to initialize the database connection
        public function __construct($db) {
            $this->db = $db;
        }
    
        // Method to delete an account
        public function deleteAccount($accountID) {
            try {
                $stmt = $this->db->prepare("DELETE FROM user WHERE userID = :id");
                $stmt->bindParam(':id', $accountID, PDO::PARAM_INT);
                $stmt->execute();
    
                if ($stmt->rowCount() > 0) {
                    $message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Account deleted successfully</div>';
                    return ['status' => 'success', 'message' => $message];
                } else {
                    $message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Account not found or already deleted</div>';
                    return ['status' => 'warning', 'message' => $message];
                }
            } catch (PDOException $e) {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                return ['status' => 'error', 'message' => $message];
            }
        }

        // Method to activate an account
        public function activateAccount($accountEmail) {
            try {
                // Validate if the account exists and is already active
                $stmt = $this->db->prepare("SELECT status FROM user WHERE email = :email");
                $stmt->bindParam(':email', $accountEmail, PDO::PARAM_STR);
                $stmt->execute();
    
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $accountType = $result['usertype'];
                $accountStatus = $result['status'];
    
                if (!$result) {
                    $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Account not found</div>';
                    return ['status' => 'error', 'message' => $message];
                }
    
                if ($accountStatus === 'Active') {
                    $message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Account is already active</div>';
                    return ['status' => 'warning', 'message' => $message];
                }
    
                // Activate the account
                $updateStmt = $this->db->prepare("UPDATE user SET status = 'Active' WHERE email = :email");
                $updateStmt->bindParam(':email', $accountEmail, PDO::PARAM_STR);
                $updateStmt->execute();
    
                if ($updateStmt->rowCount() > 0) {
                    // Send activation email
                    $emailSent = accountActivatedEmail($accountType, $accountEmail); 
                    if ($emailSent) {
                        $message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Account activated and activation email notification has been sent</div>';
                        return ['status' => 'success', 'message' => $message];
                    } else {
                        $message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Account activated but email failed to send</div>';
                        return ['status' => 'warning', 'message' => $message];
                    }
                } else {
                    $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Failed to activate account</div>';
                    return ['status' => 'error', 'message' => $message];
                }
            } catch (PDOException $e) {
                $message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                return ['status' => 'error', 'message' => $message];
            }
        }
    }

	