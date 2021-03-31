<div>
   <h1>Hello</h1>
   <div id='map' style='width: 400px; height: 300px;'></div>
   

</div>

@push('script')
   <script>
     mapboxgl.accessToken = 'pk.eyJ1IjoicmlkaG8wMDgiLCJhIjoiY2toOTEzMWVhMGlrcjJ4a2g1Z3BoeHRheSJ9.GhfzsPNOI6czJ-KcXilejA';
     var map = new mapboxgl.Map({
       container: 'map',
       style: 'mapbox://styles/mapbox/streets-v11'
     });
   </script>
@endpush