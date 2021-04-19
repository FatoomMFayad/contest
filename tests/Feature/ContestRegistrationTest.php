<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContestRegistrationTest extends TestCase
{
    public function an_email_can_entered_into_the_contest()
    {
        $this->post('/contest', [
            'email' => 'aa@aa.com'
        ]);
        $this->assertDatabaseCount('contest_entries', 1);
    }
}
