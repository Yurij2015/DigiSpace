<?php

return [
    'seo' => [
        'title' => 'Audyt kodu PHP, Laravel i Symfony | DigiSpace',
        'description' => 'Ręczny audyt kodu PHP, Laravel i Symfony: kontrola dostępu, płatności, wolne zapytania do bazy i raport z priorytetami ze wskazaniem plików i linii. Od 4 000 PLN netto.',
    ],

    'nav' => [
        'proofs' => 'Projekty',
        'guarantees' => 'Jak pracujemy',
        'pricing' => 'Cennik',
        'faq' => 'FAQ',
        'cta' => 'Omów audyt',
        'skip' => 'Przejdź do treści',
        'theme_toggle' => 'Przełącz jasny / ciemny motyw',
    ],

    'hero' => [
        'badge' => 'Audyt techniczny · PHP / Laravel / Symfony',
        'title' => 'Audyt kodu PHP: konkretne znaleziska i plan poprawek',
        'subtitle' => 'Sprawdzamy kod projektu PHP, Laravel lub Symfony, aby znaleźć przyczyny błędów, luki w dostępie do danych, problemy z płatnościami i wolne zapytania do bazy. Otrzymujesz raport z plikami, liniami i priorytetami dla swojego zespołu.',
        'subtitle_short' => 'Ręczny przegląd kodu PHP, Laravel i Symfony: dostęp do danych, płatności, baza danych i testy. Raport z linkami do kodu w 3–7 dni roboczych.',
        'cta_primary' => 'Omów zakres audytu',
        'status' => 'Przyjmujemy projekty na audyt',
        'metric_labels' => [
            'price' => 'Koszt',
            'timeline' => 'Czas realizacji',
            'ownership' => 'Rezultat',
        ],
        'metrics' => [
            'price' => 'Od 4 000 PLN netto',
            'timeline' => 'Raport w 3–7 dni roboczych',
            'ownership' => 'Plik, linia, skutek i plan naprawy',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Praktyka produkcyjna',
        'subtitle' => 'Sami projektujemy i utrzymujemy działające systemy PHP, dlatego w audycie skupiamy się na defektach wpływających na dane, płatności i stabilność.',
        'view_live' => 'Otwórz produkt',
        'gallery_hint' => 'Zrzuty ekranu z działających produktów',
        'gallery_open' => 'Otwórz zrzut ekranu',
        'gallery_close' => 'Zamknij',
        'gallery_prev' => 'Poprzedni zrzut ekranu',
        'gallery_next' => 'Następny zrzut ekranu',
        'gallery_count' => 'Zrzuty ekranu: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Własny produkt SaaS',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Przegląd stron: dostępność, czas odpowiedzi i certyfikaty SSL (nazwy stron rozmyte)'],
                    ['file' => 'digipulse-history', 'caption' => 'Historia strony: czas odpowiedzi i incydenty z ostatniego tygodnia'],
                ],
                'tagline' => 'Architektura z pomiarem czasu odpowiedzi, kolejkami i izolacją workerów',
                'stack' => ['Laravel Octane', 'PostgreSQL', 'Redis', 'PHPStan', 'Go'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Platforma B2B multi-tenant',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Kalendarz miesięczny: liczba wizyt każdego lekarza w poszczególnych dniach (dane demonstracyjne)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Kalendarz wizyt: filtry według oddziałów i lekarzy (dane demonstracyjne)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Panel administracyjny w Filament: plany subskrypcji zsynchronizowane ze Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'Dokumentacja API: żądania do obsługi wizyt'],
                ],
                'tagline' => 'Izolacja danych firm, kontrola uprawnień, billing Stripe i testy automatyczne',
                'stack' => ['Laravel', 'Multi-tenancy', 'Stripe', 'PHPUnit', 'PostgreSQL'],
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
        'title' => 'Co sprawdzamy podczas audytu kodu PHP',
        'subtitle' => 'Skupiamy czas audytu na modułach najważniejszych dla Twojego biznesu.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Bezpieczeństwo, autoryzacja i kontrola dostępu do danych',
            ],
            'billing' => [
                'title' => 'Logika płatności, zamówień i webhooków',
            ],
            'workers' => [
                'title' => 'Zapytania do bazy danych, indeksy i problemy N+1',
            ],
            'admin' => [
                'title' => 'Kolejki, zadania w tle i wyścigi (race conditions)',
            ],
            'ai' => [
                'title' => 'Zależności, wersje PHP/frameworka i pokrycie testami',
            ],
            'devops' => [
                'title' => 'Proces wdrożeń, backupy i konfiguracja',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Forma raportu',
        'title' => 'Co otrzymasz po audycie',
        'subtitle' => 'Potwierdzone w kodzie fakty i jasne granice przeglądu, które zespół może od razu zamienić w zadania.',
        'items' => [
            'staging' => [
                'badge' => 'Konkrety',
                'title' => 'Wskazanie plików i linii kodu',
                'desc' => 'Każde znalezisko zawiera ścieżkę w repozytorium, opis skutków i rekomendowany sposób naprawy.',
            ],
            'testing' => [
                'badge' => 'Priorytety',
                'title' => 'Potwierdzone defekty oddzielone od porad',
                'desc' => 'Oddzielamy zweryfikowane błędy i ryzyka bezpieczeństwa od sugestii dotyczących struktury kodu, aby zespół widział realne priorytety.',
            ],
            'ownership' => [
                'badge' => 'Poufność',
                'title' => 'Praca na podstawie NDA',
                'desc' => 'Podpisujemy NDA przed przekazaniem dostępu; w większości przypadków wystarczy dostęp read-only do repozytorium.',
            ],
            'direct' => [
                'badge' => 'Omówienie',
                'title' => 'Wspólne omówienie raportu',
                'desc' => 'Przechodzimy przez znaleziska z Tobą lub Twoim zespołem, odpowiadamy na pytania i planujemy kolejne kroki.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Jak przebiega audyt',
        'subtitle' => 'Od ustalenia priorytetów do gotowego raportu w 3–7 dni roboczych zależnie od wielkości kodu.',
        'sprints' => [
            's1' => [
                'name' => 'Zakres i priorytety',
                'duration' => 'Dzień 1',
                'desc' => 'Ustalamy główne pytania: dostęp do danych, płatności, szybkość, utrzymanie lub przegląd przed wydaniem.',
            ],
            's2' => [
                'name' => 'Analiza kodu i zależności',
                'duration' => 'Dni 2–4',
                'desc' => 'Czytamy kod, migracje, zapytania SQL i testy; jeśli istnieje środowisko testowe, odtwarzamy błędne scenariusze.',
            ],
            's3' => [
                'name' => 'Przygotowanie raportu',
                'duration' => 'Dni 5–6',
                'desc' => 'Opisujemy sprawdzone obszary, oddzielamy potwierdzone defekty od założeń i porządkujemy priorytety.',
            ],
            's4' => [
                'name' => 'Omówienie i plan działań',
                'duration' => 'Dzień 7',
                'desc' => 'Omawiamy raport na spotkaniu online; opcjonalnie możemy ustalić osobny etap na naprawę krytycznych problemów.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Audyt daje obiektywny obraz stanu kodu, zanim zainwestujesz w przepisywanie aplikacji lub zmianę wykonawcy.',
        'badge' => 'Cennik',
        'title' => 'Dwie formy audytu kodu PHP',
        'subtitle' => 'Samodzielny raport audytowy dla zespołu lub audyt połączony z naprawą uzgodnionych krytycznych problemów.',
        'plans' => [
            'mvp' => [
                'name' => 'Audyt PHP / Laravel / Symfony',
                'badge' => 'Raport + plan działań',
                'price' => 'od 4 000 PLN',
                'price_sub' => '≈ $1 000 · stały zakres',
                'timeline' => '3–7 dni roboczych',
                'desc' => 'Przegląd wybranych modułów lub kluczowych części aplikacji z raportem priorytetów i rozmową podsumowującą.',
                'features' => [
                    'Przegląd architektury, bezpieczeństwa i uprawnień',
                    'Analiza krytycznych modułów (płatności, zamówienia, API)',
                    'Wyszukiwanie wolnych zapytań SQL i wąskich gardeł',
                    'Ocena zależności, wersji PHP i pokrycia testami',
                    'Raport ze wskazaniem plików i linii kodu',
                    'Rozdzielenie potwierdzonych defektów i porad',
                    'Plan działań z orientacyjną oceną napraw',
                    'Spotkanie online z omówieniem wyników',
                ],
                'cta' => 'Omów audyt',
            ],
            'retainer' => [
                'name' => 'Audyt + naprawa krytycznych błędów',
                'badge' => 'Raport i poprawki',
                'price' => 'od 8 800 PLN',
                'price_sub' => '≈ $2 200 · stały zakres',
                'timeline' => 'Zwykle 2–3 tygodnie',
                'desc' => 'Audyt kodu oraz wdrożenie poprawek dla uzgodnionych krytycznych problemów bezpieczeństwa, szybkości i stabilności.',
                'features' => [
                    'Wszystko z pakietu „Audyt PHP / Laravel / Symfony”',
                    'Naprawa uzgodnionych błędów krytycznych i luk',
                    'Przyspieszenie najwolniejszych zapytań do bazy',
                    'Testy automatyczne dla naprawionych scenariuszy',
                    'Pull requesty w Twoim repozytorium',
                    'Wsparcie podczas wdrożenia zmian',
                ],
                'cta' => 'Omów audyt i poprawki',
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
        'badge' => 'Kto wykonuje audyt',
        'name' => 'Yurii Mokryi',
        'role' => 'Założyciel DigiSpace · Solutions Architect & Lead Engineer',
        'bio' => "Każdy audyt wykonuję osobiście: czytam rzeczywisty kod, sprawdzam uprawnienia, logikę płatności i zapytania do bazy zamiast przesyłać wydruki z automatycznych skanerów.\n\nW raporcie wyraźnie oddzielam potwierdzone błędy od założeń i porad dotyczących refaktoringu.",
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'Ręczny przegląd logiki biznesowej i kodu',
            'Laravel, Symfony, PostgreSQL, MySQL, bezpieczeństwo',
            'Praca pod NDA dla klientów z Polski, Ukrainy, UE i USA',
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
        'title' => 'Częste pytania o audyt kodu PHP',
        'subtitle' => 'Dostępy, NDA, forma raportu i dalsze kroki.',
        'items' => [
            'q1' => [
                'q' => 'Kiedy warto zamówić audyt kodu?',
                'a' => 'Gdy po wydaniach regularnie pojawiają się błędy, aplikacja działa wolno, zmieniasz wykonawcę, planujesz dużą aktualizację albo chcesz ocenić ryzyko techniczne przed inwestycją.',
            ],
            'q2' => [
                'q' => 'Jakich dostępów potrzebujecie?',
                'a' => 'Zwykle wystarcza dostęp read-only do repozytorium Git. Przy sprawdzaniu wydajności pomocny jest też staging lub zanonimizowany schemat bazy.',
            ],
            'q3' => [
                'q' => 'Czy podpisujecie NDA?',
                'a' => 'Tak, podpisujemy NDA przed otrzymaniem jakichkolwiek dostępów czy dokumentacji.',
            ],
            'q4' => [
                'q' => 'Czym ten audyt różni się od automatycznych skanerów?',
                'a' => 'Analizę statyczną traktujemy tylko jako narzędzie pomocnicze. Główną wartość daje ręczne sprawdzenie logiki biznesowej: uprawnień, płatności, transakcji, architektury i zapytań SQL.',
            ],
            'q5' => [
                'q' => 'Czy nasz zespół samodzielnie wdroży poprawki na podstawie raportu?',
                'a' => 'Tak, raport ma formę uporządkowanej listy technicznej: plik, linia, opis problemu, skutek i rekomendowana poprawka.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => '50% zaliczki przed startem i 50% po dostarczeniu raportu i rozmowie podsumowującej, na podstawie faktury VAT.',
            ],
            'q7' => [
                'q' => 'Z klientami z jakich krajów pracujecie?',
                'a' => 'Pracujemy zdalnie z firmami z Polski, Ukrainy, UE, Wielkiej Brytanii, USA i Kanady.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Omów audyt kodu PHP',
        'subtitle' => 'Opisz swoją aplikację i pytania, na które ma odpowiedzieć przegląd. Ustalimy zakres, termin i koszt.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'project_name' => 'Imię lub nazwa firmy',
            'project_name_placeholder' => 'Aleksander / Firma sp. z o.o.',
            'contact' => 'Telegram lub e-mail',
            'contact_placeholder' => '@username lub name@company.com',
            'stage' => 'Główny cel audytu',
            'not_specified' => 'Nie podano',
            'stage_options' => [
                'idea' => 'Ogólny audyt techniczny / weryfikacja wykonawcy',
                'spec' => 'Bezpieczeństwo, uprawnienia lub problemy z płatnościami',
                'rewrite' => 'Wolne działanie, błędy lub przygotowanie do skalowania',
            ],
            'budget' => 'Format audytu',
            'budget_options' => [
                'sprint' => 'Sam audyt i raport (od 4 000 PLN)',
                'custom' => 'Audyt + naprawa krytycznych błędów (od 8 800 PLN)',
                'retainer' => 'Audyt z dalszym wsparciem',
            ],
            'description' => 'Krótki opis projektu',
            'description_placeholder' => 'Jaki framework (Laravel / Symfony / PHP) i na jakie pytania ma odpowiedzieć audyt?',
            'submit' => 'Omów audyt',
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
        'tagline' => 'Audyt kodu PHP, Laravel i Symfony',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Stęszew pod Poznaniem, Wielkopolska, Polska.',
    ],
];
