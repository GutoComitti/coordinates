<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Services\LocationService;
use Tests\TestCase;

class LocationServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function test_location_distance_works()
    {
        $locationA = new Location(53.3340285, -6.2535495);
        $locationB = new Location(51.92893, -10.27699);

        $distance = app(LocationService::class)->getLocationsDistance($locationA, $locationB);
        $this->assertTrue($distance === 313.2, "locations distance calculation function");
    }
}
