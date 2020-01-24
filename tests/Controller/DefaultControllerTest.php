<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCalculator()
    {
        $client = self::createClient();
        $crawler = $client->request('GET', '/');
        $response = $client->getResponse();
        
        // Verify request
        $this->assertTrue($response->isSuccessful(), "Request to index failed.");
        
        // If the request is successful we can continue testing
        if ($response->isSuccessful()) {
            
            // Verify the template
            $this->assertCount(1, $crawler->filter('div.wrapper'), "Main wrapper missing");
            $this->assertCount(3, $crawler->filter('div.valueInput'), "Form input wrappers missing");
            $this->assertCount(1, $crawler->filter('input[name="value1"]'), "Value 1 Input missing");
            $this->assertCount(1, $crawler->filter('input[name="value2"]'), "Value 2 Input missing");
            $this->assertCount(1, $crawler->filter('select[name="operator"]'), "Operator Select missing");
            $this->assertCount(1, $crawler->filter('button[type="submit"]'), "Submit button missing");
            
            /* TEST ADDITION */
            
            $form = $crawler->selectButton('Calculate')->form();
            
            $form['value1'] = 1;
            $form['value2'] = 3;
            $form['operator'] = '+';

            // Submit the form
            $crawler = $client->submit($form);
            
            // Verify results
            $this->assertEquals(4, $crawler->filter('div.result')->text(), "Addition calculation is incorrect: [" . $crawler->filter('div.result')->text() . "]");
            
            /* TEST ADDITION */
            
            /* TEST SUBSTRACTION */
            
            $form = $crawler->selectButton('Calculate')->form();
            
            $form['value1'] = 1;
            $form['value2'] = 3;
            $form['operator'] = '-';

            // Submit the form
            $crawler = $client->submit($form);
            
            // Verify results
            $this->assertEquals(-2, $crawler->filter('div.result')->text(), "Addition calculation is incorrect: [" . $crawler->filter('div.result')->text() . "]");
            
            /* TEST SUBSTRACTION */

            /* TEST MULTIPLICATION */
            
            $form = $crawler->selectButton('Calculate')->form();
            
            $form['value1'] = 1;
            $form['value2'] = 3;
            $form['operator'] = '*';

            // Submit the form
            $crawler = $client->submit($form);
            
            // Verify results
            $this->assertEquals(3, $crawler->filter('div.result')->text(), "Addition calculation is incorrect: [" . $crawler->filter('div.result')->text() . "]");
            
            /* TEST MULTIPLICATION */
            
            /* TEST DIVISION */
            
            $form = $crawler->selectButton('Calculate')->form();
            
            $form['value1'] = 1;
            $form['value2'] = 3;
            $form['operator'] = '/';

            // Submit the form
            $crawler = $client->submit($form);
            
            // Verify results
            $this->assertEquals(1/3, $crawler->filter('div.result')->text(), "Addition calculation is incorrect: [" . $crawler->filter('div.result')->text() . "]");
            
            /* TEST DIVISION */
        }
    }
}