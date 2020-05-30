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

        
       

        <?php
            if(isset($mapa)){
        ?>
        <script>
            var longitud = -56.732051948450575;
            var latitud = -34.33235873819117;
            var zoom = 5;
            var markerModal;
            var markerMapaPrincipal;

            // Crea el mapa principal
            mapboxgl.accessToken = 'pk.eyJ1IjoidHJpcGRvIiwiYSI6ImNrYWpuOG5iYTAzeDEycG4xcTg0Y2N0YjMifQ.iZfqiqKWwbtqynAoSICDEw';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                antialias: true,
                center: [longitud, latitud],
                zoom: zoom
            });
            
            // Crea el mapa del modal
            var map2 = new mapboxgl.Map({
                container: 'map2',
                style: 'mapbox://styles/mapbox/streets-v11',
                antialias: true,
                center: [longitud, latitud],
                zoom: 8
            });

            //Capturar las coordenadas del puntero del raton
            map2.on('click', function (e) {          
                document.getElementById('input-latitud').value = e.lngLat.lat;
                document.getElementById('input-longitud').value = e.lngLat.lng;
                if(markerModal != null){
                    markerModal.remove();
                }                
                markerModal = new mapboxgl.Marker({draggable: false}).setLngLat([e.lngLat.lng, e.lngLat.lat])                            
                            .addTo(map2);                               
            });

            // Agrega un marcador al hacer click en "ver en el mapa"
            function verMarcador(longitud, latitud){
                if(markerMapaPrincipal != null){
                    markerMapaPrincipal.remove();
                }                
                markerMapaPrincipal = new mapboxgl.Marker({draggable: false}).setLngLat([longitud, latitud])                            
                            .addTo(map); 
                map.setCenter([longitud, latitud]);
                map.setZoom(12);
            }

            //Agrega el cuadro de buscar en el mapa principal
            map.addControl(
                new MapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    localGeocoder: forwardGeocoder,
                    zoom: 14,
                    placeholder: 'Buscar ciudad',
                    mapboxgl: mapboxgl
                })
            );
            
            // Agrega el cuadro de busqueda en el mapa del modal
            map2.addControl(
                new MapboxGeocoder({
                    accessToken: mapboxgl.accessToken,
                    localGeocoder: forwardGeocoder,
                    zoom: 14,
                    placeholder: 'Buscar ciudad',
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
    </body>
</html>