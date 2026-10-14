<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo htmlspecialchars($pageTitle ?? "BookVerse"); ?></title>

    <!-- Favicon -->
     <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	
	<link href="https://fonts.googleapis.com/css2?family=Elms+Sans:wght@400;500;600;700&family=Righteous:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	
	<!-- Material Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php
if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION["flash_message"])):
    $flashMessage = $_SESSION["flash_message"];
    $flashType = $_SESSION["flash_type"] ?? "info";

    $alertClass = $flashType === "success" ? "success" : "danger";
    unset($_SESSION["flash_message"], $_SESSION["flash_type"]);
?>

<div class="container mt-3">
    <div class="alert alert-<?php echo $alertClass; ?> alert-dismissible fade show" role="alert">
        <?php echo htmlspecialchars($flashMessage); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button>
    </div>
</div>
<?php endif; ?>
