@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => 'https://dev.ujian.bimantara.web.id'])
            STMIK Bandung
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} STMIK Bandung. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
