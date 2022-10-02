<?php

namespace Tests\Feature;

use App\Http\Controllers\AffiliateController;
use App\Models\Affiliate;
use Tests\TestCase;

class AffiliatesTest extends TestCase
{
    
    /**
     * Check if the main page is working
     *
     * @return void
     */
    public function testBasicGetRequest(): void
    {
      $response = $this->get('/');
      $response->assertOk();
    }
    /**
     * Check if the affiliates function is working properly 
     *
     * @return void
     */
    public function test_getting_valid_affiliates_from_file()
    {
        $affiliateController = new AffiliateController();
        
        $affiliates = $affiliateController->getAffiliates();
        $this->assertTrue(gettype($affiliates) === 'array' && count($affiliates) > 0, "gets a valid array");
        $arrayIsFilledWithAffiliates = true;
        foreach($affiliates as $affiliate){
            if(!($affiliate instanceof Affiliate)){
                $arrayIsFilledWithAffiliates = false;
                break;
            }
        }
        $this->assertTrue($arrayIsFilledWithAffiliates, "has only affiliates in the array");
    }
}
