<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;

class MapLocation extends Component
{
   public $long, $lat;
   // public $value = "value test";
   public $geoJson;

   public function loadLocations()
   {
      $locations = Location::orderBy('created_at', 'desc')->get();
      $locationsArr = [];

      foreach ($locations as $location) {
         // contoh di geojson di livewire -> map-location.php
         $locationsArr[] = [
            'type' => 'features',
            'geometry' => [
               'coordinates' => [$location->long, $location->lat],
               'type' => 'Point'
            ],
            'properties' => [
               'locationId' => $location->id,
               'title' => $location->title,
               'image' => $location->image,
               'description' => $location->description
            ]
         ];
      }

      $geoLocation = [
         'type' => 'FeatureCollection',
         'features' => $locationsArr
      ];

      // konversi menjadi collection menjadi json
      $geoJson = collect($geoLocation)->toJson();
      $this->geoJson = $geoJson;
   }

   public function render()
   {
      $this->loadLocations();
      return view('livewire.map-location');
   }
}
