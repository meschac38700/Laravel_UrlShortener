<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ValidUrlTest extends TestCase
{
    /**
     * valid url.
     *
     * @return void
     */
    public function testGoodUrl()
    {
        $this->assertTrue(Regex::validUrl("https://www.googlecom"));
    }

    /**
     * test bad url.
     *
     * @return void
     */
    public function testGoodUrl()
    {
        $this->assertFalse(Regex::validUrl("https://www.googlecom"));
    }
}
