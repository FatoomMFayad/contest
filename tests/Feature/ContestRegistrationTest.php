<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test **/
    public function an_email_can_entered_into_the_contest()
    {
        $this->withoutExceptionHandling();
        $this->post('/contest', [
            'email' => 'aa@aa.com'
        ]);
        $this->assertDatabaseCount('contest_entries', 1);
    }
    /** @test **/
    public function email_is_required()
    {
        $this->withoutExceptionHandling();
        $this->post('/contest', [
            'email' => ''
        ]);
        $this->assertDatabaseCount('contest_entries', 0);
    }
}
