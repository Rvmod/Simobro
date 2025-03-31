<?php
header('Content-Type: application/json');

if (isset($_POST['game'], $_POST['user_key'], $_POST['serial'])) {
    
    $game = $_POST['game'];
    $user_key = $_POST['user_key'];
    $serial = $_POST['serial'];
    
    // Only allow login if the user_key is @RV_OWNER or PAPA_IS_BACK
    $allowed_keys = ["@RV_OWNER", "PAPA_IS_BACK"];
    if (!in_array($user_key, $allowed_keys)) {
        echo json_encode([
            "status" => false,
            "message" => "Invalid user key. Access denied."
        ]);
        exit;
    }
    
    $real = "$game-$user_key-$serial-Vm8Lk7Uj2JmsjCPVPVjrLa7zgfx3uz9E";
    $token = md5($real);
    $rng = time() + 100000;
    
    $response = [
        "status" => true,
        "data" => [
            "real" => $real,
            "token" => $token,
            "rng" => $rng,
            "ts" => date("Y-m-d H:i:s", time() + 100000)  // New timestamp
        ]
    ];
    
    echo json_encode($response);

} else {
    echo json_encode([
        "status" => false,
        "message" => "Missing required parameters."
    ]);
}
?>