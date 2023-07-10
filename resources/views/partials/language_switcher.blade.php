<li class="menu-item-has-children">
    <a href="#" role="button" aria-haspopup="true" id="dropdownMenuButton" aria-expanded="false">
        {{ $current_locale_name }}</a>
        <i class='bx bx-plus dropdown-icon' role="presentation"></i>
    <ul class="submenu" aria-labelledby="dropdownMenuButton">
        @foreach($available_locales as $locale_name => $available_locale)
            @if($available_locale != $current_locale)
            <li><a href="{{ route('setLocale', $available_locale) }}" role="button">
                    {{ __('global.'. $locale_name)}}
                </a></li>
            @endif
        @endforeach
    </ul>
</li>