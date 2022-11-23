<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Message;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Chat extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name'];


    public function lastMessage() {
        return $this->messages->sortByDesc('id')->first();
    }

    public function messages(){
        return $this->hasMany(Message::class, 'chat_id' );
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    protected static function booted()
    {

        static::created(function ($chat) {
            if(auth()->user() != null){
                $message = new Message;
                $message->body = "Chat created";
                $message->chat_id = $chat->id;
                $message->sender_id = auth()->id();
                $message->save();
            }
        });

        static::deleted(function ($chat) {
            $chat->messages()->delete();
            $chat->clearMediaCollection();
        });
    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('avatar')
            ->fit(Manipulations::FIT_CROP, 150, 150)
            ->nonQueued();
    }
}
