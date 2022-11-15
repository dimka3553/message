@props(['chat'])


@if($chat->image_link !== null)
    <img src="{{$chat->image_link}}" alt="chat image" class="min-h-[40px] min-w-[40px]  w-[40px] h-[40px] rounded-full">
@else
    <div class="w-[40px] h-[40px] rounded-full min-h-[40px] min-w-[40px] bg-[#{{substr(hash('ripemd160', $chat->id),0,6)}}] items-center justify-center flex">
        <p class="text-[18px] font-bold text-[#ffffff] text-center">{{$chat->name[0]}}</p>
    </div>
@endif
