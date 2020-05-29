        <footer class="footer">
            <div class="container">
                <div class="row">
                    <!-- Footer Column -->
                    <div class="col-lg-8 footer_col">
                        <div class="footer_about">
                            <!-- Logo -->
                            <div class="logo_container">
                                <div class="logo">
                                    <div>destino</div>
                                    <div>travel agency</div>
                                    <div class="logo_image"><img src="<?= base_url()?>/public/images/logo.png" alt=""></div>
                                </div>
                            </div>
                            <div class="footer_about_text">
                                Et consiliumque facere, ut ædificaretur erit TripDo® dicitur, quod sino users creare, manage, et participes peregrinatione itineraries.
                                Situm visitatores ad videre poterit diversis options commendatae a peregrinatione templo laetus senatus, tum itinerum fecere ab TripDo voted summa civitatem. Sed ut satus per partum peregrinatione itineribus, necesse erit ut relatus et ad profile.
                            </div>
                            <div class="copyright">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>document.write(new Date().getFullYear());</script> Todos los derechos reservados | 
                                Esta plantilla está hecha con <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>
                        </div>
                    </div>
                    <!-- Footer Column -->
                    <div class="col-lg-4 footer_col">
                        <div class="tags footer_tags">
                            <div class="footer_title">Tags</div>
                            <ul class="tags_content d-flex flex-row flex-wrap align-items-start justify-content-start">
                                <?php //Muestro cada tag y pongo el enlace a una busqueda por ese tag. Le pongo el urlencode() para evitar problemas con los espacios
                                    foreach ($footerTags as $t){
                                ?>
                                <li class="tag"><a href="<?= base_url('/busqueda?keywords=') . urlencode($t) ?>"><?= $t ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="<?= base_url()?>public/js/jquery-3.2.1.min.js"></script>
        <script src="<?= base_url()?>public/styles/bootstrap4/popper.js"></script>
        <script src="<?= base_url()?>public/styles/bootstrap4/bootstrap.min.js"></script>

        <script src="<?= base_url()?>public/plugins/greensock/TweenMax.min.js"></script>
        <script src="<?= base_url()?>public/plugins/greensock/TimelineMax.min.js"></script>
        <script src="<?= base_url()?>public/plugins/scrollmagic/ScrollMagic.min.js"></script>
        <script src="<?= base_url()?>public/plugins/greensock/animation.gsap.min.js"></script>
        <script src="<?= base_url()?>public/plugins/greensock/ScrollToPlugin.min.js"></script>
        <script src="<?= base_url()?>public/plugins/easing/easing.js"></script>
        <script src="<?= base_url()?>public/plugins/progressbar/progressbar.min.js"></script>
        <script src="<?= base_url()?>public/plugins/parallax-js-master/parallax.min.js"></script>
        <script src="<?= base_url()?>public/js/elements_custom.js"></script>
        <script src="<?= base_url()?>public/js/custom.js"></script>

        <?php
            if(isset($mapa)){
        ?>
        <script>
            var longitud = -56.732051948450575;
            var latitud = -34.33235873819117;
            var zoom = 14;

            mapboxgl.accessToken = 'pk.eyJ1IjoidHJpcGRvIiwiYSI6ImNrYWpuOG5iYTAzeDEycG4xcTg0Y2N0YjMifQ.iZfqiqKWwbtqynAoSICDEw';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                antialias: true,
                center: [longitud, latitud],
                zoom: zoom
            });
            

            //Crear un popup para usar en el marcador
            var popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
                '<a href="http://localhost/laboratorio-php/tripdo"><img src="http://localhost/test-mapa/public/imagen.jpg" width="200" alt="Locomotora" /><h5 style="text-align: center">Hola mundo</h5></a>'
            );

            //Crear y agregar al mapa un marcador con el popup 
            var marker = new mapboxgl.Marker({draggable: false}).setLngLat([longitud, latitud])
                            .setPopup(popup)
                            .addTo(map);

            //Capturar las coordenadas del puntero del raton
            map.on('mousemove', function (e) {
                document.getElementById('coordenadas').innerHTML =
                    JSON.stringify(e.lngLat);
            });

            //Agregar control de geocoder para hacer busquedas en el mapa
            // map.addControl(new MapboxGeocoder({
            //     accessToken: mapboxgl.accessToken
            // }));

            // map.addControl(
            //     new MapboxGeocoder({
            //         accessToken: mapboxgl.accessToken,
            //         localGeocoder: forwardGeocoder,
            //         zoom: 14,
            //         placeholder: 'Enter search e.g. Lincoln Park',
            //         mapboxgl: mapboxgl
            //     })
            // );       
                        
            var customData = {
                    'features': [
                        {
                            'type': 'Feature',
                            'properties': {
                                'title': 'Casa Dominga, San José de Mayo, Uruguay',
                                'description': 'Somos una institución que busca promover la cultura en el sentido más amplio.'
                            },
                            'geometry': {
                                'coordinates': [-56.7145, -34.340007],
                                'type': 'Point'
                            }
                        },
                        {
                            'type': 'Feature',
                            'properties': {
                                'title': 'Mal Abrigo, Uruguay',
                                'description': "En el año 2015, Mal Abrigo es seleccionado por el Ministerio de Turismo para el Premio Pueblo Turístico, el cual apunta al desarrollo local."
                            },
                            'geometry': {
                                'coordinates': [-56.952087, -34.147616],
                                'type': 'Point'
                            }
                        },
                        {
                            'type': 'Feature',
                            'properties': {
                                'title': 'Parque Rodó, San José de Mayo, Uruguay',
                                'description': "Inaugurado el 25 de agosto de 1903 con el nombre de «Parque Mario» por iniciativa del doctor italiano Francisco Giampietro haciendo honor a su hermano sacerdote."
                            },
                            'geometry': {
                                'coordinates': [-56.730451, -34.331115],
                                'type': 'Point'
                            }
                        },
                        {
                            'type': 'Feature',
                            'properties': {
                                'title': 'Finca Piedra, San José, Uruguay',
                                'description': "Una exclusiva estancia eco-turística, donde las 20 hectáreas de selectos viñedos son su mayor encanto."
                            },
                            'geometry': {
                                'coordinates': [-56.9549075, -34.1374848],
                                'type': 'Point'
                            }                
                        },
                        {
                            'type': 'Feature',
                            'properties': {
                                'title': 'Barras de Mahoma, San José, Uruguay',
                                'description': "Un lugar para vivir en armonía con una naturaleza que te invita a producir y soñar."
                            },
                            'geometry': {
                                'coordinates': [-56.88552, -34.060117],
                                'type': 'Point'
                            }                
                        },
                        {
                            'type': 'Feature',
                            'properties': {
                                'title': 'Museo de San José, Uruguay',
                                'description': "Construido en la primera década del S XIX. Fue declarado monumento histórico el 21 de noviembre de 1989."
                            },
                            'geometry': {
                                'coordinates': [-56.714387, -34.337911],
                                'type': 'Point'
                            }                
                        },
                        {
                            'type': 'Feature',
                            'properties': {
                                'title': 'Basílica Catedral, San José de Mayo, Uruguay',
                                'description': "Bendecida el 24 de marzo de 1875 La obra se inició en el año 1857 y finalizó en 1874 Fue declarada monumento histórico el 24 de octubre de 1990."
                            },
                            'geometry': {
                                'coordinates': [-56.713478, -34.340111],
                                'type': 'Point'
                            }                
                        }
                ],
                'type': 'FeatureCollection'
            };

            function forwardGeocoder(query) {
                var matchingFeatures = [];
                for (var i = 0; i < customData.features.length; i++) {
                    var feature = customData.features[i];
                    // handle queries with different capitalization than the source data by calling toLowerCase()
                    if (feature.properties.title.toLowerCase().search(query.toLowerCase()) !== -1 ) {
                        // add a tree emoji as a prefix for custom data results
                        // using carmen geojson format: https://github.com/mapbox/carmen/blob/master/carmen-geojson.md
                        feature['place_name'] = '🌲 ' + feature.properties.title;
                        feature['center'] = feature.geometry.coordinates;
                        feature['place_type'] = ['park'];
                        matchingFeatures.push(feature);
                    }
                }
                return matchingFeatures;
            }

            map.addControl(
                new MapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    localGeocoder: forwardGeocoder,
                    zoom: 14,
                    placeholder: 'Ingresa casa dominga',
                    mapboxgl: mapboxgl
                })
            );

            //Agregar controles al mapa con geolocalización y la opcion de pantalla completa
            map.addControl(new mapboxgl.NavigationControl());
            map.addControl(new mapboxgl.FullscreenControl());
         
        </script> 

        <?php
            }
        ?>
    </body>
</html>