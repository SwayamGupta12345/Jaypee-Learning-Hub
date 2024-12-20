<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

include 'connection.php';

// Verify if the user is an admin
$email = $_SESSION['user_email'];
$stmt = $conn->prepare("SELECT is_admin FROM admin WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $stmt->bind_result($isAdmin);
    $stmt->fetch();
    if (!$isAdmin) {
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
$stmt->close();

// Fetch all news data for the dropdown - only news added by the current user
$newsItems = [];
$newsStmt = $conn->prepare("SELECT data FROM news WHERE added_by = ?");
$newsStmt->bind_param("s", $email);  // Bind current user email
$newsStmt->execute();
$newsStmt->bind_result($newsData);
while ($newsStmt->fetch()) {
    $newsItems[] = $newsData;
}
$newsStmt->close();

// Fetch selected news item details if a data item is submitted
$selectedNews = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['data_item'])) {
    $selectedData = $_POST['data_item'];
    $addedBy = $_SESSION['user_email'];  // Get the current user's email

    $stmt = $conn->prepare("SELECT data, link, end_date FROM news WHERE data = ? AND added_by = ?");
    $stmt->bind_param("ss", $selectedData, $addedBy);  // Corrected to bind both $selectedData and $addedBy
    $stmt->execute();
    $stmt->bind_result($selectedNews['data'], $selectedNews['link'], $selectedNews['end_date']);
    $stmt->fetch();
    $stmt->close();
}

// Update the news item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $currentData = $_POST['current_data'];
    $newData = $_POST['data'];
    $newLink = $_POST['link'];
    $newEndDate = $_POST['end_date'];
    $addedBy = $_SESSION['user_email'];  // Get the current user's email

    // Update news details with a check on `added_by`
    $stmt = $conn->prepare("UPDATE news SET data = ?, link = ?, end_date = ? WHERE data = ? AND added_by = ?");
    if ($stmt) {
        $stmt->bind_param("sssss", $newData, $newLink, $newEndDate, $currentData, $addedBy);  // Corrected to bind all parameters
        if ($stmt->execute()) {
            echo "<script>alert('News updated successfully.');</script>";
        } else {
            echo "<script>alert('Error updating news: " . $stmt->error . "');</script>";
        }
        $stmt->close();
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit News</title>
    <link rel="stylesheet" href="inde.css">
    <link rel="stylesheet" href="admin_panel.css">
    <link rel="stylesheet" href="add_subject.css"> 
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script>
        function validateSelection() {
            const dataItem = document.getElementById("data_item").value;
            if (!dataItem) {
                alert("Please select a news item before editing.");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <?php include "admin_nav.php"; ?>
    <div class="ap_container">
        <h1>Edit News</h1>
        
        <form method="POST" id="selectForm" class="form">
            <div class="form-group">
                <label for="data_item">Select News Data:&nbsp;&nbsp;</label>
                <select name="data_item" class = "sdata select-op" id="data_item" onchange="document.getElementById('selectForm').submit();">
                    <option value="" class="sdata1 select-op">Select a news item</option>
                    <?php foreach ($newsItems as $newsData): ?>
                        <option class = "select-op" value="<?php echo htmlspecialchars($newsData); ?>" <?php echo isset($selectedData) && $selectedData == $newsData ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($newsData); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Always Display the Buttons, Require Selection for Editing -->
        <div class="soption" style="margin-top: 20px;">
            <form method="POST" onsubmit="return validateSelection();" class="form">
                <?php if (!empty($selectedNews)): ?>
                    <input type="hidden" name="current_data select-op" value="<?php echo htmlspecialchars($selectedNews['data']); ?>">
                    <div class="form-group">
                        <label for="data">New Title:</label>
                        <textarea id="data" name="data" class = "select-op" required><?php echo htmlspecialchars($selectedNews['data']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="link">Link:</label>
                        <input type="text" id="link" name="link" class = "select-op" value="<?php echo htmlspecialchars($selectedNews['link']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:&nbsp;</label>
                        <input type="date" id="end_date" name="end_date" class = "select-op" value="<?php echo htmlspecialchars($selectedNews['end_date']); ?>">
                    </div>
                <?php endif; ?>
                <div class="button-container">
                    <input type="submit" name="update" value="Update News" class="btn-edit-news">
                    <a href="admin_panel.php" class="back btn-return-admin">Return to Admin</a>
                </div>
            </form>
        </div>
    </div>
    <?php include 'footer.php' ?>
</body>
</html>