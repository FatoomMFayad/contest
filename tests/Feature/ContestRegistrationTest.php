<?php

namespace Tests\Feature;

use App\Events\NewEntryReceivedEvent;
use App\Mail\WelcomeContestMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();

        Mail::fake();
    }

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
        // $this->withoutExceptionHandling();
        $this->post('/contest', [
            'email' => ''
        ]);
        $this->assertDatabaseCount('contest_entries', 0);
    }
    /** @test **/
    public function email_needs_to_be_an_email()
    {
        // $this->withoutExceptionHandling();
        $this->post('/contest', [
            'email' => 'dsfgggd'
        ]);
        $this->assertDatabaseCount('contest_entries', 0);
    }
    /** @test **/
    public function an_event_fired_when_user_registers()
    {
        Event::fake([
            NewEntryReceivedEvent::class
        ]);

        $this->post('/contest', [
            'email' => 'aa@bb.com'
        ]);

        Event::assertDispatched(NewEntryReceivedEvent::class);
    }
    /** @test **/
    public function a_welcome_email_is_sent()
    {
        $this->withoutExceptionHandling();
        $this->post('/contest', [
            'email' => 'aa@aa.com'
        ]);

        Mail::assertSent(WelcomeContestMail::class);
    }
}
