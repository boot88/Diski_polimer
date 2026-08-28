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
        Mail::assertSent(LeadRequestMail::class, fn (LeadRequestMail $mail) =>
            $mail->hasTo('first@example.test') && $mail->photo['name'] === 'diski.jpg'
        );
        Mail::assertSent(LeadRequestMail::class, fn (LeadRequestMail $mail) =>
            $mail->hasTo('second@example.test') && $mail->photo['name'] === 'diski.jpg'
        );

        Http::assertSent(fn ($request) =>
            str_contains($request->url(), 'platform-api2.max.ru/messages?user_id=123456789')
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
}
