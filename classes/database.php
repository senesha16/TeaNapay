<?php

    class database{

        function opencon() {
            return new PDO(
                dsn: 'mysql:host=localhost;dbname=teanapaydb',
                username: 'root',
                password: ''
            );
        }

        function addProducts($prodName, $prodDesc, $catID, $price, $availability) {
            $con = $this->opencon();

            try {
                $con->beginTransaction();

                // Inserts into product table
                $stmt1 = $con->prepare("INSERT INTO product (Prod_Name, Prod_Desc) VALUES (?, ?)");
                $stmt1->execute([$prodName, $prodDesc]);
                $prodID = $con->lastInsertId();

                // Inserts into productcategory table
                $stmt2 = $con->prepare("INSERT INTO productcategory (Prod_ID, Cat_ID) VALUES (?, ?)");
                $stmt2->execute([$prodID, $catID]);

                // Inserts into productprices table
                $stmt3 = $con->prepare("INSERT INTO productprices (Prod_ID, Price, Effective_To) VALUES (?, ?, NOW())");
                $stmt3->execute([$prodID, $price]);

                // Inserts into productstock table
                $stmt4 = $con->prepare("INSERT INTO productstock (Prod_ID, Avalability) VALUES (?, ?)");
                $stmt4->execute([$prodID, $availability]);

                $con->commit();
                return true;
            } catch (PDOException $e) {
                $con->rollBack();
            return false;
            }
        }

        // Functions to view all products with their categories, prices, and availability
        function viewProducts() {
            $con = $this->opencon();
            return $con->query(
                "SELECT 
                    p.Prod_ID, 
                    p.Prod_Name, 
                    p.Prod_Desc, 
                    c.Cat_Name, 
                    pp.Price, 
                    ps.Avalability
                FROM product p
                LEFT JOIN productcategory pc ON p.Prod_ID = pc.Prod_ID
                LEFT JOIN category c ON pc.Cat_ID = c.Cat_ID
                LEFT JOIN (
                    SELECT p1.Prod_ID, p1.Price
                    FROM productprices p1
                    INNER JOIN (
                        SELECT Prod_ID, MAX(Effective_To) AS max_eff
                        FROM productprices
                        GROUP BY Prod_ID
                    ) p2 ON p1.Prod_ID = p2.Prod_ID AND p1.Effective_To = p2.max_eff
                ) pp ON p.Prod_ID = pp.Prod_ID
                LEFT JOIN productstock ps ON p.Prod_ID = ps.Prod_ID
                WHERE p.Archived = 0
                GROUP BY p.Prod_ID
            "
            )->fetchAll(PDO::FETCH_ASSOC);
        }
        
        // Function to view and edit specific product by ID with its category, price, and availability
        function viewProductsID($id) {
            $con = $this->opencon();
            $stmt = $con->prepare(
                "SELECT 
                    p.Prod_ID, 
                    p.Prod_Name, 
                    p.Prod_Desc, 
                    c.Cat_Name, 
                    pp.Price, 
                    ps.Avalability
                FROM product p
                LEFT JOIN productcategory pc ON p.Prod_ID = pc.Prod_ID
                LEFT JOIN category c ON pc.Cat_ID = c.Cat_ID
                LEFT JOIN (
                    SELECT Prod_ID, Price, Effective_To 
                    FROM productprices 
                    WHERE (Prod_ID, Effective_To) IN (
                        SELECT Prod_ID, MAX(Effective_To) FROM productprices GROUP BY Prod_ID)
                ) pp ON p.Prod_ID = pp.Prod_ID
                LEFT JOIN productstock ps ON p.Prod_ID = ps.Prod_ID
                WHERE p.Prod_ID = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Function to update product details
        function updateProduct($prodID, $prodName, $prodDesc, $catID, $price, $availability) {
            $con = $this->opencon();
            try {
                // Updates product table
                $stmt1 = $con->prepare("UPDATE product SET Prod_Name = ?, Prod_Desc = ? WHERE Prod_ID = ?");
                $stmt1->execute([$prodName, $prodDesc, $prodID]);

                // Updates productcategory table
                $stmt2 = $con->prepare("UPDATE productcategory SET Cat_ID = ? WHERE Prod_ID = ?");
                $stmt2->execute([$catID, $prodID]);

                // Inserts new price into productprices table (assuming you want to keep price history)
                $stmt3 = $con->prepare("INSERT INTO productprices (Prod_ID, Price, Effective_To) VALUES (?, ?, NOW())");
                $stmt3->execute([$prodID, $price]);

                // Updates productstock table
                $stmt4 = $con->prepare("UPDATE productstock SET Avalability = ? WHERE Prod_ID = ?");
                $stmt4->execute([$availability, $prodID]);

                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        // Function to soft delete a product by ID
        function archiveProduct($prodID) {
            $con = $this->opencon();
            $stmt = $con->prepare("UPDATE product SET Archived = 1 WHERE Prod_ID = ?");
            return $stmt->execute([$prodID]);
        }

        function displayProducts($category) {
            $con = $this->opencon();
            $stmt = $con->prepare(
                "SELECT 
                    p.Prod_ID,
                    p.Prod_Name,
                    p.Prod_Desc,
                    p.Prod_Image,
                    pp.Price
                FROM product p
                JOIN productcategory pc ON p.Prod_ID = pc.Prod_ID
                JOIN category c ON pc.Cat_ID = c.Cat_ID
                JOIN productprices pp ON p.Prod_ID = pp.Prod_ID
                WHERE 
                    c.Cat_Name = ?
                    AND p.Archived = 0
                    AND pc.Archived = 0
                    AND c.Archived = 0
                    AND pp.Archived = 0"
            );
            $stmt->execute([$category]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Function to view all employee details
        function viewEmployees() {
            $con = $this->opencon();
            return $con->query(
                "SELECT 
                    e.Emp_ID, 
                    e.Emp_FN, 
                    e.Emp_LN, 
                    e.Emp_User, 
                    ua.User_Email,
                    e.Emp_Pos 
                FROM employee e
                LEFT JOIN useraccount ua ON e.UA_ID = ua.UA_ID
                WHERE e.Archived = 0"
            )->fetchAll(PDO::FETCH_ASSOC);
        }

        // Function to view specific employee details by ID
        function viewEmployeesID($id) {
            $con = $this->opencon();
            $stmt = $con->prepare(
                "SELECT 
                    e.Emp_ID, 
                    e.Emp_FN, 
                    e.Emp_LN, 
                    e.Emp_User, 
                    ua.User_Email,
                    e.Emp_Pos 
                FROM employee e
                LEFT JOIN useraccount ua ON e.UA_ID = ua.UA_ID
                WHERE e.Emp_ID = ?"
            );
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Function to update employee details
        function updateEmployee($empID, $empFN, $empLN, $empUser, $empEmail, $empPos) {
            $con = $this->opencon();
            try {
                // Update employee details
                $stmt1 = $con->prepare("UPDATE employee SET Emp_FN = ?, Emp_LN = ?, Emp_User = ?, Emp_Pos = ? WHERE Emp_ID = ?");
                $stmt1->execute([$empFN, $empLN, $empUser, $empPos, $empID]);

                // Update user account email
                $stmt2 = $con->prepare("UPDATE useraccount SET User_Email = ? WHERE UA_ID = (SELECT UA_ID FROM employee WHERE Emp_ID = ?)");
                $stmt2->execute([$empEmail, $empID]);

                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        // Function to soft delete an employee details by ID
        function archiveEmployee($id) {
            $con = $this->opencon();
            $stmt = $con->prepare("UPDATE employee SET Archived = 1 WHERE Emp_ID = ?");
            return $stmt->execute([$id]);
        }

        // Function to view all customer details by ID
        function viewCustomers() {
            $con = $this->opencon();
            return $con->query(
                "SELECT 
                    c.Cust_ID, 
                    c.Cust_FN, 
                    c.Cust_LN, 
                    c.Cust_Email, 
                    c.Cust_Phone, 
                    ca.Cart_ID,
                    IFNULL(da.Street, '') AS Street,
                    IFNULL(da.Barangay, '') AS Barangay,
                    IFNULL(da.City, '') AS City,
                    IFNULL(da.State, '') AS State,
                    IFNULL(da.ZIP_Code, '') AS ZIP_Code,
                    IFNULL(da.Active_Address, 0) AS Active_Address
                FROM customer c
                LEFT JOIN cart ca ON ca.Cust_ID = c.Cust_ID
                LEFT JOIN deliveryaddress da ON da.Cust_ID = c.Cust_ID AND da.Active_Address = 1
                WHERE c.Archived = 0"
            )->fetchAll(PDO::FETCH_ASSOC);
        }

        // Function to soft delete a customer details by ID
        function archiveCustomer($id) {
            $con = $this->opencon();
            $stmt = $con->prepare("UPDATE customer SET Archived = 1 WHERE Cust_ID = ?");
            return $stmt->execute([$id]);
        }

        // Function to view orders with details
        function viewOrders() {
            $con = $this->opencon();
            return $con->query(
                "SELECT Order_ID, Cust_ID, Order_Date, Total_Amount, Claim_Date FROM orders"
            )->fetchAll(PDO::FETCH_ASSOC);
        }

        // Function to view order details by ID
        function viewOrdersID($id) {
            $con = $this->opencon();
            $stmt = $con->prepare(
                "SELECT Order_ID, Cust_ID, Order_Date, Total_Amount, Claim_Date FROM orders 
                WHERE Order_ID = ?"
            );
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Function to update order details
        function updateOrder($id, $custID, $orderDate, $totalAmount, $claimDate) {
            $con = $this->opencon();
            try {
                $stmt = $con->prepare(
                    "UPDATE orders 
                    SET Cust_ID = ?, Order_Date = ?, Total_Amount = ?, Claim_Date = ? 
                    WHERE Order_ID = ?"
                );
                return $stmt->execute([$custID, $orderDate, $totalAmount, $claimDate, $id]);
            } catch (Exception $e) {
                return false;
            }
        }

        // Function to soft delete an order by ID
        function archiveOrder($id) {
            $con = $this->opencon();
            $stmt = $con->prepare("UPDATE orders SET Archived = 1 WHERE Order_ID = ?");
            return $stmt->execute([$id]);
        }

        // Function to view payments with details
        function viewPayments() {
            $con = $this->opencon();
            return $con->query(
                "SELECT 
                    p.Pay_ID, 
                    p.Order_ID, 
                    o.Cust_ID, 
                    p.Emp_ID, 
                    pm.Payment_Method, 
                    p.Pay_Amount, 
                    p.Pay_Date
                FROM payment p
                LEFT JOIN orders o ON p.Order_ID = o.Order_ID
                LEFT JOIN paymentmethod pm ON p.PM_ID = pm.PM_ID
                WHERE p.Archived = 0"
            )->fetchAll(PDO::FETCH_ASSOC);
        }

        // Function to view payment details by ID
        function viewPaymentsID($id) {
            $con = $this->opencon();
            $stmt = $con->prepare(
                "SELECT 
                    p.Pay_ID, 
                    p.Order_ID, 
                    o.Cust_ID, 
                    p.Emp_ID, 
                    pm.Payment_Method, 
                    p.Pay_Amount, 
                    p.Pay_Date
                FROM payment p
                LEFT JOIN orders o ON p.Order_ID = o.Order_ID
                LEFT JOIN paymentmethod pm ON p.PM_ID = pm.PM_ID
                WHERE p.Pay_ID = ?"
            );
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Function to update payment details

        function updatePayment($payID, $orderID, $custID, $empID, $payMethod, $payAmount, $payDate) {
            $con = $this->opencon();
            try {
                $stmt = $con->prepare("SELECT PM_ID FROM paymentmethod WHERE Payment_Method = ? AND Archived = 0 LIMIT 1");
                $stmt->execute([$payMethod]);
                $pm = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$pm) {
                    $insertPM = $con->prepare("INSERT INTO paymentmethod (Payment_Method) VALUES (?)");
                    $insertPM->execute([$payMethod]);
                    $pmID = $con->lastInsertId();
                } else {
                    $pmID = $pm['PM_ID'];
                }

                $update = $con->prepare(
                    "UPDATE payment 
                    SET Order_ID = ?, Emp_ID = ?, PM_ID = ?, Pay_Amount = ?, Pay_Date = ?
                    WHERE Pay_ID = ?"
                );
                return $update->execute([
                    $orderID,
                    $empID,
                    $pmID,
                    $payAmount,
                    date('Y-m-d H:i:s', strtotime($payDate)),
                    $payID
                ]);
            } catch (Exception $e) {
                return false;
            }
        }

        // Function to soft delete a payment details by ID
        function archivePayment($id) {
            $con = $this->opencon();
            $stmt = $con->prepare("UPDATE payment SET Archived = 1 WHERE Pay_ID = ?");
            return $stmt->execute([$id]);
        }


    }

?>