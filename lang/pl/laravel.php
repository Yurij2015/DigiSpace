<?php

return [
    'seo' => [
        'title' => 'Programowanie Laravel: moduły, panele i aplikacje webowe | DigiSpace',
        'description' => 'Tworzenie aplikacji i modułów w Laravel: panele klienta, panele administracyjne Filament, frontend Vue/Nuxt i integracje. Od 9 500 PLN netto lub od 140 PLN/godz.',
    ],

    'nav' => [
        'proofs' => 'Projekty',
        'guarantees' => 'Jak pracujemy',
        'pricing' => 'Cennik',
        'faq' => 'FAQ',
        'cta' => 'Otrzymaj wycenę',
        'skip' => 'Przejdź do treści',
        'theme_toggle' => 'Przełącz jasny / ciemny motyw',
    ],

    'hero' => [
        'badge' => 'Programowanie Laravel · PHP i Filament',
        'title' => 'Programowanie Laravel: moduły, panele i aplikacje webowe',
        'subtitle' => 'Tworzymy nowe aplikacje i osobne moduły w Laravel: panele użytkownika, obsługę zamówień, panele administracyjne w Filament, interfejsy Vue/Nuxt i integracje. Możemy zrealizować ustalony etap albo dołączyć do Twojego zespołu.',
        'subtitle_short' => 'Tworzymy moduły, panele użytkownika, panele administracyjne w Filament i aplikacje webowe w Laravel. Zakres, budżet i termin ustalamy przed startem.',
        'cta_primary' => 'Otrzymaj wycenę zadania',
        'status' => 'Przyjmujemy nowe projekty',
        'metric_labels' => [
            'price' => 'Budżet',
            'timeline' => 'Termin',
            'ownership' => 'Przejrzystość',
        ],
        'metrics' => [
            'price' => 'Od 9 500 PLN netto',
            'timeline' => 'Zwykle 2–6 tygodni',
            'ownership' => 'Kod na Twoim GitHubie i testy',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Produkty w Laravel, które sami stworzyliśmy i utrzymujemy',
        'subtitle' => 'Zobacz nasze działające systemy zbudowane w Laravel, Filament i Vue/Nuxt.',
        'view_live' => 'Otwórz produkt',
        'gallery_hint' => 'Zrzuty ekranu z działających produktów',
        'gallery_open' => 'Otwórz zrzut ekranu',
        'gallery_close' => 'Zamknij',
        'gallery_prev' => 'Poprzedni zrzut ekranu',
        'gallery_next' => 'Następny zrzut ekranu',
        'gallery_count' => 'Zrzuty ekranu: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Własny produkt w Laravel',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Przegląd stron: dostępność, czas odpowiedzi i certyfikaty SSL (nazwy stron rozmyte)'],
                    ['file' => 'digipulse-history', 'caption' => 'Historia strony: czas odpowiedzi i incydenty z ostatniego tygodnia'],
                ],
                'tagline' => 'Monitoring dostępności stron w Laravel Octane, Filament i Go',
                'stack' => ['Laravel Octane', 'Filament', 'PostgreSQL', 'Redis', 'Go'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Platforma B2B Laravel + Nuxt',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Kalendarz miesięczny: liczba wizyt każdego lekarza w poszczególnych dniach (dane demonstracyjne)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Kalendarz wizyt: filtry według oddziałów i lekarzy (dane demonstracyjne)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Panel administracyjny w Filament: plany subskrypcji zsynchronizowane ze Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'Dokumentacja API: żądania do obsługi wizyt'],
                ],
                'tagline' => 'Platforma dla klinik weterynaryjnych: API w Laravel, frontend w Nuxt i płatności Stripe',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Filament', 'Stripe Cashier', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
            ],
            'netpostpanel' => [
                'name' => 'NetPostPanel',
                'mention' => 'Stworzyliśmy też :name, wewnętrzne narzędzie do wyszukiwania źródeł i przygotowywania szkiców z AI: RAG na własnych źródłach z Qdrant i Langfuse. Na nim działa generowanie i tłumaczenie treści z AI na tej stronie.',
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                'link_label' => 'Opis projektu na GitHubie',
            ],
        ],
    ],

    'engine' => [
        'title' => 'Co realizujemy w Laravel',
        'subtitle' => 'Projektujemy strukturę danych, logikę backendu i interfejs pod wymagania Twojego produktu.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Panele użytkownika, role i kontrola dostępu',
            ],
            'billing' => [
                'title' => 'Obsługa zamówień, płatności i subskrypcji (Stripe)',
            ],
            'workers' => [
                'title' => 'Kolejki, zadania w tle i powiadomienia (Redis)',
            ],
            'admin' => [
                'title' => 'Panele administracyjne i wewnętrzne CRM w Filament',
            ],
            'ai' => [
                'title' => 'Interfejsy w Vue / Nuxt, Livewire i Blade',
            ],
            'devops' => [
                'title' => 'Testy automatyczne, CI/CD i wdrożenie w Dockerze',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Jak pracujemy',
        'title' => 'Na co możesz liczyć',
        'subtitle' => 'Dostęp do kodu w trakcie prac, wersja testowa i bezpośrednia rozmowa z programistą.',
        'items' => [
            'staging' => [
                'badge' => 'Wersja testowa',
                'title' => 'Sprawdzaj zmiany przed wdrożeniem',
                'desc' => 'Udostępniamy gotowe moduły w środowisku testowym w trakcie prac, abyś mógł wcześnie zweryfikować działanie i zgłosić uwagi.',
            ],
            'testing' => [
                'badge' => 'Testy',
                'title' => 'Automatyczne testy scenariuszy',
                'desc' => 'Piszemy testy feature i unit dla logiki biznesowej, uprawnień i kluczowych operacji, by nowe zmiany nie psuły działających procesów.',
            ],
            'ownership' => [
                'badge' => 'Współpraca',
                'title' => 'Praca w Twoim repozytorium',
                'desc' => 'Pracujemy przez pull requesty w Twoim GitHubie lub GitLabie albo dajemy dostęp do naszego. Sposób współpracy ustalamy na początku.',
            ],
            'direct' => [
                'badge' => 'Bezpośrednio',
                'title' => 'Bezpośredni kontakt z programistą',
                'desc' => 'Wymagania, ograniczenia i decyzje techniczne omawiasz bezpośrednio z inżynierem, który pisze kod.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Cztery etapy realizacji w Laravel',
        'subtitle' => 'Uporządkowany plan od analizy wymagań do wdrożenia. Czas realizacji zależy od zakresu i stanu kodu.',
        'sprints' => [
            's1' => [
                'name' => 'Analiza zadania i struktury danych',
                'duration' => 'Etap 1',
                'desc' => 'Przeglądamy istniejącą aplikację lub wymagania, projektujemy bazę danych i ustalamy zakres oraz wycenę.',
            ],
            's2' => [
                'name' => 'Logika backendu i API',
                'duration' => 'Etap 2',
                'desc' => 'Tworzymy modele, logikę biznesową, kontrolę uprawnień, kolejki i potrzebne integracje.',
            ],
            's3' => [
                'name' => 'Interfejs i panel administracyjny',
                'duration' => 'Etap 3',
                'desc' => 'Budujemy panel użytkownika (Blade, Livewire, Vue lub Nuxt) oraz panel administracyjny w Filament.',
            ],
            's4' => [
                'name' => 'Testy, wdrożenie i dokumentacja',
                'duration' => 'Etap 4',
                'desc' => 'Testujemy główne scenariusze, przygotowujemy plan wdrożenia i przekazujemy dokumentację uruchomienia.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Pracujesz bezpośrednio z doświadczonym programistą Laravel bez pośredników. Mniejsze zadania wyceniamy od 140 PLN/godz. po przeglądzie kodu.',
        'badge' => 'Cennik',
        'title' => 'Dwie formy współpracy w Laravel',
        'subtitle' => 'Osobny moduł w uzgodnionym zakresie albo regularny rozwój aplikacji w modelu miesięcznym.',
        'plans' => [
            'mvp' => [
                'name' => 'Moduł lub aplikacja w Laravel',
                'badge' => 'Stały zakres',
                'price' => 'od 9 500 PLN',
                'price_sub' => '≈ $2 400 · stały zakres',
                'timeline' => 'Zwykle 2–6 tygodni',
                'desc' => 'Dla nowego modułu, panelu użytkownika, panelu Filament lub nowej aplikacji. Zakres i cenę ustalamy przed rozpoczęciem prac.',
                'features' => [
                    'Projekt bazy danych i architektury modułu',
                    'Logika backendu w Laravel i kontrola uprawnień',
                    'Panel użytkownika lub panel administracyjny (Filament, Vue/Nuxt)',
                    'Integracje z zewnętrznymi API i płatnościami',
                    'Testy automatyczne głównych scenariuszy',
                    'Środowisko testowe do sprawdzenia przed startem',
                    'Kod w Twoim GitHubie i dokumentacja uruchomienia',
                    'Poprawki błędów przez 2 tygodnie po wdrożeniu',
                ],
                'cta' => 'Otrzymaj wycenę',
            ],
            'retainer' => [
                'name' => 'Regularny rozwój w Laravel',
                'badge' => 'Dla zespołu lub produktu',
                'price' => 'od 9 500 PLN',
                'price_sub' => '≈ $2 400 · miesięcznie / od 140 PLN/godz.',
                'timeline' => 'Miesięcznie',
                'desc' => 'Dołączenie do Twojego zespołu lub stały rozwój działającego produktu: nowe funkcje, refaktoring, integracje i przegląd kodu.',
                'features' => [
                    'Uzgodniona liczba godzin tygodniowo',
                    'Praca w Twoim GitHub, Jira lub Linear',
                    'Nowe funkcje i przyspieszanie wolnych zapytań',
                    'Testy automatyczne i utrzymanie CI/CD',
                    'Bezpośredni kontakt na Telegramie lub Slacku',
                    'Cotygodniowe podsumowanie wykonanych zadań',
                ],
                'cta' => 'Porozmawiajmy o współpracy',
            ],
        ],
    ],

    'social_proof' => [
        'badge' => 'Opinie i rekomendacje',
        'items' => [
            'upwork' => [
                'quote' => 'Zaprojektował bazę danych, przygotował architekturę kodu i zaplanował kolejne wydania. Pracuje samodzielnie, przegląda i debuguje kod, regularnie proponuje usprawnienia i wyłapuje błędy logiczne w systemie. … Zawsze był dostępny, gdy projekt potrzebował wsparcia, nie szuka wymówek i jasno się komunikuje.',
                'source' => 'Opinia klienta na Upwork · tłumaczenie z angielskiego',
                'url' => 'https://www.upwork.com/freelancers/mokryiyurii',
            ],
            'linkedin' => [
                'quote' => 'Yurii to odpowiedzialny specjalista, który samodzielnie radzi sobie z szerokim zakresem zadań. Ma solidne doświadczenie w PHP (Symfony, Laravel) i frameworkach JavaScript (Vue.js, Angular) — potrafi samodzielnie zbadać złożone problemy, znaleźć ich przyczynę i wdrożyć skuteczne rozwiązanie.',
                'source' => 'Rekomendacja na LinkedIn · tłumaczenie z angielskiego',
                'url' => 'https://linkedin.com/in/yurii-mokryi',
            ],
        ],
    ],

    'founder' => [
        'badge' => 'Z kim będziesz pracować',
        'name' => 'Yurii Mokryi',
        'role' => 'Założyciel DigiSpace · Solutions Architect & Lead Engineer',
        'bio' => "Tworzę komercyjne aplikacje webowe w PHP, Laravel i Symfony: od marketplace’ów i systemów CRM dla klientów po własne produkty DigiPulse i VetSpace.\n\nZaczynam od analizy wymagań, struktury danych i ograniczeń projektu. Postępy sprawdzasz w środowisku testowym na każdym etapie.",
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'Laravel, Filament, Vue/Nuxt, PostgreSQL, Docker',
            'Własne produkty: DigiPulse, VetSpace, NetPostPanel',
            'Współpraca zdalna w Polsce, Ukrainie, UE i USA',
        ],
        'links' => [
            'linkedin' => 'https://linkedin.com/in/yurii-mokryi',
            'github' => 'https://github.com/Yurij2015',
            'upwork' => 'https://www.upwork.com/freelancers/mokryiyurii',
            'youtube' => 'https://www.youtube.com/@YuriiMokryi',
            'tiktok' => 'https://www.tiktok.com/@yriimokryi',
            'instagram' => 'https://www.instagram.com/yurii_mokryi',
        ],
    ],

    'faq' => [
        'badge' => 'FAQ',
        'title' => 'Częste pytania o programowanie Laravel',
        'subtitle' => 'Istniejące systemy, Filament, dostęp do kodu i płatności.',
        'items' => [
            'q1' => [
                'q' => 'Czy rozwijacie istniejące aplikacje w Laravel?',
                'a' => 'Tak. Najpierw przeglądamy repozytorium, strukturę bazy, zależności i sposób wdrażania. Potem planujemy zmiany tak, aby nowy moduł pasował do działającego systemu.',
            ],
            'q2' => [
                'q' => 'Czy tworzycie panele administracyjne Filament i frontend w Vue lub Nuxt?',
                'a' => 'Tak. Budujemy panele administracyjne i wewnętrzne narzędzia w Filament oraz interfejsy użytkownika w Vue/Nuxt, Livewire lub Blade zależnie od wymagań.',
            ],
            'q3' => [
                'q' => 'Jak wygląda dostęp do kodu?',
                'a' => 'Pracujemy w Twoim repozytorium GitHub lub GitLab przez pull requesty albo udostępniamy nasze. Warunki przekazania kodu ustalamy przed startem.',
            ],
            'q4' => [
                'q' => 'Czego potrzebujecie do wyceny?',
                'a' => 'Krótkiego opisu zadania, makiet lub linku do obecnej aplikacji. W istniejących projektach krótki przegląd kodu pozwala dokładniej oszacować zakres.',
            ],
            'q5' => [
                'q' => 'Jak sprawdzacie, czy zmiany nie zepsują działających funkcji?',
                'a' => 'Pokrywamy kluczowe scenariusze testami automatycznymi, sprawdzamy zmiany w środowisku testowym i przygotowujemy plan wdrożenia.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Przy stałym zakresie rozliczenie dzielimy na etapy (faktura VAT lub escrow). Współpracę miesięczną lub godzinową rozliczamy fakturą według ustalonego harmonogramu.',
            ],
            'q7' => [
                'q' => 'Z klientami z jakich krajów pracujecie?',
                'a' => 'Pracujemy zdalnie z firmami z Polski, Ukrainy, UE, Wielkiej Brytanii, USA i Kanady. Rozmawiamy po polsku, ukraińsku i angielsku.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Porozmawiajmy o Twoim zadaniu w Laravel',
        'subtitle' => 'Opisz, co trzeba zbudować lub rozwinąć. Doprecyzujemy szczegóły i przygotujemy wstępną wycenę.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'project_name' => 'Imię lub nazwa firmy',
            'project_name_placeholder' => 'Aleksander / Firma sp. z o.o.',
            'contact' => 'Telegram lub e-mail',
            'contact_placeholder' => '@username lub name@company.com',
            'stage' => 'Etap projektu',
            'not_specified' => 'Nie podano',
            'stage_options' => [
                'idea' => 'Nowy produkt lub moduł od zera',
                'spec' => 'Mam specyfikację lub makiety',
                'rewrite' => 'Istniejący projekt Laravel do rozwoju',
            ],
            'budget' => 'Orientacyjny budżet',
            'budget_options' => [
                'sprint' => '9 500 – 20 000 PLN (moduł / panel)',
                'custom' => '20 000+ PLN (pełna aplikacja)',
                'retainer' => 'Współpraca miesięczna / godzinowa',
            ],
            'description' => 'Krótki opis zadania',
            'description_placeholder' => 'Jakie funkcje trzeba zbudować lub rozwinąć w Laravel?',
            'submit' => 'Otrzymaj wycenę',
            'response_time' => 'Odpowiadamy w ciągu jednego dnia roboczego.',
            'errors_title' => 'Sprawdź formularz:',
            'validation' => [
                'required' => 'Uzupełnij pole „:attribute”.',
                'max' => 'Pole „:attribute” jest za długie (maks. :max znaków).',
                'invalid' => 'Wybierz wartość z listy w polu „:attribute”.',
            ],
            'recaptcha_failed' => 'Weryfikacja reCAPTCHA nie powiodła się. Spróbuj ponownie albo napisz do nas na Telegramie.',
            'recaptcha_notice' => 'Formularz chroni reCAPTCHA:',
            'recaptcha_privacy' => 'Polityka prywatności Google',
            'recaptcha_terms' => 'Warunki korzystania',
            'privacy_notice' => 'Administratorem danych jest Yurii Mokryi JDG. Dane z formularza wykorzystujemy wyłącznie do odpowiedzi na Twoje zapytanie.',
            'success_title' => 'Dziękujemy!',
            'success_message' => 'Otrzymaliśmy Twoją wiadomość. W ciągu jednego dnia roboczego prześlemy dodatkowe pytania lub wstępną wycenę.',
        ],
    ],

    'footer' => [
        'legal' => 'Yurii Mokryi JDG · NIP 7773404080 · REGON 524949632',
        'privacy_policy' => 'Polityka prywatności',
        'tagline' => 'Programowanie Laravel, Symfony i PHP',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Stęszew pod Poznaniem, Wielkopolska, Polska.',
    ],
];
