<?php
    function connect() {
        $host = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "phpserver";
        $conn = new mysqli($host, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("connection error: ".$conn->connect_error);
        }
        return $conn;
    }

    function getLastBeat($conn) {
        $query = "SELECT * FROM heartbeat WHERE customer_id = '1'";
        $result = $conn->query($query);
        $lastHeartbeat = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lastHeartbeat = $row["value"];
            }
        }
        return $lastHeartbeat;
    }

    function getLastTemp($conn) {
        $query = "SELECT * FROM temperature WHERE customer_id = '1'";
        $result = $conn->query($query);
        $lastTemperature = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $lastTemperature = $row["value"];
            }
        }
        return $lastTemperature;
    }

    $conn = connect();
    $result->heartbeat = getLastBeat($conn);
    $result->temperature = getLastTemp($conn);

    echo json_encode($result);
    $conn->close();
?>
