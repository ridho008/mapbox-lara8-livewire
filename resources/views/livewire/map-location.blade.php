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