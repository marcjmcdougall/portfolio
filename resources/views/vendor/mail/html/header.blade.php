@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" 
    style="display: inline-block;">
    <img class="header__image"
        src="{{ asset('img/me-zoomed.jpg') }}"/>
    <p>Marc McDougall</p>
    {{ $slot }}
</a>
</td>
</tr>
