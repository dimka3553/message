@props(['chat', 'size'])


@if( $chat->media->first()?->getUrl('avatar') !== null)

    <img src="{{$chat->media->first()?->getUrl('avatar')}}" alt="chat image" class="min-h-[{{$size}}px] min-w-[{{$size}}px] w-[{{$size}}px] h-[{{$size}}px] rounded-full">
@else
    <div class="w-[{{$size}}px] h-[{{$size}}px] rounded-full min-h-[{{$size}}px] min-w-[{{$size}}px]  bg-[#{{substr(hash('ripemd160', $chat->id),0,6)}}] items-center justify-center flex">
        <p class="text-[{{$size*0.45}}px] font-bold text-[#ffffff] ">{{$chat->name[0]}}</p>
    </div>
@endif
