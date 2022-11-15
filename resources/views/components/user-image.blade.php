@props(['user'])

@if($user->image_link !== null)
    <img src="{{$user->image_link}}" alt="user image" class="min-h-[40px] min-w-[40px]  w-[40px] h-[40px] rounded-full">
@else
    <div class="w-[40px] h-[40px] rounded-full min-h-[40px] min-w-[40px] bg-[#{{substr(hash('ripemd160', $user->email),0,6)}}] items-center justify-center flex">
        <p class="text-[18px] font-bold text-[#ffffff] ">{{$user->name[0]}}</p>
    </div>
@endif
