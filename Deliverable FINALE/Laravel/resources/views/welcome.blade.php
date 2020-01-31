<!DOCTYPE html >
<head>

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <li><a href="home">Esci</a></li>
    <title>MyUniMaps</title>
    <h1>MyUniMaps</h1>

</head>


<nav class="navigation">
    <ul class="mainmenu">
        <li><a href="">Cerca</a>
            <ul class ="submenu">
                <form name=”casellaTesto” method=”post” action=””>
                    <li> <a href =""><input type=”text” name=”nomeCasella” value=”Search” size=”40″ maxlength=”60″></a>
            </ul>
        <li><a href="">Dipartimenti</a>
            <ul class ="submenu">
                <li><a href="">Disim</a></li>
                <ul class href="submenu">
                    <li> <a href ="">Edifici</a></li>
                    <ul class ="submenu">
                        <li><a href="">Blocco 0</a></li>
                        <li><a href="">Coppito 1</a></li>
                        <li><a href="">Coppito 2</a></li>
                    </ul>
                    <li> <a href ="">Foto</a></li>
                </ul>
                <li><a href="">Discab</a></li>
                <ul class href="submenu">
                    <li> <a href ="">Edifici</a></li>
                    <li> <a href ="">Foto</a></li>
                </ul>
            </ul>
        </li>
        <li><a href="">POI</a>
            <ul class="submenu">
                <li><a href="">Bar</a></li>
                <li><a href="">Wi-Fi Points</a></li>
                <li><a href="">Segreterie</a></li>
                <li><a href="">Mense</a></li>
                <li><a href="">Punti Informativi</a></li>
                <li><a href="">Biblioteche</a></li>
                <li><a href="">Fermate bus</a></li>
            </ul>
        </li>

    </ul>
</nav>


 <style>
     html, body {
         font-family: Arial, Helvetica, sans-serif;
     }

     /* define a fixed width for the entire menu */
     .navigation {
         width: 300px;
         float: left;

     }

     /* reset our lists to remove bullet points and padding */
     .mainmenu, .submenu {
         list-style: none;
         padding: 0;
         margin:  0;
         color: #C5C5C5;

     }

     /* make ALL links (main and submenu) have padding and background color */
     .mainmenu a {
         display: block;
         background-color: #999;
         text-decoration: none;
         padding: 10px;
         color: #000;
         text-align: left;
         list-style: none;
     }

     /* add hover behaviour */
     .mainmenu a:hover {
         background-color: #C5C5C5;

     }


     /* when hovering over a .mainmenu item,
       display the submenu inside it.
       we're changing the submenu's max-height from 0 to 200px;
     */

     .mainmenu li:hover .submenu {

         max-height: none;

     }

     /*
       we now overwrite the background-color for .submenu links only.
       CSS reads down the page, so code at the bottom will overwrite the code at the top.
     */

     .submenu a {
         background-color: #C5C5C5;
     }

     /* hover behaviour for links inside .submenu */
     .submenu a:hover {
         background-color: #666;
     }

     /* this is the initial state of all submenus.
       we set it to max-height: 0, and hide the overflowed content.
     */
     .submenu {
         overflow: hidden;
         max-height: 0;
         -webkit-transition: all 0.5s ease-out;
     }
 </style>
    <style>

        html {
            /*background: rgb(0,191,255);
            background: linear-gradient(180deg, rgba(0,191,255,1) 0%, rgba(247,249,250,1) 100%);
        */
            background: rgb(179,255,244);
            background: linear-gradient(180deg, rgba(179,255,244,1) 1%, rgba(21,77,85,1) 96%, rgba(100,118,119,1) 100%);}
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
         display: block;

            height: 400px;
            width: 600px;

            margin-right: 100px;
            margin-top: 20px;
            margin-left: 550px;
            padding: 10px;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            display: block;
            height: 100%;
            margin-right: 0px;
            margin-top: 0px;
            margin-left: 0px;
            padding: 10px;
        }




    </style>


</div>
<div id="map"> </div>

<script>
    var customLabel = {
        restaurant: {
            label: 'R'
        },
        bar: {
            label: 'B'
        }
    };

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 42.368713, lng: 13.350792,},

            zoom: 17
        });
        var infoWindow = new google.maps.InfoWindow;

        // Change this depending on the name of your PHP or XML file
        downloadUrl('https://storage.googleapis.com/mapsdevsite/json/mapmarkers2.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
                var id = markerElem.getAttribute('id');
                var name = markerElem.getAttribute('name');
                var address = markerElem.getAttribute('address');
                var type = markerElem.getAttribute('type');
                var point = new google.maps.LatLng(
                    parseFloat(markerElem.getAttribute('lat')),
                    parseFloat(markerElem.getAttribute('lng')));

                var infowincontent = document.createElement('div');
                var strong = document.createElement('strong');
                strong.textContent = name
                infowincontent.appendChild(strong);
                infowincontent.appendChild(document.createElement('br'));

                var text = document.createElement('text');
                text.textContent = address
                infowincontent.appendChild(text);
                var icon = customLabel[type] || {};
                var marker = new google.maps.Marker({
                    map: map,
                    position: point,
                    label: icon.label
                });
                marker.addListener('click', function() {
                    infoWindow.setContent(infowincontent);
                    infoWindow.open(map, marker);
                });
            });
        });
    }

function doNothing() {
;
}

    function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
            if (request.readyState == 4) {
                request.onreadystatechange = doNothing();
                callback(request, request.status);
            }
        };

        request.open('GET', url, true);
        request.send(null);
    }


</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB44grTIE8zFYy3l1VxQtJUNRHeUlL80QI&callback=initMap">
</script>

