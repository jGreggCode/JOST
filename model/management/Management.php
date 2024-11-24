<?php
	session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');

    class Management {
        private $db;
    
        // Constructor to initialize the database connection
        public function __construct($db) {
            $this->db = $db;
        }
    
        // Method to delete an account
        public function itemDelete($itemID) {
            try {
                $stmt = $this->db->prepare("DELETE FROM item WHERE productID = :id");
                $stmt->bindParam(':id', $itemID, PDO::PARAM_INT);
                $stmt->execute();
    
                if ($stmt->rowCount() > 0) {
                    $message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item deleted successfully</div>';
                    return ['status' => 'success', 'message' => $message];
                } else {
                    $message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Item not found or already deleted</div>';
                    return ['status' => 'warning', 'message' => $message];
                }
            } catch (PDOException $e) {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                return ['status' => 'error', 'message' => $message];
            }
        }

        public function itemUpdate(
            $productID,
            $itemNumber, 
            $itemName, 
            $itemCategory, 
            $itemDescription, 
            $itemCosting, 
            $itemStock, 
            $itemUnitPrice) {
                try {
                    // Update Item
                    $updateStmt = $this->db->prepare("UPDATE item SET 
                        itemNumber = :itemNumber, 
                        itemName = :itemName, 
                        category = :category,
                        description = :description,
                        stock = :stock, 
                        costing = :costing,
                        unitPrice = :unitPrice
                        WHERE productID = :productID"
                    );
                    $updateStmt->execute([
                        'itemNumber' => $itemNumber,
                        'itemName' => $itemName,
                        'category' => $itemCategory,
                        'description' => $itemDescription,
                        'stock' => $itemStock,
                        'costing' => $itemCosting,
                        'unitPrice' => $itemUnitPrice,
                        'productID' => $productID
                    ]);

                    if ($updateStmt->rowCount() > 0) {
                        $message = 'Item details Successfully updated';
                        return ['status' => 'success', 'message' => $message];
                    } else {
                        $message = 'Failed to update Item details';
                        return ['status' => 'error', 'message' => $message];
                    }
                } catch (PDOException $e) {
                    $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                    return ['status' => 'error', 'message' => $message];
                }
        }

        public function customerDelete($customerID) {
            try {
                $stmt = $this->db->prepare("DELETE FROM customer WHERE customerID = :id");
                $stmt->bindParam(':id', $customerID, PDO::PARAM_INT);
                $stmt->execute();
    
                if ($stmt->rowCount() > 0) {
                    $message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer deleted successfully</div>';
                    return ['status' => 'success', 'message' => $message];
                } else {
                    $message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer not found or already deleted</div>';
                    return ['status' => 'warning', 'message' => $message];
                }
            } catch (PDOException $e) {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                return ['status' => 'error', 'message' => $message];
            }
        }

        public function customerUpdate(
            $customerID,
            $customerFullName, 
            $customerEmail,
            $customerMobile,
            $customerMobile2,
            $customerAddress,
            $customerAddress2,
            $customerCity,
            $customerDistrict,
        ) {
            try {
                $updateStmt = $this->db->prepare('UPDATE customer SET
                    fullName = :fullname,
                    email = :email,
                    mobile = :mobile,
                    phone2 = :phone2,
                    address = :address,
                    address2 = :address2,
                    city = :city,
                    district = :district
                    WHERE customerID = :customerID'
                );

                $updateStmt->execute([
                    'fullname' => $customerFullName,
                    'email' => $customerEmail,
                    'mobile' => $customerMobile,
                    'phone2' => $customerMobile2,
                    'address' => $customerAddress,
                    'address2' => $customerAddress2,
                    'city' => $customerCity,
                    'district' => $customerDistrict,
                    'customerID' => $customerID
                ]);
    
                if ($updateStmt->rowCount() > 0) {
                    $message = 'Customer details Successfully updated';
                    return ['status' => 'success', 'message' => $message];
                } else {
                    $message = 'Failed to update Customer details';
                    return ['status' => 'error', 'message' => $message];
                }
            } catch (PDOException $e) {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                return ['status' => 'error', 'message' => $message];
            }
        }

        public function vendorDelete($vendorID) {
            try {
                $stmt = $this->db->prepare("DELETE FROM vendor WHERE vendorID = :id");
                $stmt->bindParam(':id', $vendorID, PDO::PARAM_INT);
                $stmt->execute();
    
                if ($stmt->rowCount() > 0) {
                    $message = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Supplier deleted successfully</div>';
                    return ['status' => 'success', 'message' => $message];
                } else {
                    $message = '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert">&times;</button>Supplier not found or already deleted</div>';
                    return ['status' => 'warning', 'message' => $message];
                }
            } catch (PDOException $e) {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                return ['status' => 'error', 'message' => $message];
            }
        }

        public function vendorUpdate(
            $vendorID,
            $vendorFullName, 
            $vendorEmail,
            $vendorMobile,
            $vendorMobile2,
            $vendorAddress,
            $vendorAddress2,
            $vendorCity,
            $vendorDistrict,
        ) {
            try {
                $updateStmt = $this->db->prepare('UPDATE vendor SET
                    fullName = :fullname,
                    email = :email,
                    mobile = :mobile,
                    phone2 = :phone2,
                    address = :address,
                    address2 = :address2,
                    city = :city,
                    district = :district
                    WHERE vendorID = :vendorID'
                );

                $updateStmt->execute([
                    'fullname' => $vendorFullName,
                    'email' => $vendorEmail,
                    'mobile' => $vendorMobile,
                    'phone2' => $vendorMobile2,
                    'address' => $vendorAddress,
                    'address2' => $vendorAddress2,
                    'city' => $vendorCity,
                    'district' => $vendorDistrict,
                    'vendorID' => $vendorID
                ]);
    
                if ($updateStmt->rowCount() > 0) {
                    $message = 'Supplier details Successfully updated';
                    return ['status' => 'success', 'message' => $message];
                } else {
                    $message = 'Failed to update Supplier details';
                    return ['status' => 'error', 'message' => $message];
                }
            } catch (PDOException $e) {
                $message = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Database error: ' . $e->getMessage() . '</div>';
                return ['status' => 'error', 'message' => $message];
            }
        }
    }

	