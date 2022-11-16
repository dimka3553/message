@props(['message', 'user'])

<div class="flex gap-[16px] p-[16px] items-start">
    <div class="pt-[3.5px]">
        <x-user-image :user="$message->sender" />
    </div>

    <div>
        <p class="text-[#{{substr(hash('ripemd160', $message->sender->email),0,6)}}] font-bold">
            {{$message->sender->name}}  @if($message->sender->id == $user->id) (You) @endif <span class="text-[12px] font-normal text-[#999999]">{{$message->created_at}}</span>
        </p>
        <p>
            {{$message->body}}
        </p>
    </div>
</div>
