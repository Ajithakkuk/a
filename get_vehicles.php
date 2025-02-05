<?php
include 'includes/config.php';

header('Content-Type: application/json');

try {
    $sql = "SELECT id, VehiclesType, VehiclesTitle, VehiclesBrand, PricePerDay, FuelType, ModelYear, SeatingCapacity, VehiclesOverview, VehiclesBranch, Vimage1 FROM vehicles";
    
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($vehicles)) {
        echo json_encode(["success" => false, "message" => "No vehicles found"]);
    } else {
        echo json_encode(["success" => true, "vehicles" => $vehicles]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
?>
