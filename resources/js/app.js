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

$(document).ready(function(){

    // quando clicco l'hamburger menu
    $('.navbar-toggler').click(function(){
        // nascondo il resto della pagina
        $('.featured_apartments, footer, .py-4, .house-map-container, .first-section-house, .upra-section').toggle();
    });

    // -----------------CODICE BANNER PROMO---------------------------
    // catturo il valore del radio button selezionato
    $('.section-promotion .input-group').on('click' , function() {
      // prendo l'inputo selezionato salvandolo in variabile
       var input_sel = $(this).children('input');
       // inposto il radio dell'input selezionato
       $(input_sel).prop("checked", true);
       // tolgo la classe a tutti gli elementi input group
       $('.input-group').removeClass('clicked').fadeIn(3000).addClass('blur-effect');
       // aggiungo la classe clicked all'elemento selezionato
       $(input_sel).parent('.input-group').toggleClass('clicked').removeClass('blur-effect');

       var test_radio = $('input[name=radio_btn]:checked').val();
       console.log(test_radio);
   });


    $('#search_homepage').val('');

    /*CHIAMATA AJAX PER LONGITUDINE E LATITUDINE PER FORM CREA CASA*/
    $(document).on('click', '.ap-suggestion',  function() {

        /* svuoto gli input */
        $('#lat').val('');
        $('#lng').val('');

        var address = $(this).text();
        //console.log(address);



        var value1 = $('#home-address-input').val();
        //console.log(value1);
        var value2 = $('#address-input-search').val();


        //console.log($('#search_homepage').val());
        $('#search_homepage').val(value1);
        $('#search_filter_page').val(value2);

        if ( $('#search_homepage').val() == value1 ){

            $('#search_home').attr('disabled', false);

        };


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
                    //console.log(geo);

                    /*assegno lat e lng a input hidden*/
                    $('#lat').val(geo.lat);
                    $('#lng').val(geo.lng);
                }

            },
            'error': function(error){
                alert(error);
            }
        });



        /* PASSARE AD AJAX OGGETTO CON FEATURES SELECTED */

        $('#btn_filter_api').click(function(){

            var address = $('#search_filter_page').val();
            console.log(address);

            /* creare un array vuoto e pushare al suo interno tutte le features */
            var features = [];

            var eventFeatures = document.forms['form'].elements['feature[]'];

            for (var i=0, len=eventFeatures.length; i<len; i++) {
                if (eventFeatures[i].checked ) {
                    features.push($(eventFeatures[i]).val());
                }
            }


            $.ajax({
                url: 'http://localhost:8000/api/index',

                method: 'GET',

                    data: {
                        'address': address,
                        'features': JSON.stringify(features)
                    },

                    success: function(data){

                        /*svuoto il contenitore delle cards*/
                        $('#container_card_ajax').html('');

                        $('#titolo-ricerca-case').text(titolo);
                        //console.log(data);

                        /*prendo il valore della ricerca*/
                        var titolo = $('#search_filter_page').val();

                        /*assegno il valore al titolo*/
                        $('#titolo-ricerca-case').text(titolo);

                        if (data.success == true) {

                            var houses = data.result;
                            //console.log(houses);

                            //salvo il template dentro a una variabile
                            var card__template = $('.card_template').html();
                            //console.log(card__template);

                            //richiamo il compile
                            var template__function = Handlebars.compile(card__template);
                            //console.log(template__function);


                            for (var i = 0; i < houses.length; i++) {
                                //console.log(movies[i]);
                                var house = houses[i];

                                console.log(house);


                                //creo oggetto con variabili
                                var obj = {
                                    'img': house.img,
                                    'img_title': house.title,
                                    'title': house.title,
                                    'address': house.address,
                                    'id': house.id,
                                    'slug': house.slug
                                }

                                //assegno l'oggetto creato
                                var html = template__function(obj);

                                //appendo con jquery il template
                                $('#container_card_ajax').append(html);

                            }


                        }else {

                            $('#container_card_ajax').append('<h3>Non ci sono case nella località selezionata!</h3>');

                        }



                    },
                    error: function(richiesta, stato, errori){

                        console.log(errori);
                    }

            });

        });
    });

});

var placesAutocomplete = places({
    appId: 'plHY9UTOIKXX',
    apiKey: 'b1c9ff4767e9c175969b8e601ced129d',
    container: document.querySelector(['#home-address-input', '#address-input', '#address-input-search']),
});
