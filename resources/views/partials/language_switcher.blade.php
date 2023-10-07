<li class="menu-item-has-children">
    <a href="#" role="button" aria-haspopup="true" id="dropdownMenuButton" aria-expanded="false">
        {{ $current_locale_name }}</a>
        <i class='bx bx-plus dropdown-icon' role="presentation"></i>
    <ul class="submenu" aria-labelledby="dropdownMenuButton">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <li>
                <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    {{ $properties['native'] }}
                </a>
            </li>
        @endforeach
    </ul>
</li>