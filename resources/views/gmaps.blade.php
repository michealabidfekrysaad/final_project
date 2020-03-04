<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="http://maps.google.com/maps/api/js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>
    <style type="text/css">
        #mymap {
            border: 1px solid red;
            width: 1400px;
            height: 800px;
        }
    </style>


</head>
<body>
<div id="mymap"></div>
<script type="text/javascript">
    var results = <?php print_r(json_encode($results)) ?>;

    for (let i = 0; i < results.length; i++) {
        var mymap = new GMaps({
            el: '#mymap',
            lat: (results[i].city).lat,
            lng: (results[i].city).lng,
            zoom: 7
        });
    }
    $.each(results, function (index, value) {
        mymap.addMarker({
            lat: (value.city).lat,
            lng: (value.city).lng,
            title: "Number Of Lost People= " + value.total,
            click: function (e) {
                alert('Number Of Lost People= ' + value.total + ' In ' + (value.city).city_name + ', From Egypt.');
            }
        });
    });


</script>


</body>
</html>
