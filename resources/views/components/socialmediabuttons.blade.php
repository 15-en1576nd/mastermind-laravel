<div class="flex justify-around">
    <a href="https://twitter.com/intent/tweet?text=Can I guess the {{ $game['length'] }} Emoji long code in 12 guesses?&url={{ url()->current() }}" target="_blank">
        <i class="fab fa-twitter" alt="Twitter"></i>
    </a>
    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ url()->current() }}" target="_blank">
        <i class="fab fa-linkedin-in" alt="Linkedin"></i>
    </a>
    <a href="https://www.reddit.com/submit?url={{ url()->current() }}&title=Can I guess the {{ $game['length'] }} Emoji long code in 12 guesses?" target="_blank">
        <i class="fab fa-reddit-alien" alt="Reddit"></i>
    </a>
</div>
