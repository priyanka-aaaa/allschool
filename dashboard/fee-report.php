<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../login.php");
}
?>
<?php include 'header.php'; ?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Fee Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Master</li>
                <li class="breadcrumb-item active">Fee Report</li>
            </ol>
        </nav>
    </div>
    

</main>

<?php include 'footer.php'; ?>