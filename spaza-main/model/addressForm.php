<?php
use Controller\mmshightech;
if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    require_once("../controller/mmshightech.php");
    $mmshightech=new mmshightech();
    $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    $userDirect=$cur_user_row['user_type'];
    if($cur_user_row['user_type']==$userDirect){
        if(isset($_GET['map'],$_GET['spazaID'])){
            ?>
            <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
            <script>
                /**
                 * @license
                 * Copyright 2019 Google LLC. All Rights Reserved.
                 * SPDX-License-Identifier: Apache-2.0
                 */
                // This example requires the Places library. Include the libraries=places
                // parameter when you first load the API. For example:
                // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
                function initMap() {
                    const map = new google.maps.Map(document.getElementById("map"), {
                        center: { lat: 40.749933, lng: -73.98633 },
                        zoom: 13,
                        mapTypeControl: false,
                    });
                    const card = document.getElementById("pac-card");
                    const input = document.getElementById("pac-input");
                    const biasInputElement = document.getElementById("use-location-bias");
                    const strictBoundsInputElement =
                        document.getElementById("use-strict-bounds");
                    const options = {
                        fields: ["formatted_address", "geometry", "name"],
                        strictBounds: false,
                        types: ["establishment"],
                    };

                    map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

                    const autocomplete = new google.maps.places.Autocomplete(
                        input,
                        options
                    );

                    // Bind the map's bounds (viewport) property to the autocomplete object,
                    // so that the autocomplete requests use the current map bounds for the
                    // bounds option in the request.
                    autocomplete.bindTo("bounds", map);

                    const infowindow = new google.maps.InfoWindow();
                    const infowindowContent = document.getElementById("infowindow-content");

                    infowindow.setContent(infowindowContent);

                    const marker = new google.maps.Marker({
                        map,
                        anchorPoint: new google.maps.Point(0, -29),
                    });

                    autocomplete.addListener("place_changed", () => {
                        infowindow.close();
                        marker.setVisible(false);

                        const place = autocomplete.getPlace();

                        if (!place.geometry || !place.geometry.location) {
                            // User entered the name of a Place that was not suggested and
                            // pressed the Enter key, or the Place Details request failed.
                            window.alert(
                                "No details available for input: '" + place.name + "'"
                            );
                            return;
                        }

                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }

                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);
                        infowindowContent.children["place-name"].textContent = place.name;
                        infowindowContent.children["place-address"].textContent =
                            place.formatted_address;
                        infowindow.open(map, marker);
                    });

                    // Sets a listener on a radio button to change the filter type on Places
                    // Autocomplete.
                    function setupClickListener(id, types) {
                        const radioButton = document.getElementById(id);

                        radioButton.addEventListener("click", () => {
                            autocomplete.setTypes(types);
                            input.value = "";
                        });
                    }

                    setupClickListener("changetype-all", []);
                    setupClickListener("changetype-address", ["address"]);
                    setupClickListener("changetype-establishment", ["establishment"]);
                    setupClickListener("changetype-geocode", ["geocode"]);
                    setupClickListener("changetype-cities", ["(cities)"]);
                    setupClickListener("changetype-regions", ["(regions)"]);
                    biasInputElement.addEventListener("change", () => {
                        if (biasInputElement.checked) {
                            autocomplete.bindTo("bounds", map);
                        } else {
                            // User wants to turn off location bias, so three things need to happen:
                            // 1. Unbind from map
                            // 2. Reset the bounds to whole world
                            // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
                            autocomplete.unbind("bounds");
                            autocomplete.setBounds({
                                east: 180,
                                west: -180,
                                north: 90,
                                south: -90,
                            });
                            strictBoundsInputElement.checked = biasInputElement.checked;
                        }

                        input.value = "";
                    });
                    strictBoundsInputElement.addEventListener("change", () => {
                        autocomplete.setOptions({
                            strictBounds: strictBoundsInputElement.checked,
                        });
                        if (strictBoundsInputElement.checked) {
                            biasInputElement.checked = strictBoundsInputElement.checked;
                            autocomplete.bindTo("bounds", map);
                        }

                        input.value = "";
                    });
                }

                window.initMap = initMap;
            </script>
            <style>
                /**
                 * @license
                 * Copyright 2019 Google LLC. All Rights Reserved.
                 * SPDX-License-Identifier: Apache-2.0
                 */
                /*
                 * Always set the map height explicitly to define the size of the div element
                 * that contains the map.
                 */
                #map {
                    height: 100%;
                }

                /*
                 * Optional: Makes the sample page fill the window.
                 */
                html,
                body {
                    height: 100%;
                    margin: 0;
                    padding: 0;
                }

                #description {
                    font-family: Roboto;
                    font-size: 15px;
                    font-weight: 300;
                }

                #infowindow-content .title {
                    font-weight: bold;
                }

                #infowindow-content {
                    display: none;
                }

                #map #infowindow-content {
                    display: inline;
                }

                .pac-card {
                    background-color: #fff;
                    border: 0;
                    border-radius: 2px;
                    box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
                    margin: 10px;
                    padding: 0 0.5em;
                    font: 400 18px Roboto, Arial, sans-serif;
                    overflow: hidden;
                    font-family: Roboto;
                    padding: 0;
                }

                #pac-container {
                    padding-bottom: 12px;
                    margin-right: 12px;
                }

                .pac-controls {
                    display: inline-block;
                    padding: 5px 11px;
                }

                .pac-controls label {
                    font-family: Roboto;
                    font-size: 13px;
                    font-weight: 300;
                }

                #pac-input {
                    background-color: #fff;
                    font-family: Roboto;
                    font-size: 15px;
                    font-weight: 300;
                    margin-left: 12px;
                    padding: 0 11px 0 13px;
                    text-overflow: ellipsis;
                    width: 400px;
                }

                #pac-input:focus {
                    border-color: #4d90fe;
                }

                #title {
                    color: #fff;
                    background-color: #4d90fe;
                    font-size: 25px;
                    font-weight: 500;
                    padding: 6px 12px;
                }
            </style>
            <div class="pac-card" id="pac-card">
                <div>
                    <!--        <div id="title">Find your address</div>-->
                    <div hidden="" id="type-selector" class="pac-controls">
                        <input hidden=""
                               type="radio"
                               name="type"
                               id="changetype-all"
                               checked="checked"
                        />
                        <label hidden="" for="changetype-all">All</label>

                        <input hidden="" type="radio" name="type" id="changetype-establishment" />
                        <label hidden="" for="changetype-establishment">establishment</label>

                        <input hidden="" type="radio" name="type" id="changetype-address" />
                        <label hidden="" for="changetype-address">address</label>

                        <input hidden="" type="radio" name="type" id="changetype-geocode" />
                        <label hidden="" for="changetype-geocode">geocode</label>

                        <input  hidden="" type="radio" name="type" id="changetype-cities" />
                        <label hidden="" for="changetype-cities">(cities)</label>

                        <input hidden="" type="radio" name="type" id="changetype-regions" />
                        <label hidden="" for="changetype-regions">(regions)</label>
                    </div>
                    <div hidden="" id="strict-bounds-selector" class="pac-controls">
                        <input hidden="" type="checkbox" id="use-location-bias" value="" checked />
                        <label  hidden="" for="use-location-bias">Bias to map viewport</label>
                        <input hidden="" type="checkbox" id="use-strict-bounds" value="" />
                        <label hidden="" for="use-strict-bounds">Strict bounds</label>
                    </div>
                </div>
                <div id="pac-container">
                    <input style="padding: 10px 10px;" id="pac-input" class="pac-input" type="text" placeholder="Enter a location" />
                </div>
            </div>
            <div id="map" style="height: 90%;"></div>
            <div id="infowindow-content">
                <span id="place-name" class="title"></span><br />
                <span id="place-address"></span>
            </div>
            <div style="padding: 10px 10px;width: 100%;">
                <style>
                    .setAddress{
                        width: 100%;
                        padding: 10px 10px;
                        color: white;
                        background: navy;
                        border-radius: 20px;
                        text-script: center;
                        font-weight: bolder;
                        font-size: large;
                        text-align: center;
                    }
                    .setAddress:hover{
                        border: 2px solid navy;
                        background: #dddddd;
                        color: navy;
                    }
                </style>
                <div class="setAddress" onclick="setAddress('<?php echo $_GET['map']?>','<?php echo $_GET['spazaID']?>')">Set Address</div>

            </div>
            <script
                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB89PxjqngFvCG66ljG_CLVc3oQlzk0YBI&callback=initMap&libraries=places&v=weekly"
                    defer
            ></script>
            <?php
        }
        else{
            echo"UNKNOWN REQUEST!!";
        }
    }
    else{
        session_destroy();
        ?>
        <script>
            window.location=("../");
        </script>
        <?php
    }
}
else{
    session_destroy();
    ?>
    <script>
        window.location=("../");
    </script>

    <?php
}
?>