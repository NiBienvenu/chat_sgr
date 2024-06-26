<?php

namespace Database\Factories;
use App\Models\Message;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition()
    {
        return [
            'conversation_id' => Conversation::factory(),
            'sender_id' => User::factory(),
            'receiver_id' => User::factory(),
            'read_at' => now(),
            'body' => $this->faker->sentence(),
        ];
    }
}