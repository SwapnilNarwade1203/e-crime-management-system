<?php
session_start();
$conn = mysqli_connect("localhost", "root", "");
if (!$conn) {
    die("Could not connect: " . mysqli_error($conn));
}
mysqli_select_db($conn, "crime_portal");

if (isset($_POST['close'])) {
    $cid = $_SESSION['cid'];
    $p_id = $_SESSION['pol']; // Assuming police ID is stored in session
    $final_report = $_POST['final_report'];

    // Fetch data from the user table (joining with complaint if needed)
    $query = "SELECT u.mob, u.u_name, u.u_addr FROM user u
              JOIN complaint c ON u.a_no = c.a_no
              WHERE c.c_id='$cid' AND c.p_id='$p_id'";
    $result = mysqli_query($conn, $query);

    // Check if the result has any rows and fetch data
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $mob = $row['mob'];       // Fetch mobile number
        $u_name = $row['u_name']; // Fetch user name
        $u_addr = $row['u_addr']; // Fetch user address

        // Insert the final report into the update_case table and update the complaint status
        $qu2 = mysqli_query($conn, "INSERT INTO update_case(c_id, case_update) VALUES('$cid', '$final_report')");
        $q2 = mysqli_query($conn, "UPDATE complaint SET pol_status='ChargeSheet Filed' WHERE c_id='$cid'");

        // Send SMS using API
        $username = "padmakarzune10@gmail.com";  // Your API username
        $hash = "a834d2bedc46716f59de1105a3d9326ee62382b0df3a76f3d2223f238ffeeb17";  // Your API hash
        $sender = "TXTLCL";  // Sender ID
       // Create a simple message without template requirements
$message = "Your complaint (ID: $cid) has been closed. Final Report: $final_report"; 
$message = urlencode($message); // URL encode the message

$data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $mob . "&test=0";

// Initialize cURL with the updated URL
$ch = curl_init('https://api.textlocal.in/send/?'); 
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
curl_setopt($ch, CURLOPT_VERBOSE, true); 

// Send the request and store the result
// Send the request and store the result
$smsResult = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    echo "<script>alert('cURL Error: " . $error_msg . "');</script>";
} else {
    // Decode the JSON response
    $response = json_decode($smsResult, true);
    // Print the raw API response for debugging
    echo "<pre>Raw API Response: " . htmlspecialchars($smsResult) . "</pre>";
    
    // Check response status and handle accordingly
    if ($response['status'] === 'failure') {
        // Handle error
        if (isset($response['errors'][0]['message'])) {
            echo "<script>alert('Error: " . $response['errors'][0]['message'] . "');</script>";
        } else {
            echo "<script>alert('An unknown error occurred.');</script>";
        }
    } else {
        echo "<script>alert('Message sent successfully.');</script>";
    }
}

// Close the cURL session
curl_close($ch);

    } else {
        echo "<script>alert('No matching user data found for this complaint.');</script>";
    }
} else {
    echo "<script>alert('Invalid request.');</script>";
}
?>
