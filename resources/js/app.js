/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });




/*INIZIALIZZO JQUERY*/
var $ = require('jquery');


$(document).ready(function(){


    // $('#badge-new').click(function(){

    //     $('.badge').hide();
    // });

    // quando clicco l'hamburger menu
    $('.navbar-toggler').click(function(){
      // nascondo il resto della pagina
      $('.featured_apartments, footer').toggle();
  });

    /*CHIAMATA AJAX PER LONGITUDINE E LATITUDINE PER FORM CREA CASA*/
    $(document).on('click', '.ap-suggestions', function(){

        var city = $(this).text();
            //console.log(city);

        $.ajax({
            'url':'https://places-dsn.algolia.net/1/places/query',

            'method': 'GET',

            'data':{
                'X-Algolia-Application-Id': 'plHY9UTOIKXX',
                'X-Algolia-API-Key': 'b1c9ff4767e9c175969b8e601ced129d',
                'hitsPerPage': '1',
                'language': 'it',
                'query': city,
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

                    for (var field in geo) {
                        //console.log([field]);

                        if ([field] == 'lat') {

                            $('#lat').val(geo[field]);

                        }else if ([field] == 'lng'){

                            $('#lng').val(geo[field]);
                        }

                    }
                }

            },
            'error': function(error){
                alert(error);
            }
        });

    });

});


var places = require('places.js');
    var placesAutocomplete = places({
    appId: 'plHY9UTOIKXX',
    apiKey: 'b1c9ff4767e9c175969b8e601ced129d',
    container: document.querySelector('#address-input')
});
