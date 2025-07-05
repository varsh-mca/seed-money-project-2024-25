<?php
session_start();
include 'db_connection.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $staffid = $_POST['staffid'];
    $password = $_POST['password'];


    // Check in NSS table
    $query_nss = "SELECT * FROM nss_staff WHERE staffid = ? AND password = ?";
    $stmt_nss = $conn->prepare($query_nss);
    $stmt_nss->bind_param("ss", $staffid, $password);
    $stmt_nss->execute();
    $result_nss = $stmt_nss->get_result();

    if ($result_nss->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'nss_staff';
        header("Location: nss/dashboard_nss.php");
        exit();
    }

    // Check in YRC table
    $query_yrc = "SELECT * FROM yrc_staff WHERE staffid = ? AND password = ?";
    $stmt_yrc = $conn->prepare($query_yrc);
    $stmt_yrc->bind_param("ss", $staffid, $password);
    $stmt_yrc->execute();
    $result_yrc = $stmt_yrc->get_result();

    if ($result_yrc->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'yrc_staff';
        header("Location: yrc/dashboard_yrc.php");
        exit();
    }

    // Check in SSL table
    $query_ssl = "SELECT * FROM ssl_staff WHERE staffid = ? AND password = ?";
    $stmt_ssl = $conn->prepare($query_ssl);
    $stmt_ssl->bind_param("ss", $staffid, $password);
    $stmt_ssl->execute();
    $result_ssl = $stmt_ssl->get_result();

    if ($result_ssl->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'ssl_staff';
        header("Location: ssl/dashboard_ssl.php");
        exit();
    }

    // Check in other activity tables similarly (e.g., ccc_staff, egc_staff, etc.)

    // Check in CCC table
    $query_ccc = "SELECT * FROM ccc_staff WHERE staffid = ? AND password = ?";
    $stmt_ccc = $conn->prepare($query_ccc);
    $stmt_ccc->bind_param("ss", $staffid, $password);
    $stmt_ccc->execute();
    $result_ccc = $stmt_ccc->get_result();

    if ($result_ccc->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'ccc_staff';
        header("Location: ccc/dashboard_ccc.php");
        exit();
    }

    // Check in egc table
    $query_egc = "SELECT * FROM egc_staff WHERE staffid = ? AND password = ?";
    $stmt_egc = $conn->prepare($query_egc);
    $stmt_egc->bind_param("ss", $staffid, $password);
    $stmt_egc->execute();
    $result_egc = $stmt_egc->get_result();

    if ($result_egc->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'egc_staff';
        header("Location: egc/dashboard_egc.php");
        exit();
    }

    // Check in pe table
    $query_pe = "SELECT * FROM pe_staff WHERE staffid = ? AND password = ?";
    $stmt_pe = $conn->prepare($query_pe);
    $stmt_pe->bind_param("ss", $staffid, $password);
    $stmt_pe->execute();
    $result_pe = $stmt_pe->get_result();

    if ($result_pe->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'pe_staff';
        header("Location: pe/dashboard_pe.php");
        exit();
    }

    // Check in bdc_rr table
    $query_bdc_rr = "SELECT * FROM bdc_rr_staff WHERE staffid = ? AND password = ?";
    $stmt_bdc_rr = $conn->prepare($query_bdc_rr);
    $stmt_bdc_rr->bind_param("ss", $staffid, $password);
    $stmt_bdc_rr->execute();
    $result_bdc_rr = $stmt_bdc_rr->get_result();

    if ($result_bdc_rr->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'bdc_rr_staff';
        header("Location: bdc_rr/dashboard_bdc_rr.php");
        exit();
    }

    // Check in cb table
    $query_cb = "SELECT * FROM cb_staff WHERE staffid = ? AND password = ?";
    $stmt_cb = $conn->prepare($query_cb);
    $stmt_cb->bind_param("ss", $staffid, $password);
    $stmt_cb->execute();
    $result_cb = $stmt_cb->get_result();

    if ($result_cb->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'cb_staff';
        header("Location: cb/dashboard_cb.php");
        exit();
    }

    // Check in gcc table
    $query_gcc = "SELECT * FROM gcc_staff WHERE staffid = ? AND password = ?";
    $stmt_gcc = $conn->prepare($query_gcc);
    $stmt_gcc->bind_param("ss", $staffid, $password);
    $stmt_gcc->execute();
    $result_gcc = $stmt_gcc->get_result();

    if ($result_gcc->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'gcc_staff';
        header("Location: gcc/dashboard_gcc.php");
        exit();
    }

    // Check in rr table
    $query_rr = "SELECT * FROM rr_staff WHERE staffid = ? AND password = ?";
    $stmt_rr = $conn->prepare($query_rr);
    $stmt_rr->bind_param("ss", $staffid, $password);
    $stmt_rr->execute();
    $result_rr = $stmt_rr->get_result();

    if ($result_rr->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'rr_staff';
        header("Location: rr/dashboard_rr.php");
        exit();
    }

    // Check in anti table
    $query_anti = "SELECT * FROM anti_staff WHERE staffid = ? AND password = ?";
    $stmt_anti = $conn->prepare($query_anti);
    $stmt_anti->bind_param("ss", $staffid, $password);
    $stmt_anti->execute();
    $result_anti = $stmt_anti->get_result();

    if ($result_anti->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'anti_staff';
        header("Location: anti/dashboard_anti.php");
        exit();
    }

    // Check in ncc table
    $query_ncc = "SELECT * FROM ncc_staff WHERE staffid = ? AND password = ?";
    $stmt_ncc = $conn->prepare($query_ncc);
    $stmt_ncc->bind_param("ss", $staffid, $password);
    $stmt_ncc->execute();
    $result_ncc = $stmt_ncc->get_result();

    if ($result_ncc->num_rows > 0) {
        $_SESSION['staffid'] = $staffid;
        $_SESSION['role'] = 'ncc_staff';
        header("Location: ncc/dashboard_ncc.php");
        exit();
    }

    // If staff ID not found in any table
    echo "<script>alert('Invalid Staff ID or Password'); window.location.href='staff_login.html';</script>";

    // Close the connection
    $conn->close();
}
?>
