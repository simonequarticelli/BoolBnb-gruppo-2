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


            var value1 = $('#home-address-input').val();
            var value2 = $('#address-input-search').val();

            $('#search_homepage').val(value1);
            $('#search_filter_page').val(value2);


        },
        'error': function(error){
            alert(error);
        }
    });

  });

    

    /* PASSARE AD AJAX OGGETTO CON FEATURES SELECTED */ 

        // CODE ...




    $('#btn_filter_api').click(function(){

        var address = $('#search_filter_page').val();

        $.ajax({
            url: 'http://localhost:8000/api/index',

            method: 'GET',

            data: {
                'address': address
            },

            success: function(data){

                console.log(data);

                var houses = data.result;
                console.log(houses);

                /*prendo il valore della ricerca*/
                var titolo = $('#search_filter_page').val();
                /*assegno il valore al titolo*/
                $('#titolo-ricerca-case').text(titolo);
                /*svuoto il contenitore delle cards*/
                $('.first-card-container').empty();

                // //salvo il template dentro a una variabile
                // var card__template = $('.card_template').html();
                // //richiamo il compile
                // var template__function = Handlebars.compile(card__template);
                
                
                for (var i = 0; i < houses.length; i++) {
                    //console.log(movies[i]);
                    var house = houses[i];
                    $('.card').append(house.title);

                    // //creo oggetto con variabili
                    // var obj = {
                    //     'img': var1,
                    //     'img_title': var2,
                    //     'title': var3,
                    //     'id': var4,
                    //     'slug': var5
                    // }

                    // //assegno l'oggetto creato
                    // var html = template__function(obj);
                    // //appendo con jquery il template
                    // $('.card_container').append(html);
                }

            },
            error: function(){

    

            }
        });
    });

});
