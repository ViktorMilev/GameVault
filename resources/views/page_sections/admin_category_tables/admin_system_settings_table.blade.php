{{-- TABLE CONTAINER --}}
<div class="admin-card">

    <div>
        <div class="">
            <div class="d-none">
                <label>Language:</label>
                <select class="form-select form-select-sm" style="width: 150px;">
                    <option value="en">English</option>
                    <option value="es">Spanish</option>
                    <option value="fr">French</option>
                    <option value="de">German</option>
                </select>
            </div>

            <hr class="my-3" />

            <div>
                <form method="POST" action="{{ route('theme.change') }}">
                    @csrf
                    <div>
                        <label for="theme-select">Theme:</label>
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