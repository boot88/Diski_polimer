<?php

namespace Tests\Feature;

use App\Mail\LeadRequestMail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
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
            ->assertSee('Шесть спокойных автомобильных оттенков')
            ->assertSee('href="#contact" class="button button-accent">Оценить по фото</a>', false);
    }

    public function test_valid_lead_is_sent_to_both_emails_and_max_with_photo(): void
    {
        Mail::fake();
        Http::fake([
            'platform-api2.max.ru/uploads*' => Http::response([
                'url' => 'https://iu.oneme.ru/upload/test',
            ]),
            'iu.oneme.ru/*' => Http::response(['token' => 'image-token']),
            'platform-api2.max.ru/messages*' => Http::response(['message' => ['id' => '1']]),
        ]);

        config()->set('mail.lead_to_addresses', [
            'first@example.test',
            'second@example.test',
        ]);
        config()->set('mail.default', 'smtp');
        config()->set('services.max.access_token', 'max-test-token');
        config()->set('services.max.user_id', '123456789');
        config()->set('services.max.chat_id', null);

        $response = $this->post(route('lead.send'), [
            'name' => 'Иван Петров',
            'phone' => '+7 (999) 000-00-00',
            'message' => 'Нужна покраска комплекта дисков.',
            'photo' => UploadedFile::fake()->create('diski.jpg', 5120, 'image/jpeg'),
        ], ['Accept' => 'application/json', 'X-Requested-With' => 'XMLHttpRequest']);

        $response
            ->assertOk()
            ->assertJsonPath('status', 'ok');

        Mail::assertSent(LeadRequestMail::class, 2);
        Mail::assertSent(LeadRequestMail::class, fn (LeadRequestMail $mail) => $mail->hasTo('first@example.test') && $mail->photo['name'] === 'diski.jpg'
        );
        Mail::assertSent(LeadRequestMail::class, fn (LeadRequestMail $mail) => $mail->hasTo('second@example.test') && $mail->photo['name'] === 'diski.jpg'
        );

        Http::assertSent(fn ($request) => str_contains($request->url(), 'platform-api2.max.ru/messages?user_id=123456789')
            && $request->hasHeader('Authorization', 'max-test-token')
            && data_get($request->data(), 'attachments.0.payload.token') === 'image-token'
        );
    }

    public function test_photo_larger_than_five_megabytes_is_rejected(): void
    {
        Mail::fake();

        $response = $this->postJson(route('lead.send'), [
            'phone' => '+7 (999) 000-00-00',
            'photo' => UploadedFile::fake()->create('too-large.jpg', 5121, 'image/jpeg'),
        ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors('photo');

        Mail::assertNothingSent();
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

    public function test_honeypot_does_not_send_any_notifications(): void
    {
        Mail::fake();
        Http::fake();
        $this->postJson(route('lead.send'), ['website' => 'spam'])->assertOk();
        Mail::assertNothingSent();
        Http::assertNothingSent();
    }

    public function test_unavailable_delivery_does_not_report_success(): void
    {
        Mail::fake();
        Http::fake();
        config()->set('mail.default', 'array');
        config()->set('services.max.access_token', null);
        $this->postJson(route('lead.send'), ['phone' => '+79130000000'])
            ->assertStatus(503);
        Mail::assertNothingSent();
    }

    public function test_selection_is_validated_and_included_in_email(): void
    {
        Mail::fake();
        Http::fake();
        config()->set('mail.default', 'smtp');
        config()->set('mail.lead_to_addresses', ['first@example.test', 'first@example.test']);
        config()->set('services.max.access_token', null);
        $this->postJson(route('lead.send'), [
            'phone' => '+79130000000', 'size' => 'R17', 'finish' => 'bronze',
        ])->assertOk();
        Mail::assertSent(LeadRequestMail::class, 1);
        Mail::assertSent(LeadRequestMail::class, fn ($mail) => $mail->lead['size'] === 'R17' && $mail->lead['finish'] === 'Тёмная бронза'
        );
        $this->postJson(route('lead.send'), [
            'phone' => '+79130000000', 'size' => 'R999', 'finish' => '<script>',
        ])->assertUnprocessable()->assertJsonValidationErrors(['size', 'finish']);
    }

    public function test_max_upload_failure_falls_back_to_text_with_correct_photo_notice(): void
    {
        Mail::fake();
        config()->set('mail.default', 'smtp');
        config()->set('mail.lead_to_addresses', ['first@example.test']);
        config()->set('services.max.access_token', 'test-token');
        config()->set('services.max.user_id', '123');
        config()->set('app.url', 'https://www.maxtar-nsk.ru');
        Http::fake([
            'platform-api2.max.ru/uploads*' => Http::response([], 500),
            'platform-api2.max.ru/messages*' => Http::response(['message' => ['id' => '1']]),
        ]);
        $this->postJson(route('lead.send'), [
            'phone' => '+79130000000',
            'photo' => UploadedFile::fake()->create('disk.jpg', 100, 'image/jpeg'),
        ])->assertOk();
        Http::assertSent(fn ($request) => str_contains($request->url(), '/messages?')
            && str_contains($request['text'], 'не прикреплено в MAX')
            && str_contains($request['text'], 'https://www.maxtar-nsk.ru/')
            && $request['attachments'] === []
        );
    }

    public function test_email_escapes_user_input_once(): void
    {
        $html = (new LeadRequestMail([
            'name' => 'Иван & Анна <test>', 'phone' => '+79130000000',
            'message' => '<script>alert(1)</script>', 'created_at' => '12.09.2026 12:00',
        ]))->render();
        $this->assertStringContainsString('Иван &amp; Анна &lt;test&gt;', $html);
        $this->assertStringNotContainsString('&amp;amp;', $html);
        $this->assertStringNotContainsString('<script>alert', $html);
    }
}
