<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Details </title>
    <style>
        .wrapper {
            width: 80%;
            margin: auto;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .entry-details {
            background: #f9f9f9;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .entry-details h2 {
            text-align: center;
        }

        .entry-details .details {
            margin-top: 10px;
        }

        .entry-details .details p {
            margin: 5px 0;
        }

        .entry-details form {
            margin-top: 10px;
        }

        .entry-details form select {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .entry-details form button {
            padding: 8px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .entry-details form button:hover {
            background-color: #0056b3;
        }

        .nav-links {
            text-align: center;
            margin-top: 20px;
        }

        .nav-links a {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin: 0 5px;
        }

        .nav-links a:hover {
            background-color: #0056b3;
        }

        .logout-button {
            text-align: right;
            margin-top: 20px;
        }

        .logout-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-button a:hover {
            background-color: #0056b3;
        }
       
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="title">
            <h1>Contact Form Details For Admin</h1>
        </div>
        <div class="logout-button">
            <a href="logout.php">Logout</a>
        </div>
        <div class="entry-details">
            <?php
            // Replace DB_HOST, DB_USER, DB_PASSWORD, and DB_NAME with your actual database credentials
            $conn = new mysqli('localhost', 'root', '', 'travaldb');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Check if the form is submitted to update the status
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["entry_id"]) && isset($_POST["status"])) {
                $entry_id = $_POST["entry_id"];
                $status = $_POST["status"];

                // Update the status in the database
                $update_sql = "UPDATE contact_us SET status='$status' WHERE id=$entry_id";
                if ($conn->query($update_sql) === TRUE) {
                    echo '<span style="color: green;">Status updated successfully</span>';
                
                } else {
                    echo '<span style="color: red;">Error updating status: ' . $conn->error . '</span>';
                }
                
            }

            // Check if entry_id is set, if not get the first entry
            if (isset($_GET['entry_id'])) {
                $entry_id = $_GET['entry_id'];
            } else {
                // Query to get the first entry
                $first_entry_sql = "SELECT id FROM contact_us ORDER BY id LIMIT 1";
                $first_entry_result = $conn->query($first_entry_sql);
                if ($first_entry_result->num_rows > 0) {
                    $first_entry_row = $first_entry_result->fetch_assoc();
                    $entry_id = $first_entry_row['id'];
                } else {
                    echo "No Data Is Available ";
                    exit;
                }
            }

            // Query to select the entry with the given ID
            $entry_sql = "SELECT * FROM contact_us WHERE id = $entry_id";
            $entry_result = $conn->query($entry_sql);

            // Check if there are any rows returned
            if ($entry_result->num_rows > 0) {
                // Output data of the entry
                $row = $entry_result->fetch_assoc();
                echo "<h2>Contact Details</h2>";
                echo "<div class='details'>";
                echo "<p><strong>Name:</strong> " . $row["name"] . "</p>";
                echo "<p><strong>Email:</strong> " . $row["email"] . "</p>";
                echo "<p><strong>Phone:</strong> " . $row["phone"] . "</p>";
                echo "<p><strong>Packages:</strong> " . $row["packages"] . "</p>";
                echo "<p><strong>Message:</strong> " . $row["message"] . "</p>";
                echo "<p><strong>Status:</strong> " . $row["status"] . "</p>";
                echo "</div>";

                // Add form to update status
                echo '<form method="post" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '">';
                echo '<input type="hidden" name="entry_id" value="' . $row["id"] . '">';
                echo '<select name="status">';
                echo '<option value="Pending" ' . ($row["status"] == "Pending" ? "selected" : "") . '>Pending</option>';
                echo '<option value="Completed" ' . ($row["status"] == "Completed" ? "selected" : "") . '>Completed</option>';
                echo '</select>';
                echo '<button type="submit">Update Status</button>';
                echo '</form>';

                // Add navigation buttons
                echo '<div class="nav-links">';
                echo '<a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?entry_id=' . ($entry_id - 1) . '">Previous</a>';
                echo ' | ';
                echo '<a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?entry_id=' . ($entry_id + 1) . '">Next</a>';
                echo '</div>';
            } else {
                echo "No Data Is Available";
            }

            // Close connection
            $conn->close();
            ?>
    </div>
    </div>
</body>

</html>