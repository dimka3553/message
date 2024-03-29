@props(['message', 'user'])

<div class="flex gap-[16px] p-[16px] break-words message" mid="{{$message->id}}">
    <div class="pt-[3.5px]">
        <x-user-image :user="$message->sender" :size="40"/>
    </div>
    <div class="w-full break-words msg-text min-w-0">
        <p class=" text-[#{{substr(hash('ripemd160', $message->sender->email),0,6)}}] font-bold ">
            @if($message->sender->pro)<span class="rainbow">★</span> @endif {{$message->sender->name}}  @if($message->sender->id == $user->id) (You) @endif <span class="text-[12px] font-normal text-[#999999]">{{$message->created_at->diffForHumans()}}</span>
        </p>
        @if( $message->media->first()?->getUrl('chatview') !== null)
            <img src="{{$message->media->first()?->getUrl('chatview')}}" alt="message image" class="messageimg max-h-[300px] w-auto h-auto rounded-[8px] mt-[8px]">
        @endif
        @if(str_contains($message->body, '@html') && $message->sender->pro)
            {!! str_replace('@html', '', $message->body) !!}
        @else
            <p class="break-words w-full @if(str_contains($message->body, '@rainbow') && $message->sender->pro) rainbow text-[22px] font-bold @endif">
                {{str_replace('@rainbow', '', $message->body)}}
            </p>
        @endif
    </div>
</div>

