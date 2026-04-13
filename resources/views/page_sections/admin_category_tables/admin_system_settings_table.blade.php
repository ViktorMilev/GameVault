{{-- TABLE CONTAINER --}}
<div class="admin-card">

    <div>
            <div class="">
                <form method="POST" action="{{ route('admin.lang.switch') }}" id="language-form">
                    @csrf
                    <label>{{ $t['general']['language'] }}:</label>
                    <select name="locale" 
                            class="form-select form-select-sm" 
                            style="width: 150px;" 
                            onchange="this.form.submit()">

                        <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>{{ $t['general']['languages']['en'] }}</option>
                        <option value="bg" {{ app()->getLocale() == 'bg' ? 'selected' : '' }}>{{ $t['general']['languages']['bg'] }}</option>
                        <option value="ru" {{ app()->getLocale() == 'ru' ? 'selected' : '' }}>{{ $t['general']['languages']['ru'] }}</option>
                    </select>
                </form>
            </div>

            <hr class="my-3" />

            <div>
                <form method="POST" action="{{ route('admin.system.theme.change') }}">
                    @csrf
                    <div>
                        <label for="theme-select">{{ $t['general']['theme'] }}:</label>
                        <select id="theme=select"
                            name="theme"
                            class="form-select form-select-sm"
                            style="width: 150px;"
                            onchange="this.form.submit()">

                            <option value="purple-default" {{ $currentTheme == 'purple-default' ? 'selected' : '' }}>Purple (Default)</option>
                            <option value="gray" {{ $currentTheme == 'gray' ? 'selected' : '' }}>Gray</option>
                            <option value="blue" {{ $currentTheme == 'blue' ? 'selected' : '' }}>Blue</option>
                        </select>
                    </div>
                </form>
            </div>  
    </div>
</div>