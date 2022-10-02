<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
  private Location $officeLocation;
  private const OFFICE_LATITUDE = 53.3340285;
  private const OFFICE_LONGITUDE = -6.2535495;

  public function __construct()
  {
    $this->officeLocation = new Location(self::OFFICE_LATITUDE, self::OFFICE_LONGITUDE);
  }

  public function getLocationsDistance(Location $locationFrom, Location $locationTo): float
  {
    $theta    = $locationFrom->getLongitude() - $locationTo->getLongitude();
    $dist    = sin(deg2rad($locationFrom->getLatitude())) * sin(deg2rad($locationTo->getLatitude())) +  cos(deg2rad($locationFrom->getLatitude())) * cos(deg2rad($locationTo->getLatitude())) * cos(deg2rad($theta));
    $dist    = acos($dist);
    $dist    = rad2deg($dist);
    $kilometers    = $dist * 60 * 1.1515 * 1.609344;
    return round($kilometers, 2);
  }

  public function getDistanceFromOffice(Location $location): float
  {
    return $this->getLocationsDistance($this->officeLocation, $location);
  }

}