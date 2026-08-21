<?php

namespace Tests\Feature;

use App\Mail\LeadRequestMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_home_page_is_available(): void
    {
        $this->withoutVite();

        $response = $this->get(route('home'));

        $response
            ->assertOk()
            ->assertSee('НСК Макстар')
            ->assertSee('Подберите размер и покрытие')
            ->assertSee('Шесть спокойных автомобильных оттенков');
    }

    public function test_valid_lead_is_sent_with_configured_recipient(): void
    {
        Mail::fake();
        config()->set('mail.lead_to_address', 'leads@example.test');

        $response = $this->postJson(route('lead.send'), [
            'name' => 'Иван Петров',
            'phone' => '+7 (913) 895-45-25',
            'message' => 'Нужна покраска комплекта дисков.',
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('status', 'ok');

        Mail::assertSent(LeadRequestMail::class, function (LeadRequestMail $mail): bool {
            return $mail->hasTo('leads@example.test');
        });
    }

    public function test_phone_number_requires_at_least_seven_digits(): void
    {
        Mail::fake();

        $response = $this->postJson(route('lead.send'), [
            'phone' => '+7---',
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('phone');

        Mail::assertNothingSent();
    }
}
