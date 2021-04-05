<?php

namespace App\Http\Livewire;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Location;
use Illuminate\Support\Facades\Storage;

class MapLocation extends Component
{
   use WithFileUploads;

   public $locationId, $long, $lat, $title, $description, $image;
   // public $value = "value test";
   public $geoJson;
   public $imageUrl;
   public $isEdit = false;

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

   private function clearForm()
   {
      $this->long = '';
      $this->lat = '';
      $this->title = '';
      $this->description = '';
      $this->image = '';
   }

   public function saveLocation()
   {
      $this->validate([
         'long' => 'required',
         'lat' => 'required',
         'title' => 'required',
         'description' => 'required',
         'image' => 'image|max:2048|required',
      ]);

      $imageName = md5($this->image.microtime()).'.'.$this->image->extension();
      Storage::putFileAs(
         'public/images',
         $this->image,
         $imageName
      );

      Location::create([
         'long' => $this->long,
         'lat' => $this->lat,
         'title' => $this->title,
         'description' => $this->description,
         'image' => $imageName,
      ]);

      // mengkosongkan inputan, jika tambah data berhasil
      $this->clearForm();
      // agar refresh saat menambahkan data
      $this->loadLocations();
      // mengatasi tambah data berhasil, tetapi marker tidak muncul (page tidak loading)
      $this->dispatchBrowserEvent('locationAdded', $this->geoJson);
   }

   public function updateLocation()
   {
      $this->validate([
         'long' => 'required',
         'lat' => 'required',
         'title' => 'required',
         'description' => 'required',
      ]);

      $location = Location::findOrFail($this->locationId);
      if($this->image) {
         $imageName = md5($this->image.microtime()).'.'.$this->image->extension();
         Storage::putFileAs(
            'public/images',
            $this->image,
            $imageName
         );

         $updateData = [
            'title' => $this->title,
            'description' => $this->description,
            'image' => $imageName,
         ];
      } else {
         $updateData = [
            'title' => $this->title,
            'description' => $this->description,
         ];
      }

      $location->update($updateData);
      $this->imageUrl = '';

      // mengkosongkan inputan, jika tambah data berhasil
      $this->clearForm();
      // agar refresh saat menambahkan data
      $this->loadLocations();
      // mengatasi tambah data berhasil, tetapi marker tidak muncul (page tidak loading)
      $this->dispatchBrowserEvent('locationUpdated', $this->geoJson);
   }

   public function findLocationById($id)
   {
      $location = Location::findOrFail($id);

      $this->locationId = $id;
      $this->long = $location->long;
      $this->lat = $location->lat;
      $this->title = $location->title;
      $this->description = $location->description;
      $this->imageUrl = $location->image;
      $this->isEdit = true;
   }

   public function deleteLocation()
   {
      $location = Location::findOrFail($this->locationId);
      $location->delete();

      $this->imageUrl = '';
      $this->clearForm();
      $this->isEdit = false;
      $this->dispatchBrowserEvent('locationDeleted', $this->locationId);
   }

   public function render()
   {
      $this->loadLocations();
      return view('livewire.map-location');
   }
}
