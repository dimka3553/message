<div wire:poll id="allmessages">
    @foreach($chat->messages as $message)
        <x-message :message="$message" :user="auth()->user()"/>
    @endforeach
    <script>
        let isAtBottom = true;

        //on load set is at bottom to true
        $(document).ready(function(){
            isAtBottom = true;
        });

        function isScrolledToBottom() {
            const scrollableHeight = document.documentElement.scrollHeight;
            const scrolled = document.documentElement.scrollTop;
            const visibleHeight = document.documentElement.clientHeight;

            return Math.ceil(scrolled + visibleHeight) >= scrollableHeight;
        }

        document.addEventListener('scroll', function() {
            isAtBottom = isScrolledToBottom();
        });

        let lastHeight = document.documentElement.scrollHeight;
        let newHeight = document.documentElement.scrollHeight;
        setInterval(function() {
            newHeight = document.documentElement.scrollHeight;
            if(newHeight != lastHeight) {
                lastHeight = newHeight;
                if(isAtBottom) {
                    window.scrollTo({
                        top: document.documentElement.scrollHeight,
                        behavior: 'smooth'
                    });
                }
            }
        }, 300);

    </script>
</div>
