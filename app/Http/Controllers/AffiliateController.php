<?php

namespace App\Http\Controllers;

use App\Models\Affiliate;
use App\Services\LocationService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller as BaseController;

class AffiliateController extends BaseController
{
    
  public function index(LocationService $locationService): View
  {
    $affiliates = $this->getAffiliates();
    
    $closeAffiliates = array_filter($affiliates, function($affiliate) use ($locationService){
      $maxDistanceFromOffice = 100;
      $distanceToOffice = $locationService->getDistanceFromOffice($affiliate->location);
      return $distanceToOffice <= $maxDistanceFromOffice;
    });

    usort($closeAffiliates, function($affiliate1, $affiliate2){
      return $affiliate1->affiliate_id > $affiliate2->affiliate_id;
    });

    return view('index')->with('affiliates', $closeAffiliates);
  }
  
/**
 * @return App\Models\Affiliate[]
 */
  public function getAffiliates(): array
  {
    $affiliates = $this->getAffiliatesArrayFromFile();
    array_walk($affiliates, function (Array &$affiliateArray){
      $affiliateArray = new Affiliate($affiliateArray);
    });
    return $affiliates;
  }

  private function getAffiliatesArrayFromFile(): array
  {
    $file = file_get_contents(base_path('storage\\app\\') .'affiliates.txt');
    $innerContent = rtrim(str_replace("}", "},", $file), ',');
    $fixedJson = '{"affiliates": [' . $innerContent . ']}';
    $convertedContent = json_decode($fixedJson, true);
    return $convertedContent["affiliates"];
  }
}