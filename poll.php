<?php
session_start();
require_once('pdo_config.php'); // Include your database configuration file

// Initialize the response array
$response = [];

// Check if the user has already voted
if (isset($_SESSION['userid']) && hasUserVoted($_SESSION['userid'])) { 
    // If the user has already voted, add an error message to the response
    $response['error'] = 'You have already voted, but you can change your option.';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle the vote submission
        if (isset($_POST['vote'])) {
            $vote = $_POST['vote'];
            $user_id = $_SESSION['userid'];

            // Store the vote in the database
            $stmt = $pdo->prepare("UPDATE poll_votes
            SET vote_option = ?
            WHERE user_id = ?");
            $stmt->execute([$vote, $user_id]);

        }
    }
} else {
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Handle the vote submission
        if (isset($_POST['vote'])) {
            $vote = $_POST['vote'];
            $user_id = $_SESSION['userid'];

            // Store the vote in the database
            $stmt = $pdo->prepare("INSERT INTO poll_votes (user_id, vote_option) VALUES (?, ?)");
            $stmt->execute([$user_id, $vote]);

        }
    }
}

// Get and add the poll results to the response
$stmt = $pdo->query("SELECT vote_option, COUNT(*) as count FROM poll_votes GROUP BY vote_option");
$pollResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
$response['pollResults'] = $pollResults;

// Encode the response as JSON and echo it
echo json_encode($response);

// Function to check if the user has voted
function hasUserVoted($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM poll_votes WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $count = $stmt->fetchColumn();
    return $count > 0;
}
?>
