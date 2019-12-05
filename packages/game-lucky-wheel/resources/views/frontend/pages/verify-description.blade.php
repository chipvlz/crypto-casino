<p>
    {{ __('When you open the game page the server generates a secret and a seed and reveals its hash (using HMAC SHA256 algorithm).') }}
    {{ __('The server secret represents initial wheel position.') }}
    {{ __('The server seed is a cryptographically secure random alpha-numeric string.') }}
    {{ __('The hash of these 2 strings helps to ensure that the initial wheel position is not altered after you place a bet.') }}
    {{ __('After the game is finished the server secret and the server seed are revealed, so you can easily calculate and verify the hash.') }}
</p>
<p>
    {{ __('When you play a game you can pass an extra custom string - client seed (if it\'s not specified a random number is automatically generated by your browser).') }}
    {{ __('The server will then calculate another hash using the server secret, the server seed and the client seed.') }}
    {{ __('The last 5 chars of this hash (representing a hexadecimal value) will be converted to an integer (Shift value).') }}
    {{ __('The wheel will be spinned N extra times, where N corresponds to the Shift value.') }}
    {{ __('Because the client seed can not be predicted by the server the number of extra spins is completely random and hence you can be sure that the game result is fair.') }}
</p>
