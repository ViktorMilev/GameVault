<div class="d-flex justify-content-end g-4 p-2">
    <div>
        <a href="{{ route('loginpage') }}" class="button btn btn-light w-100">{{ $t['general']['login'] }}</a>
    </div>  
    <div>
        <form method="POST" action="{{ route('app.lang.switch') }}" id="language-form">
            @csrf
            <select name="locale" 
                    class="form-select form-select-sm" 
                    style="width: 70px;" 
                    onchange="this.form.submit()">

                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                <option value="bg" {{ app()->getLocale() == 'bg' ? 'selected' : '' }}>BG</option>
                <option value="ru" {{ app()->getLocale() == 'ru' ? 'selected' : '' }}>RU</option>
            </select>
        </form>
    </div>
</div>

<div class="d-flex justify-content-center p-4">
    <div class="">
        <h1 class="logo" data-text="{{ Config::get('site_vars.site_name') }}">{{ Config::get('site_vars.site_name') }}</h1>
    </div>
    
</div>