<div wire:poll>
    @foreach($chat->messages as $message)
        <x-message :message="$message" :user="auth()->user()"/>

    @endforeach

    <script>

        let isAtBottom = true;

        function isScrolledToBottom() {
            const scrollableHeight = document.documentElement.scrollHeight;
            const scrolled = document.documentElement.scrollTop;
            const visibleHeight = document.documentElement.clientHeight;

            return Math.ceil(scrolled + visibleHeight) >= scrollableHeight;
        }

        document.addEventListener('scroll', function() {
            isAtBottom = isScrolledToBottom();
        });
        
        document.addEventListener("DOMContentLoaded", () => {
            Livewire.hook('element.updated', (el, component) => {
                if(isAtBottom){
                    //scroll to the bottom of page with a smooth animation over 0.2 seconds
                    window.scrollTo({
                        top: document.body.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            })
        });
    </script>
</div>
