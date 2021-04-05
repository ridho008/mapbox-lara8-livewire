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
                  <form wire:submit.prevent="saveLocation">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="longtitude">Longtitude</label>
                              <input type="text" wire:model="long" id="longtitude" class="form-control">
                              @error('long')
                              <small class="muted text-danger">{{ $message }}</small>
                              @enderror
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="lattitude">Lattitude</label>
                              <input type="text" wire:model="lat" id="lattitude" class="form-control">
                              @error('lat')
                              <small class="muted text-danger">{{ $message }}</small>
                              @enderror
                           </div>
                        </div>
                     </div>
                     <div class="row">
                       <div class="col-md-12">
                         <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" wire:model="title" id="title" class="form-control">
                            @error('title')
                              <small class="muted text-danger">{{ $message }}</small>
                              @enderror
                         </div>
                         <div class="form-group">
                            <label for="description">Description</label>
                            <textarea wire:model="description" id="description" class="form-control"></textarea>
                            @error('description')
                              <small class="muted text-danger">{{ $message }}</small>
                              @enderror
                         </div>
                         <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                              <input type="file" wire:model="image" class="custom-file-input" id="customFile">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                            @error('image')
                            <small class="muted text-danger">{{ $message }}</small>
                            @enderror
                            @if($image)
                              <img src="{{ $image->temporaryUrl() }}" class="img-fluid">
                            @endif
                         </div>
                         <div class="form-group">
                            <button type="submit" class="btn btn-dark btn-block">Save Location</button>
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
         // const geoJson = {
         //      "type": "FeatureCollection",
         //      "features": [
         //        {
         //          "type": "Feature",
         //          "geometry": {
         //            "coordinates": [
         //              "101.49711148709542",
         //              "0.4543820448065361"
         //            ],
         //            "type": "Point"
         //          },
         //          "properties": {
         //            "message": "Mantap",
         //            "iconSize": [
         //              50,
         //              50
         //            ],
         //            "locationId": 30,
         //            "title": "Hello new",
         //            "image": "1a1eb1e4106fff0cc3467873f0f39cab.jpeg",
         //            "description": "Mantap"
         //          }
         //        },
         //        {
         //          "type": "Feature",
         //          "geometry": {
         //            "coordinates": [
         //              "101.4550303955495",
         //              "0.4116833341927446"
         //            ],
         //            "type": "Point"
         //          },
         //          "properties": {
         //            "message": "oke mantap Edit",
         //            "iconSize": [
         //              50,
         //              50
         //            ],
         //            "locationId": 29,
         //            "title": "Rumah saya Edit",
         //            "image": "0ea59991df2cb96b4df6e32307ea20ff.png",
         //            "description": "oke mantap Edit"
         //          }
         //        },
         //        {
         //          "type": "Feature",
         //          "geometry": {
         //            "coordinates": [
         //              "101.41263988421241",
         //              "0.4785159885234691"
         //            ],
         //            "type": "Point"
         //          },
         //          "properties": {
         //            "message": "Update Baru",
         //            "iconSize": [
         //              50,
         //              50
         //            ],
         //            "locationId": 22,
         //            "title": "Update Baru Gambar",
         //            "image": "d09444b68d8b72daa324f97c999c2301.jpeg",
         //            "description": "Update Baru"
         //          }
         //        },
         //        {
         //          "type": "Feature",
         //          "geometry": {
         //            "coordinates": [
         //              "101.4312050716585",
         //              "0.44757502027873386"
         //            ],
         //            "type": "Point"
         //          },
         //          "properties": {
         //            "message": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
         //            "iconSize": [
         //              50,
         //              50
         //            ],
         //            "locationId": 19,
         //            "title": "awdwad",
         //            "image": "f0b88ffd980a764b9fca60d853b300ff.png",
         //            "description": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
         //          }
         //        },
         //        {
         //          "type": "Feature",
         //          "geometry": {
         //            "coordinates": [
         //              "101.49865858605011",
         //              "0.39002447904695714"
         //            ],
         //            "type": "Point"
         //          },
         //          "properties": {
         //            "message": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.",
         //            "iconSize": [
         //              50,
         //              50
         //            ],
         //            "locationId": 18,
         //            "title": "adwawd",
         //            "image": "4c35cb1b76af09e6205f94024e093fe6.jpeg",
         //            "description": "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum."
         //          }
         //        },
         //        {
         //          "type": "Feature",
         //          "geometry": {
         //            "coordinates": [
         //              "101.56394616190443",
         //              "0.47109016853136154"
         //            ],
         //            "type": "Point"
         //          },
         //          "properties": {
         //            "message": "awdwad",
         //            "iconSize": [
         //              50,
         //              50
         //            ],
         //            "locationId": 12,
         //            "title": "adawd",
         //            "image": "7c8c949fd0499eb50cb33787d680778c.jpeg",
         //            "description": "awdwad"
         //          }
         //        }
         //      ]
         //    }


         const loadLocation = (geoJson) => {
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
               markerElement.style.borderRadius = '50px'

               const imageStorage = '{{ asset("/storage/images") }}' + '/' + image

               // styling popup
               const content = `
               <div style="overflow-y: auto; max-height: 400px; width: 100%;">
                 <div class="table-responsive">
                   <table class="table">
                     <tbody>
                       <tr>
                         <td>Title</td>
                         <td>${title}</td>
                       </tr>
                       <tr>
                         <td>Picture</td>
                         <td><img src="${imageStorage}" loading="lazy" class="img-fluid"></td>
                       </tr>
                       <tr>
                         <td>Description</td>
                         <td>${description}</td>
                       </tr>
                     </tbody>
                   </table>
                 </div>
               </div>
               `

               // menampilkan popup
               const popUp = new mapboxgl.Popup({
                offset:25
               }).setHTML(content).setMaxWidth("400px")

               new mapboxgl.Marker(markerElement)
               .setLngLat(geometry.coordinates)
               .setPopup(popUp)
               .addTo(map)
            })
         }

         loadLocation({!! $geoJson !!})

         // load page, saat menambahkan data
         window.addEventListener('locationAdded', (e) => {
            loadLocation(JSON.parse(e.detail))
         })

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