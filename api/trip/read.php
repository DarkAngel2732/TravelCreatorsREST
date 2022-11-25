<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Trip.php';

    // Instantiate Database & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Trip object
    $trip = new Trip($db);

    // Trip query
    $result = $trip->read();
    // Get Row Count
    $num = $result->rowCount();

    // Check if there is any Trip information
    if($num > 0){
        // Trip array
        $trip_arr = array();
        $trip_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $trip_item = array(
                'id' => $id,
                'creator_firstname' => $creator_firstname,
                'creator_lastname' => $creator_lastname,
                'hotel' => $hotel,
                'country' => $country,
                'description' => $description,
                'hotel_url' => $hotel_url,
                'activity' => $activity

            );

            // Push to "data"
            array_push($trip_arr['data'], $trip_item);
        }

        //Turn to JSON
        echo json_encode($trip_arr);
    } else{
        //No trip Information
        echo json_encode(
            array('message' => 'No trip information')
        );
    }