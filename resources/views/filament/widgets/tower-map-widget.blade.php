<x-filament-widgets::widget>
    <x-filament::card>
        {{-- Load Mapbox CSS --}}
        <link href='https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css' rel='stylesheet' />

        {{-- Alpine.js component to initialize the map --}}
        <div
            x-data="{
                initMap: function() {
                    if (typeof mapboxgl === 'undefined') {
                        console.error('Mapbox GL JS is not loaded yet.');
                        return;
                    }
                    mapboxgl.accessToken = '{{ config('services.mapbox.token') }}';
                    const map = new mapboxgl.Map({
                        container: this.$refs.mapContainer,
                        style: 'mapbox://styles/mapbox/standard',
                        center: [102.7, -1.8], // Fokus ke Jambi
                        zoom: 8 // Zoom level provinsi
                    });

                    map.addControl(new mapboxgl.NavigationControl());

                    map.on('load', () => {
                        // Menambahkan sumber data (source)
                        map.addSource('sites', {
                            type: 'geojson',
                            data: '{{ route('api.tower-locations') }}',
                            cluster: true,
                            clusterMaxZoom: 14,
                            clusterRadius: 50
                        });

                        // Layer untuk cluster (lingkaran)
                        map.addLayer({
                            id: 'clusters',
                            type: 'circle',
                            source: 'sites',
                            filter: ['has', 'point_count'],
                            paint: {
                                'circle-color': [
                                    'step', ['get', 'point_count'],
                                    '#51bbd6', 10, '#f1f075', 30, '#f28cb1'
                                ],
                                'circle-radius': [
                                    'step', ['get', 'point_count'],
                                    20, 10, 30, 30, 40
                                ]
                            }
                        });

                        // Layer untuk jumlah di dalam cluster
                        map.addLayer({
                            id: 'cluster-count',
                            type: 'symbol',
                            source: 'sites',
                            filter: ['has', 'point_count'],
                            layout: {
                                'text-field': '{point_count_abbreviated}',
                                'text-font': ['DIN Offc Pro Medium', 'Arial Unicode MS Bold'],
                                'text-size': 12
                            }
                        });

                        // Layer untuk titik individu (lingkaran merah)
                        map.addLayer({
                            id: 'unclustered-point',
                            type: 'circle',
                            source: 'sites',
                            filter: ['!', ['has', 'point_count']],
                            paint: {
                                'circle-color': '#FF0000', // Warna merah untuk tower individu
                                'circle-radius': 6,
                                'circle-stroke-width': 1,
                                'circle-stroke-color': '#fff'
                            }
                        });

                        // Event klik pada cluster
                        map.on('click', 'clusters', (e) => {
                            const features = map.queryRenderedFeatures(e.point, { layers: ['clusters'] });
                            const clusterId = features[0].properties.cluster_id;
                            map.getSource('sites').getClusterExpansionZoom(clusterId, (err, zoom) => {
                                if (err) return;
                                map.easeTo({ center: features[0].geometry.coordinates, zoom: zoom });
                            });
                        });

                        // Event klik pada ikon tower
                        map.on('click', 'unclustered-point', (e) => {
                            const coordinates = e.features[0].geometry.coordinates.slice();
                            const properties = e.features[0].properties;
                            while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                                coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
                            }
                            new mapboxgl.Popup({ maxWidth: '400px' })
                                .setLngLat(coordinates)
                                .setHTML(properties.popup_html)
                                .addTo(map);
                        });

                        // Ubah kursor saat hover
                        map.on('mouseenter', ['clusters', 'unclustered-point'], () => {
                            map.getCanvas().style.cursor = 'pointer';
                        });
                        map.on('mouseleave', ['clusters', 'unclustered-point'], () => {
                            map.getCanvas().style.cursor = '';
                        });
                    });
                }
            }"
            x-init="initMap()"
        >
            {{-- Map container --}}
            <div x-ref="mapContainer" style="width: 100%; height: 500px; position: relative;">
                {{-- Legend --}}
                <div id="legend" style="position: absolute; bottom: 30px; right: 10px; background: rgba(255, 255, 255, 0.9); padding: 10px; border-radius: 5px; font-family: Arial, sans-serif; z-index: 1;">
                    <h4 style="margin: 0 0 5px 0;">Legenda</h4>
                    <div><span style="background-color: #FF0000; border-radius: 50%; display: inline-block; width: 12px; height: 12px; margin-right: 5px; border: 1px solid #fff;"></span>Tower</div>
                    <div style="margin-top: 5px; font-weight: bold;">Cluster Tower:</div>
                    <div><span style="background-color: #51bbd6; border-radius: 50%; display: inline-block; width: 12px; height: 12px; margin-right: 5px;"></span> 1-9 Tower</div>
                    <div><span style="background-color: #f1f075; border-radius: 50%; display: inline-block; width: 12px; height: 12px; margin-right: 5px;"></span> 10-29 Tower</div>
                    <div><span style="background-color: #f28cb1; border-radius: 50%; display: inline-block; width: 12px; height: 12px; margin-right: 5px;"></span> 30+ Tower</div>
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament-widgets::widget>