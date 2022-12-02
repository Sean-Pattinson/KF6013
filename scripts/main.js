const myLatLng = {lat: 52.482914, lng: -1.744123 };

/**
 * Function that generate a random Latitude and Longitude
 * that is near Coast City Sports Centre to add markers to the map.
 * 
 * @param {float} min 
 * @param {float} max 
 * @returns {newLatLng}
 */
function getRandomLatLng(min, max) {

    let newLatLng = {};
    newLatLng.lat = myLatLng.lat + Math.random() * (max-min);
    newLatLng.lng = myLatLng.lng + Math.random() * (max-min);

    return newLatLng;
}

function initMap() {
    var map;
    var mapOptions = {
        center:new google.maps.LatLng(52.482914, -1.744123),
        zoom: 14,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        streetViewControl: true,
        overviewMapControl: false,
        rotateControl: false,
        scaleControl: false,
        panControl: false,
    };

    

    map = new google.maps.Map(document.getElementById('map'), mapOptions);

    new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Coast City Sports Centre",
    });

    $.getJSON("getTweets.php",function(tweetData) {

       /**
        * for each item in tweetdata assign the tweet to a variable
        * called objTweet and create and add a new marker to the map
        * with the caption tweeted by @screen_name with a random Lat
        * and Lng.
        */
        $.each(tweetData.statuses, function(i, objTweet){
            new google.maps.Marker({
                position: getRandomLatLng(0.003, 0.009),
                map,
                title: 'Tweeted by @' + objTweet.user.screen_name,
                label: (i+1).toString()
            });
            
});
    });
}



$(document).ready(function(){

    //Relative time function that returns the amount of time ago the tweet was tweeted.
    function relTime(time_value) {
        time_value = time_value.replace(/(\+[0-9]{4}\s)/ig,"");
        var parsed_date = Date.parse(time_value);
        var relative_to =
       (arguments.length > 1) ? arguments[1] : new Date();
        var timeago =
       parseInt((relative_to.getTime() - parsed_date) / 1000);
        if (timeago < 60) return 'less than a minute ago';
        else if(timeago < 120) return 'about a minute ago';
        else if(timeago < (45*60))
        return (parseInt(timeago / 60)).toString() + 'minutes ago';
        else if(timeago < (90*60)) return 'about an hour ago';
        else if(timeago < (24*60*60))
        return 'about ' + (parseInt(timeago / 3600)).toString() + ' hours ago';
        else if(timeago < (48*60*60)) return '1 day ago';
        else return (parseInt(timeago / 86400)).toString() + ' days ago';
        }

    $.getJSON("https://api.openweathermap.org/data/2.5/weather?lat=52.4829135447651&lon=-1.74412261766486&units=metric&appid=547ea9544998a84d1915c744013696e3", function(result){
        var myObj = result;
        $("#location").text(myObj.name);
        $("#condition").text(myObj.weather[0].main);
        $("#temperature").text(Math.round(myObj.main.temp) + '℃ (Feels Like: ' + Math.round(myObj.main.feels_like) + '℃)');
        $("#temperature-max").text(Math.round(myObj.main.temp_max) + '℃');
        $("#temperature-min").text(Math.round(myObj.main.temp_min) + '℃');
        $("#humidity").text(myObj.main.humidity + '%');
        $("#windspeed").text(myObj.wind.speed + ' Meters/s');
    
    })

    function getTweets() {
        //get the JSON data that is echoed out in the //getTweets.php code
        $.getJSON("getTweets.php",function(tweetData) {
    
            //Clear the data that is currently in the list of tweets.
            $("#tweet_list").empty();
    
           /**for each item in tweetdata assign the tweet to a variable
            * called objTweet
            */
            $.each(tweetData.statuses, function(i, objTweet){
                /**append the li html and tweet text to the element on
                *  the page that has the id tweet-list
                */
                
                $("#tweet_list").append("<li class='tweet' id='" + objTweet.id + "'><article><span class='twitter_profile'><img src='" + objTweet.user.profile_image_url + "'></img></span><span class='tweet_content'><h3>@" + objTweet.user.screen_name + "</h3><p>" + objTweet.text + "</p><p>Tweeted: " + relTime(objTweet.created_at) + " . " + new Date(objTweet.created_at).toLocaleDateString() + " . " +objTweet.source+"</p></span></article></li>");
            });
            });
        }

    getTweets();

    $('#refresh').click(function() {
        getTweets();
        initMap();
    });

    

})

