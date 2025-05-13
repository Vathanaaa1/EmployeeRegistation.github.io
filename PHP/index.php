<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Form</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            color: #333;
        }

        h2 {
            margin: 20px 0;
            font-size: 28px;
            color: #007bff;
        }

        h3 {
            color: #444;
            margin-top: 40px;
        }

        p {
            font-size: 16px;
            margin-top: 10px;
        }

        .navbar {
            background-color: #0056b3;
            overflow: hidden;
            text-align: left;
            padding: 0 20px;
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
            width: 100%;
        }

        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .navbar a:hover {
            background-color: #003d80;
            color: white;
        }

        form {
            background: white;
            padding: 30px;
            width: 60%;
            margin: 30px auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            border-radius: 15px;
        }

        input, textarea, select {
            width: 90%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: 0.3s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0,123,255,0.5);
        }

        .form-buttons input {
            width: 30%;
            margin: 5px 10px;
        }

        input[type="submit"], .btn {
            background: #007bff;
            color: white;
            cursor: pointer;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: bold;
            transition: 0.3s;
        }

        input[type="submit"]:hover, .btn:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        table {
            width: 80%;
            margin: 30px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px gray;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        tr:hover {
            background-color: #e9f5ff;
            cursor: pointer;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<!-- ✅ Menu Bar -->
<div class="navbar">
    <a href="#">Home</a>
    <a href="/about.php">About</a>
</div>

<h2>Employee Registration Form</h2>
<form method="post" id="employeeForm">
    <!-- ✅ Input ID Added Above Name -->
    <label>Employee ID:</label>
    <input type="number" name="id" id="id" placeholder="Enter ID for update or search"><br><br>


    <label>Name:</label>
    <input type="text" name="name" id="name" required><br><br>

    <label>Gender:</label>
    <select name="gender" id="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br><br>

    <label>Position:</label>
    <input type="text" name="position" id="position" required><br><br>

    <label>Salary:</label>
    <input type="number" name="salary" id="salary" step="0.01" required><br><br>

    <label>Address:</label>
    <textarea name="address" id="address" required></textarea><br><br>

    <div class="form-buttons">
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="update" value="Update" class="btn">
        <input type="submit" name="search" value="Search" class="btn">
    </div>
</form>

<!-- PHP part stays unchanged -->
<!-- JavaScript stays unchanged -->
 <?php
$servername = "localhost";
$username = "root";
$password = "96699669";
$database = "db_employee";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database, $port);
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Delete
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $conn->query("DELETE FROM tb_employee WHERE ID = $delete_id");
    echo "<p style='color:red;'>🗑️ Deleted record ID $delete_id</p>";
}

// Insert
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("INSERT INTO tb_employee (Name, Gender, Position, Salary, Address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssds", $name, $gender, $position, $salary, $address);
    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Employee registered successfully.</p>";
    } else {
        echo "<p style='color:red;'>❌ Insert error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Update
if (isset($_POST['update']) && !empty($_POST['id'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $address = $_POST['address'];

    $stmt = $conn->prepare("UPDATE tb_employee SET Name=?, Gender=?, Position=?, Salary=?, Address=? WHERE ID=?");
    $stmt->bind_param("sssdsi", $name, $gender, $position, $salary, $address, $id);
    if ($stmt->execute()) {
        echo "<p style='color:orange;'>✏️ Employee updated successfully.</p>";
    } else {
        echo "<p style='color:red;'>❌ Update error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}


// Search by ID only
if (isset($_POST['search']) && !empty($_POST['id'])) {
    $searchId = $_POST['id'];
    $stmt = $conn->prepare("SELECT * FROM tb_employee WHERE ID = ?");
    $stmt->bind_param("i", $searchId);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query("SELECT * FROM tb_employee");
}



// Display table
if ($result->num_rows > 0) {
    echo "<h3>📋 Employee List</h3>";
    echo "<table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Position</th>
                <th>Salary</th>
                <th>Address</th>
                <th>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr data-id='{$row['ID']}' data-name='{$row['Name']}' data-gender='{$row['Gender']}' data-position='{$row['Position']}' data-salary='{$row['Salary']}' data-address='{$row['Address']}'>
                <td>{$row['ID']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Gender']}</td>
                <td>{$row['Position']}</td>
                <td>{$row['Salary']}</td>
                <td>{$row['Address']}</td>
                <td>
                    <form method='post' onsubmit='return confirm(\"Are you sure?\")'>
                        <input type='hidden' name='delete_id' value='{$row['ID']}'>
                        <input type='submit' value='Delete' class='delete-btn'>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:gray;'>No records found.</p>";
}
$conn->close();
?>

<script>
document.querySelectorAll("tr[data-id]").forEach(row => {
    row.addEventListener("click", () => {
        document.getElementById("id").value = row.dataset.id;
        document.getElementById("name").value = row.dataset.name;
        document.getElementById("gender").value = row.dataset.gender;
        document.getElementById("position").value = row.dataset.position;
        document.getElementById("salary").value = row.dataset.salary;
        document.getElementById("address").value = row.dataset.address;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
</script>

</body>
</html>
