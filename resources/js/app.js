require('./bootstrap');

// window.Vue = require('vue');

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// const app = new Vue({
//     el: '#app',
// });

/*INIZIALIZZO JQUERY*/
var $ = require('jquery');

/*INIZIALIZZO ALGOLIA*/
var places = require('places.js');

var placesAutocomplete = places({
    appId: 'plHY9UTOIKXX',
    apiKey: 'b1c9ff4767e9c175969b8e601ced129d',
    container: document.querySelector(['#home-address-input', '#address-input', '#address-input-search']),
});

// var placesAutocomplete = places({
//     appId: 'plHY9UTOIKXX',
//     apiKey: 'b1c9ff4767e9c175969b8e601ced129d',
//     container: document.querySelector('#address-input')
// });



$(document).ready(function(){
    // quando clicco l'hamburger menu
    $('.navbar-toggler').click(function(){
        // nascondo il resto della pagina
        $('.featured_apartments, footer, .py-4, .house-map-container, .first-section-house, .upra-section').toggle();
    });


  /*CHIAMATA AJAX PER LONGITUDINE E LATITUDINE PER FORM CREA CASA*/
  $(document).on('click', '.ap-suggestion',  function(){

    $('#lat').val('');
    $('#lng').val('');

    var address = $(this).text();
        console.log(address);

    $.ajax({
        'url':'https://places-dsn.algolia.net/1/places/query',

        'method': 'GET',

        'data':{
            'X-Algolia-Application-Id': 'plHY9UTOIKXX',
            'X-Algolia-API-Key': 'b1c9ff4767e9c175969b8e601ced129d',
            'language': 'it',
            'hitsPerPage': '1',
            'query': address
        },
        'success': function(data){

            //console.log(data.hits);
            //console.log(data);
            var info = data.hits;
            //console.log(info);



            for (var i = 0; i < info.length; i++) {
                var data = info[i];
                //console.log(data._geoloc);
                var geo = data._geoloc;
                console.log(geo);

                /*assegno lat e lng a input hidden*/
                $('#lat').val(geo.lat);
                $('#lng').val(geo.lng);
            }


            var value = $('#home-address-input').val();

            $('#search_homepage').val(value);


        },
        'error': function(error){
            alert(error);
        }
    });

  });

    $('.features').on('click', function () {
        var marchi = {};

        $('.features:checked').each(function () {
            marchi[$(this).attr('name')] = $(this).val();
        });

        console.log(marchi);


    // var tempData = {};
    // for ( var index in data ) {

    //     tempData[index] = data;

    // }
    // data = tempData;

    });

    $('#btn_filter_api').click(function(){

        $.ajax({
            url: 'http://localhost:8000/api/index',

            method: 'GET',

            data: {
                'features': 'i dati sono passati'
            },

            success: function(data){

                console.log(data);

                // $('.card').empty();
                // var houses = data.result;
                // console.log(houses);
                // for (var i = 0; i < houses.length; i++) {
                //     //console.log(movies[i]);
                //     var house = houses[i];
                //     $('.card').append('<li>' + house.title + ' - ' + house.address + '</li>');
                // }

            },
            error: function(){
            'error'
            }
        });
    });

});
