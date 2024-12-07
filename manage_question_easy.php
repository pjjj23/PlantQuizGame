<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "floraquiz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to delete a question
if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM easy WHERE easyID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    // Redirect to refresh the page
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Fetch all questions from the database
$sql = "SELECT * FROM easy";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Easy Questions - FloraQuiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 1400px;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 2rem;
        }
        .table {
            border-radius: 10px;
            overflow: hidden;
        }
        .table th {
            background-color: #4CAF50;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
        }
        .table td {
            vertical-align: middle;
            border: none;
            transition: background-color 0.3s ease;
        }
        .table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .table tr:hover td {
            background-color: #e6f7ff;
        }
        .btn-delete {
            background-color: #ff4757;
            border-color: #ff4757;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-delete:hover {
            background-color: #ff6b81;
            border-color: #ff6b81;
            transform: scale(1.05);
        }
        .header-icon {
            font-size: 2.5rem;
            color: #4CAF50;
            margin-right: 1rem;
            animation: bounce 2s infinite;
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {transform: translateY(0);}
            40% {transform: translateY(-20px);}
            60% {transform: translateY(-10px);}
        }
        .modal-content {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .modal-header {
            background-color: #4CAF50;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .modal-footer {
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
        .fade-in {
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from {opacity: 0;}
            to {opacity: 1;}
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .action-button {
            padding: 10px 15px;
            border: none;
            border-radius: 50px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            width: 40px;
            height: 40px;
        }

        .delete-button:hover {
            background-color: #c0392b;
            transform: scale(1.1);
        }
        @media (max-width: 600px) {
            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .action-button {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
<div class="action-buttons">
    <a href="#" class="action-button back-button" onclick="goBack()">
        <i class="fas fa-arrow-left icon"></i>Back
    </a> 
</div> 
<div class="container mt-5">
        <div class="card mb-4 fade-in">
            <div class="card-body">
                <h2 class="card-title mb-4 d-flex align-items-center">
                    <i class="fas fa-leaf header-icon"></i>
                    Manage Easy Questions
                </h2>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag me-2"></i>ID</th>
                                <th><i class="fas fa-tag me-2"></i>Category</th>
                                <th><i class="fas fa-question me-2"></i>Question</th>
                                <th><i class="fas fa-list-ul me-2"></i>Type</th>
                                <th><i class="fas fa-check-circle me-2"></i>Correct Answer</th>
                                <th><i class="fas fa-star me-2"></i>Points</th>
                                <th><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$row["easyID"]."</td>";
                                    echo "<td>".$row["Ecategory"]."</td>";
                                    echo "<td>".$row["Equestion"]."</td>";
                                    echo "<td>".$row["EtypeQuestion"]."</td>";
                                    echo "<td>".$row["Ecorrectanswer"]."</td>";
                                    echo "<td>".$row["Epoint"]."</td>";
                                    echo "<td>
                                            <button type='button' class='btn btn-delete btn-sm' onclick='showDeleteModal(".$row["easyID"].")'>
                                                <i class='fas fa-trash-alt me-1'></i> Delete
                                            </button>
                                          </td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7' class='text-center'>No questions found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Single Delete Confirmation Modal -->
    <div class='modal fade' id='deleteModal' tabindex='-1' aria-labelledby='deleteModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel'>Confirm Deletion</h5>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                </div>
                <div class='modal-body'>
                    Are you sure you want to delete this question?
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cancel</button>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='id' id='deleteId'>
                        <button type='submit' name='delete' class='btn btn-danger'>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add fade-in animation to table rows
        document.addEventListener('DOMContentLoaded', (event) => {
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animation = `fadeIn 0.5s ease-out ${index * 0.1}s both`;
            });
        });

        // Function to show delete modal and set the correct ID
        function showDeleteModal(id) {
            document.getElementById('deleteId').value = id;
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
        function goBack() {
        window.location.href='create-question-easy.php';
    }
    </script>
</body>
</html>

<?php
$conn->close();
?>