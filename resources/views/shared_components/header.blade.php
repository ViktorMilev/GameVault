<div class="app-header-header-shell">
    <div class="app-header-header-bar">
        <div class="app-header-header-actions">
            <div>
                @guest
                    <a href="{{ route('login') }}" class="app-header-action-btn">
                        {{ $t['general']['login'] }}
                    </a>
                @endguest

                @auth
                    <a href="{{ route('logout') }}" class="app-header-action-btn">
                        {{ $t['general']['logout'] }}
                    </a>
                @endauth
            </div>

            <div>
                <form method="POST" action="{{ route('app.lang.switch') }}" id="language-form">
                    @csrf
                    <div class="app-header-lang-box">
                        <span class="app-header-lang-label">LANG</span>
                        <div class="app-header-lang-select-wrap">
                            <select
                                name="locale"
                                class="app-header-lang-select"
                                onchange="this.form.submit()"
                            >
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                                <option value="bg" {{ app()->getLocale() == 'bg' ? 'selected' : '' }}>BG</option>
                                <option value="ru" {{ app()->getLocale() == 'ru' ? 'selected' : '' }}>RU</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="app-header-logo-stage">
        <div class="app-header-logo-frame">
            <h1 class="logo" data-text="{{ Config::get('site_vars.site_name') }}">
                {{ Config::get('site_vars.site_name') }}
            </h1>
        </div>
    </div>
</div>

<style>
    .app-header-header-shell {
        position: relative;
        padding: 12px 12px 20px;
        background:
            radial-gradient(circle at top right, rgba(var(--admin-primary-rgb-2), 0.10), transparent 28%),
            radial-gradient(circle at top left, rgba(0, 180, 255, 0.08), transparent 24%);
    }

    .app-header-header-bar {
        display: flex;
        justify-content: flex-end;
    }

    .app-header-header-actions {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 10px 12px;
        border: 1px solid rgba(var(--admin-primary-rgb-3), 0.18);
        border-radius: 18px;
        background: linear-gradient(180deg, rgba(18, 18, 18, 0.95), rgba(8, 8, 8, 0.88));
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.35),
            0 0 0 1px rgba(255, 255, 255, 0.03) inset,
            0 0 18px rgba(var(--admin-primary-rgb-3), 0.08);
        backdrop-filter: blur(10px);
    }

    .app-header-action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 108px;
        height: 40px;
        padding: 0 18px;
        border-radius: 12px;
        border: 1px solid rgba(var(--admin-primary-rgb-3), 0.32);
        background: var(--button-gradient);
        color: var(--admin-primary-color-1) !important;
        text-decoration: none;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 10pt;
        font-weight: 700;
        transition: all 0.2s ease;
        box-shadow: 0 0 16px rgba(var(--admin-primary-rgb-3), 0.10);
    }

    .app-header-action-btn:hover {
        color: var(--admin-primary-color-1) !important;
        transform: translateY(-1px);
        border-color: rgba(var(--admin-primary-rgb-3), 0.55);
        box-shadow:
            0 0 22px rgba(var(--admin-primary-rgb-3), 0.18),
            0 8px 20px rgba(0, 0, 0, 0.28);
    }

    .app-header-lang-box {
        display: flex;
        align-items: center;
        gap: 10px;
        height: 40px;
        padding: 0 12px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        background: rgba(255, 255, 255, 0.04);
    }

    .app-header-lang-label {
        color: var(--admin-secondary-color-2);
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 1.5px;
    }

    .app-header-lang-select-wrap {
        position: relative;
        min-width: 78px;
    }

    .app-header-lang-select-wrap::after {
        content: "";
        position: absolute;
        top: 50%;
        right: 10px;
        width: 8px;
        height: 8px;
        border-right: 2px solid rgba(var(--admin-secondary-color-rgb-2), 0.8);
        border-bottom: 2px solid rgba(var(--admin-secondary-color-rgb-2), 0.8);
        transform: translateY(-60%) rotate(45deg);
        pointer-events: none;
    }

    .app-header-lang-select {
        width: 100%;
        height: 34px;
        padding: 0 28px 0 10px;
        border: 1px solid rgba(var(--admin-primary-rgb-3), 0.18);
        border-radius: 10px;
        background: linear-gradient(180deg, rgba(20, 20, 20, 0.95), rgba(10, 10, 10, 0.95));
        color: #ecf8e8;
        font-weight: 700;
        letter-spacing: 0.8px;
        cursor: pointer;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        box-shadow: inset 0 0 0 1px rgba(255,255,255,0.02);
    }

    .app-header-lang-select:hover {
        border-color: rgba(var(--admin-primary-rgb-3), 0.38);
    }

    .app-header-lang-select:focus {
        outline: none;
        border-color: rgba(var(--admin-primary-rgb-3), 0.55);
        box-shadow: 0 0 0 3px rgba(var(--admin-primary-rgb-3), 0.12);
    }

    .app-header-lang-select option {
        background: #101010;
        color: #f5f5f5;
        font-weight: 700;
    }

    .app-header-logo-stage {
        display: flex;
        justify-content: center;
        padding-top: 34px;
    }

    .app-header-logo-frame {
        position: relative;
        padding: 18px 34px;
        border-radius: 20px;
    }

    .app-header-logo-frame::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 20px;
        pointer-events: none;
    }

    @media (max-width: 768px) {
        .app-header-header-shell {
            padding: 16px 14px 24px;
        }

        .app-header-header-bar {
            justify-content: center;
        }

        .app-header-header-actions {
            width: 100%;
            justify-content: center;
            flex-wrap: wrap;
        }

        .app-header-action-btn {
            min-width: 110px;
        }

        .app-header-logo-stage {
            padding-top: 24px;
        }

        .app-header-logo-frame {
            padding: 14px 18px;
            text-align: center;
        }
    }
</style>