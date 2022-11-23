<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Message extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'chat_id',
        'user_id',
        'body'
    ];
    public function sender(){
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function chat(){
        return $this->belongsTo(Chat::class, 'chat_id');
    }

    public function registerMediaConversions(Media $media = null): void
    {

        if($media->size > 100000){
            if($media->width > $media->height){
                $this
                    ->addMediaConversion('chatview')
                    ->width(600)
                    ->nonQueued();
            } else {
                $this
                    ->addMediaConversion('chatview')
                    ->height(600)
                    ->nonQueued();
            }
        }else{
            $this
                ->addMediaConversion('chatview')
                ->nonQueued();
        }
    }
}
