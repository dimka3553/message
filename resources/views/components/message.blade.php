@props(['message', 'user'])

<div class="flex gap-[16px] p-[16px] items-start break-normal overflow-hidden">
    <div class="pt-[3.5px]">
        <x-user-image :user="$message->sender" />
    </div>

    <div class="w-full break-normal">
        <p class="text-[#{{substr(hash('ripemd160', $message->sender->email),0,6)}}] font-bold ">
            {{$message->sender->name}}  @if($message->sender->id == $user->id) (You) @endif <span class="text-[12px] font-normal text-[#999999]">{{$message->created_at}}</span>
        </p>
        <p class="break-normal w-full">
            {{$message->body}}
        </p>
    </div>
</div>
