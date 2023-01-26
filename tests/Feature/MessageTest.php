<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Chat;
use App\Models\Message;

class MessageTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();
        // create a user for testing
        $this->user = factory(User::class)->create();
        // create a chat for testing
        $this->chat = factory(Chat::class)->create();
        // add the user to the chat
        $this->chat->users()->attach($this->user);
    }

    public function testStoreWithTextMessage()
    {
        // log in the user
        $this->actingAs($this->user);
        // create a message request
        $request = [
            'chat_id' => $this->chat->id,
            'body' => 'This is a test message'
        ];
        // send the request to the store method
        $response = $this->postJson(route('messages.store'), $request);
        // check if the message was saved to the database
        $this->assertDatabaseHas('messages', [
            'body' => 'This is a test message',
            'chat_id' => $this->chat->id,
            'sender_id' => $this->user->id
        ]);
        // check if the response is correct
        $response->assertStatus(200)
            ->assertJson(['message' => 'Message sent successfully']);
    }

    public function testStoreWithAttachment()
    {
        // log in the user
        $this->actingAs($this->user);
        // create a dummy file for attachment
        Storage::fake('public');
        $file = UploadedFile::fake()->image('attachment.jpg');
        // create a message request
        $request = [
            'chat_id' => $this->chat->id,
            'attachment' => $file,
            'caption' => 'This is the attachment caption'
        ];
        // send the request to the store method
        $response = $this->postJson(route('messages.store'), $request);
        // check if the attachment was saved to the media library
        $this->assertTrue($this->user->getMedia('default')->first()->file_name === 'attachment.jpg');
        // check if the message was saved to the database
        $this->assertDatabaseHas('messages', [
            'body' => 'This is the attachment caption',
            'chat_id' => $this->chat->id,
            'sender_id' => $this->user->id
        ]);
        // check if the response is correct
        $response->assertStatus(200)
            ->assertJson(['message' => 'Message sent successfully']);
    }

    public function testStoreWithGPT()
    {
        // log in the user
        $this->actingAs($this->user);
// create a message request
        $request = [
            'chat_id' => $this->chat->id,
            'body' => '@gpt This is a test message for GPT'
        ];
// send the request to the store method
        $response = $this->postJson(route('messages.store'), $request);
// check if the message was saved to the database
        $this->assertDatabaseHas('messages', [
            'body' => '@gpt This is a test message for GPT',
            'chat_id' => $this->chat->id,
            'sender_id' => $this->user->id
        ]);
// check if the GPT message was added to the database
        $this->assertDatabaseHas('messages', [
            'body' => 'This is a test message for GPT',
            'chat_id' => $this->chat->id,
            'sender_id' => User::find('username', 'GPT')->id
        ]);
// check if the response is correct
        $response->assertStatus(200)
            ->assertJson(['message' => 'Message sent successfully']);
    }
}
