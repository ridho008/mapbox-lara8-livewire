<div class="container-fluid">
   <div class="row">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header"><h4>Map Box</h4></div>
            <div class="card-body">
               <div id='map' wire:ignore style='width: 100%; height: 80vh;'></div>
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card">
            <div class="card-header"><h4>Form</h4></div>
               <div class="card-body">
                  <form>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="longtitude">Longtitude</label>
                              <input type="text" wire:model="long" id="longtitude" class="form-control">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="lattitude">Lattitude</label>
                              <input type="text" wire:model="lat" id="lattitude" class="form-control">
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
         </div>
      </div>
   </div>
</div>

@push('script')
   <script>
      {{-- memastikan livewire sudah terload, jika udh baru bisa diakses --}}
      document.addEventListener('livewire:load', function() {
         const defaultLocation = [101.45796988356352, 0.44171169275220734];
         mapboxgl.accessToken = '{{ env("MAPBOX_KEY") }}';
         var map = new mapboxgl.Map({
           container: 'map',
           center: defaultLocation,
           zoom: 11.15
         });

         {{-- console.log("ini adalah variabel value", @this.test); --}}
         // menampilkan marker
         const geoJson = {
              "type": "FeatureCollection",
              "features": [
                {
                  "type": "Feature",
                  "geometry": {
                    "coordinates": [
                      "106.73830754205",
                      "-6.2922403995615"
                    ],
                    "type": "Point"
                  },
                  "properties": {
                    "message": "Mantap",
                    "iconSize": [
                      50,
                      50
                    ],
                    "locationId": 30,
                    "title": "Hello new",
                    "image": "1a1eb1e4106fff0cc3467873f0f39cab.jpeg",
                    "description": "Mantap"
                  }
                },
                {
                  "type": "Feature",
                  "geometry": {
                    "coordinates": [
                      "106.68681595869",
                      "-6.3292244652013"
                    ],
                    "type": "Point"
                  },
                  "properties": {
                    "message": "oke mantap Edit",
                    "iconSize": [
                      50,
                      50
                    ],
                    "locationId": 29,
                    "title": "Rumah saya Edit",
                    "image": "0ea59991df2cb96b4df6e32307ea20ff.png",
                    "description": "oke mantap Edit"
                  }
                },
                {
                  "type": "Feature",
                  "geometry": {
                    "coordinates": [
                      "106.62490035406",
                      "-6.3266855038639"
                    ],
                    "type": "Point"
                  },
                  "properties": {
                    "message": "Update Baru",
                    "iconSize": [
                      50,
                      50
                    ],
                    "locationId": 22,
                    "title": "Update Baru Gambar",
                    "image": "d09444b68d8b72daa324f97c999c2301.jpeg",
                    "description": "Update Baru"
                  }
                },
                {
                  "type": "Feature",
                  "geometry": {
                    "coordinates": [
                      "106.72391468711",
                      "-6.3934163494543"
                    ],
                    "type": "Point"
                  },
                  "properties": {
                    "message": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    "iconSize": [
                      50,
                      50
                    ],
                    "locationId": 19,
                    "title": "awdwad",
                    "image": "f0b88ffd980a764b9fca60d853b300ff.png",
                    "description": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
                  }
                },
                {
                  "type": "Feature",
                  "geometry": {
                    "coordinates": [
                      "106.67224158205",
                      "-6.3884963990263"
                    ],
                    "type": "Point"
                  },
                  "properties": {
                    "message": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
                    "iconSize": [
                      50,
                      50
                    ],
                    "locationId": 18,
                    "title": "adwawd",
                    "image": "4c35cb1b76af09e6205f94024e093fe6.jpeg",
                    "description": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
                  }
                },
                {
                  "type": "Feature",
                  "geometry": {
                    "coordinates": [
                      "106.74495523289",
                      "-6.3642034511073"
                    ],
                    "type": "Point"
                  },
                  "properties": {
                    "message": "awdwad",
                    "iconSize": [
                      50,
                      50
                    ],
                    "locationId": 12,
                    "title": "adawd",
                    "image": "7c8c949fd0499eb50cb33787d680778c.jpeg",
                    "description": "awdwad"
                  }
                }
              ]
            }

         const loadLocation = () => {
            geoJson.features.forEach((location) => {
               const {geometry, properties} = location
               // console.log(location);
               const {iconSize, locationId, title, image, description} = properties

               let markerElement = document.createElement('div');
               markerElement.className = 'marker' + locationId
               markerElement.id = locationId
               markerElement.style.backgroundImage = 'url(https://assets.materialup.com/uploads/038689a7-4799-4a43-b47b-75712dd56dd4/preview.jpg)'
               markerElement.style.backgroundSize = 'cover'
               markerElement.style.width = '50px'
               markerElement.style.height = '50px'

               new mapboxgl.Marker(markerElement)
               .setLngLat(geometry.coordinates)
               .addTo(map)
            })
         }

         loadLocation()

         // mengganti style map
         const style = "dark-v10";
         // light-v10, outdoors-v11, satellite-v9, streets-v11, dark-v10
         map.setStyle(`mapbox://styles/mapbox/${style}`);

         // menampilkan control zoom in/out
         map.addControl(new mapboxgl.NavigationControl())

         // jika map diklik dimana saja, akan mendapatkan long, lat
         map.on('click', (e) => {
          const longtitude = e.lngLat.lng;
          const lattitude = e.lngLat.lat;

          // input value field
          @this.long = longtitude;
          @this.lat = lattitude;
          // console.log({longtitude, lattitude});
         });
         
      });
   </script>
@endpush