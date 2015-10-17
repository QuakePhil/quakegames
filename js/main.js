/* global myip */
/* global locations */
/* global distance */


var slider = {};
var serverlist = [];
var sorted = false;
var position = {};
var types = [];
var initialized = false;

function countGameType(typecounts, gametype) {
    if (gametype == "Proxy") return;
    if (gametype == "Qizmo") return;
    if (gametype == "Miscellaneous") return;
    if (gametype == "Quake TV") return;
    if (gametype != "") {
        if (types.indexOf(gametype) == -1) types.push(gametype);

        if (typeof typecounts[gametype] == "undefined")
            typecounts[gametype] = 1;
        else
            typecounts[gametype]++;
    }
}

function showGameTypes() {
    var typecounts = {};
    types = [];
    for (var i in serverlist) {
        countGameType(typecounts, serverlist[i].gametype1);
        countGameType(typecounts, serverlist[i].gametype2);
        countGameType(typecounts, serverlist[i].gametype3);
    }
    types.sort(function(a,b){ return typecounts[b] - typecounts[a];});
    var types_html = '';
    for (var i in types) {
        types_html += '<option value="' + types[i] + '">' + types[i] + '</option>';
    }
    $('#gameTypes').html(types_html).multiselect({
        maxHeight: 400,
        buttonWidth: "100%"
    });
    
}

function getServers(newPosition) {
    position = newPosition;

    var sliderValue = $(slider).slider('getValue');

    if(serverlist.length == 0) {
        $.post('/serverlist.php', {}, function(servers) {
            serverlist = servers;
            sorted = false;
            showGameTypes();
            showServers(sliderValue[0], sliderValue[1]);
        }, 'json');
    } else {
        showServers(sliderValue[0], sliderValue[1]);
    }
}
/*
function distance(lat1, lon1, lat2, lon2, unit) { ... }

var locations = [ ..., ad:{lat:42.31,lon:1.32}, ]
*/
function showServers(min, max) {
    for (var i in serverlist) {
        if (typeof serverlist[i].dist == "undefined")
            serverlist[i].dist = 99999;

        var server_lat = serverlist[i].latitude;
        var server_lon = serverlist[i].longitude;

        if (typeof locations[serverlist[i]] != "undefined") {
            if (server_lat == 0) server_lat = locations[serverlist[i].country].lat;
            if (server_lon == 0) server_lon = locations[serverlist[i].country].lon;
        }

        if (locations[serverlist[i].country]) serverlist[i].dist = distance(
            position.coords.latitude, 
            position.coords.longitude, 
            server_lat, 
            server_lon, 
            'K');
    }

    if (!sorted) {
        console.log('sorting...');
        serverlist.sort(function(a,b) {
            if (a.dist == b.dist) {
                return a.title.toLowerCase() > b.title.toLowerCase();
            }
            return a.dist - b.dist;
        });
        sorted = true;
    }

    var list_html = '';
    var rows = 0;

    for (var i in serverlist) {
        if (rows >= 20) break;
        var acceptability = 'list-group-item-danger';
        if (serverlist[i].dist < min) {
            acceptability = 'list-group-item-success';
        } else if (serverlist[i].dist < max) {
            acceptability = 'list-group-item-warning';
        }

        if (acceptability != 'list-group-item-danger') {
            list_html += '<button type="button" data-toggle="tooltip" data-placement="right" '
                +'title="' + Math.round(serverlist[i].dist) + 'km away" class="list-group-item '+ acceptability +'">'
                +'<span class="flag-icon flag-icon-' + serverlist[i].country + '"></span>'
                +'<span class="badge">' + serverlist[i].ip + '</span> '
                + serverlist[i].title + '</button>';
            rows++;
        }
    }
    $('#servers').html(list_html);
    //$('[data-toggle="tooltip"]').toggle();
}

function getSearches() {
    $.post('/serverlist.php', {}, function(servers) {
        var dropdown_html = '<select class="form-control">';
        for (var i in servers) {
            dropdown_html += '<option value="' + servers[i].ip + '">' + servers[i].title + '</option>';
        }
        dropdown_html += '</select>';

        $.post('/searches.php', {}, function(data) {
            var play_html = '<button type="button" onclick="alert(123)" class="btn btn-default">Play</button>'
            var html = '<table class="table">';
            for (var i in data) if (i != myip) {
                html += '<tr><td>' + i + '</td><td>' + data[i] + '</td><td>' + dropdown_html + '</td><td>' + play_html + '</td></tr>';
            }
            html += '</table>';
            $('#searches').html(html);
        }, 'json');
    }, 'json');

}

$(document).ready(function(){
/*    $('#btnPing').click(function(){
        ping($('#pingIP').val()).then(function(delta) {
            console.log(delta);
        }).catch(function(error){
            console.log('Ping error: ' + String(error))
        });
    });
*/
    $('#btnSearch').click(function(){
        var playerName;
        
        playerName = $('#playerName').val().trim();
        
        if (playerName == '') {
            alert('Enter your in-game nick first');
        } else {
            console.log('Searching');
            $.post('search.php', {playerName: playerName}, function(data){
                if (typeof data.error != "undefined") {
                    alert(data.error);
                }
            }, 'json');
        }
    });

    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    slider = $("#acceptable").slider({
        formatter: function (value) {
            if (value instanceof Array) {
                return formatNumber(value[0]) + 'km to ' + formatNumber(value[1]) + 'km';
            }
            return formatNumber(value) + 'km';
        }
    }).on('slide', function(event) {
        showServers(event.value[0], event.value[1]);
    });

    getLocation();
    // getSearches();

});
