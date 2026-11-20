<?php

return [
    'seo' => [
        'title' => 'Wsparcie, aktualizacje i stabilizacja PHP, Laravel i Symfony | DigiSpace',
        'description' => 'Wsparcie projektów PHP, Laravel i Symfony: naprawa błędów, aktualizacje wersji, stabilizacja legacy, przyspieszanie stron i stała opieka. Od 140 PLN/godz. lub od 6 400 PLN.',
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
        'badge' => 'Wsparcie i aktualizacje · PHP / Laravel / Symfony',
        'title' => 'Wsparcie, aktualizacje i stabilizacja projektów PHP',
        'subtitle' => 'Pomagamy w projektach PHP, Laravel i Symfony wymagających poprawek, aktualizacji wersji, przyspieszenia lub regularnej opieki. Realizujemy zarówno jednorazowe prace stabilizacyjne, jak i stałe wsparcie miesięczne.',
        'subtitle_short' => 'Naprawiamy błędy, aktualizujemy Laravel, Symfony i PHP, przyspieszamy wolne strony i zapewniamy planową opiekę nad aplikacjami PHP.',
        'cta_primary' => 'Oceń stan projektu',
        'status' => 'Przyjmujemy projekty pod opiekę',
        'metric_labels' => [
            'price' => 'Koszt',
            'timeline' => 'Start',
            'ownership' => 'Bezpieczeństwo',
        ],
        'metrics' => [
            'price' => 'Od 140 PLN/godz. lub 6 400 PLN',
            'timeline' => 'Diagnoza w 1–3 dni',
            'ownership' => 'Backupy, testy i plan wycofania',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Systemy produkcyjne, które sami utrzymujemy',
        'subtitle' => 'Utrzymujemy własne działające produkty: kopie zapasowe, monitoring dostępności, testy automatyczne i planowe aktualizacje zależności.',
        'view_live' => 'Otwórz produkt',
        'gallery_hint' => 'Zrzuty ekranu z działających produktów',
        'gallery_open' => 'Otwórz zrzut ekranu',
        'gallery_close' => 'Zamknij',
        'gallery_prev' => 'Poprzedni zrzut ekranu',
        'gallery_next' => 'Następny zrzut ekranu',
        'gallery_count' => 'Zrzuty ekranu: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Monitoring produkcyjny',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Przegląd stron: dostępność, czas odpowiedzi i certyfikaty SSL (nazwy stron rozmyte)'],
                    ['file' => 'digipulse-history', 'caption' => 'Historia strony: czas odpowiedzi i incydenty z ostatniego tygodnia'],
                ],
                'tagline' => 'Własna usługa monitorowania dostępności, certyfikatów SSL i czasu odpowiedzi',
                'stack' => ['Laravel Octane', 'Docker', 'PostgreSQL', 'Redis', 'Monitoring'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'System B2B pod stałą opieką',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Kalendarz miesięczny: liczba wizyt każdego lekarza w poszczególnych dniach (dane demonstracyjne)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Kalendarz wizyt: filtry według oddziałów i lekarzy (dane demonstracyjne)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Panel administracyjny w Filament: plany subskrypcji zsynchronizowane ze Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'Dokumentacja API: żądania do obsługi wizyt'],
                ],
                'tagline' => 'Platforma z testami automatycznymi, wdrożeniami CI/CD i regularnymi aktualizacjami',
                'stack' => ['Laravel', 'PHPUnit', 'CI/CD', 'Docker', 'PostgreSQL'],
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
        'title' => 'W czym pomagamy działającym aplikacjom PHP',
        'subtitle' => 'Przywracamy kontrolę nad kodem i zmniejszamy dług technologiczny w kolejnych krokach.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Aktualizacje Laravel, Symfony i PHP 7 → 8.x',
            ],
            'billing' => [
                'title' => 'Stabilizacja projektów legacy po zmianie wykonawcy',
            ],
            'workers' => [
                'title' => 'Naprawa krytycznych błędów i zablokowanych kolejek',
            ],
            'admin' => [
                'title' => 'Przyspieszanie wolnych stron i zapytań SQL',
            ],
            'ai' => [
                'title' => 'Kopie zapasowe, monitoring i śledzenie błędów',
            ],
            'devops' => [
                'title' => 'Konfiguracja Dockera i powtarzalnych wdrożeń',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Jak pracujemy',
        'title' => 'Ostrożna praca na działającym systemie',
        'subtitle' => 'Najpierw backupy i odizolowana kopia testowa, bez ryzykownych zmian bezpośrednio na produkcji.',
        'items' => [
            'staging' => [
                'badge' => 'Bezpieczeństwo',
                'title' => 'Najpierw kopia i zweryfikowany backup',
                'desc' => 'Odtwarzamy aplikację w środowisku testowym i sprawdzamy przywracanie kopii bazy przed zmianami na serwerze produkcyjnym.',
            ],
            'testing' => [
                'badge' => 'Kontrola',
                'title' => 'Testy automatyczne przed aktualizacją',
                'desc' => 'Pokrywamy kluczowe scenariusze testami, aby aktualizacja frameworka i pakietów nie wprowadziła ukrytych błędów.',
            ],
            'ownership' => [
                'badge' => 'Porządek',
                'title' => 'Dokumentacja środowiska i wdrożeń',
                'desc' => 'Porządkujemy zależności, zmienne środowiskowe i procedury deployu, by projekt nie zależał od jednej osoby.',
            ],
            'direct' => [
                'badge' => 'Bezpośrednio',
                'title' => 'Bezpośredni kontakt z programistą',
                'desc' => 'Rozmawiasz na Telegramie lub Slacku wprost z inżynierem, który zna Twój kod i konfigurację serwera.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Jak przebiega aktualizacja lub stabilizacja',
        'subtitle' => 'Cztery kroki od przestarzałego lub niestabilnego kodu do przewidywalnego systemu.',
        'sprints' => [
            's1' => [
                'name' => 'Inwentaryzacja i backupy',
                'duration' => 'Krok 1',
                'desc' => 'Sprawdzamy kod, dostępy, bazę danych i zależności oraz konfigurujemy sprawdzone kopie zapasowe.',
            ],
            's2' => [
                'name' => 'Kopia testowa i diagnoza',
                'duration' => 'Krok 2',
                'desc' => 'Uruchamiamy izolowaną kopię, odtwarzamy błędy i ustalamy zakres prac oraz wycenę.',
            ],
            's3' => [
                'name' => 'Poprawki, aktualizacje i testy',
                'duration' => 'Krok 3',
                'desc' => 'Usuwamy blokery, aktualizujemy PHP, Laravel lub Symfony, przyspieszamy wolne zapytania i uruchamiamy testy.',
            ],
            's4' => [
                'name' => 'Wdrożenie z planem wycofania',
                'duration' => 'Krok 4',
                'desc' => 'Wdrażamy z przygotowanym planem wycofania, obserwujemy logi i opcjonalnie przechodzimy na stałą opiekę.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Niewielkie zadania realizujemy od 140 PLN/godz. po ocenie zadania i kodu. Aktualizacje oraz stabilizację ustalamy jako osobny etap.',
        'badge' => 'Cennik',
        'title' => 'Formy wsparcia i aktualizacji',
        'subtitle' => 'Jednorazowy etap aktualizacji lub stabilizacji albo regularna opieka miesięczna.',
        'plans' => [
            'mvp' => [
                'name' => 'Aktualizacja lub stabilizacja',
                'badge' => 'Jednorazowy etap',
                'price' => 'od 6 400 PLN',
                'price_sub' => '≈ $1 600 · stały zakres',
                'timeline' => 'Zwykle 1–3 tygodnie',
                'desc' => 'Aktualizacja Laravel, Symfony lub PHP, stabilizacja projektu legacy albo przyspieszenie wolnych stron.',
                'features' => [
                    'Przegląd zależności, wersji PHP i krytycznych błędów',
                    'Weryfikacja backupów i konfiguracja środowiska testowego',
                    'Aktualizacja Laravel lub Symfony i zgodności pakietów',
                    'Naprawa krytycznych błędów i wąskich gardeł w bazie',
                    'Testy automatyczne kluczowych ścieżek użytkownika',
                    'Plan wdrożenia z możliwością szybkiego wycofania',
                    'Dokumentacja uruchomienia i wdrożenia projektu',
                    'Poprawki błędów przez 2 tygodnie po wdrożeniu',
                ],
                'cta' => 'Wyceń aktualizację',
            ],
            'retainer' => [
                'name' => 'Stałe wsparcie PHP / Laravel',
                'badge' => 'Opieka miesięczna',
                'price' => 'od 5 600 PLN',
                'price_sub' => '≈ $1 400 · miesięcznie / od 140 PLN/godz.',
                'timeline' => 'Miesięcznie',
                'desc' => 'Planowa opieka nad działającą aplikacją: poprawki, drobne zmiany, łatki bezpieczeństwa i kontrola kopii zapasowych.',
                'features' => [
                    'Naprawa błędów i bieżące usprawnienia',
                    'Regularne aktualizacje bezpieczeństwa PHP i pakietów',
                    'Kontrola backupów, kolejek i logów błędów',
                    'Monitoring dostępności i czasu odpowiedzi',
                    'Bezpośredni kanał na Telegramie lub Slacku',
                    'Uzgodniony miesięczny pakiet godzin',
                ],
                'cta' => 'Porozmawiajmy o wsparciu',
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
        'bio' => "Pracuję z działającymi aplikacjami PHP w Laravel i Symfony: aktualizuję starsze wersje, porządkuję projekty bez dokumentacji i przyspieszam wolne zapytania do bazy.\n\nZaczynam od faktów z logów, kodu i konfiguracji serwera, a potem proponuję konkretny plan z jawnym podziałem ryzyk.",
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'Laravel, Symfony, PHP 7/8, PostgreSQL, MySQL, Docker',
            'Etapowe aktualizacje z testami i planem wycofania',
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
        'title' => 'Częste pytania o wsparcie i aktualizacje PHP',
        'subtitle' => 'Przejęcie kodu, stare wersje, pilne błędy i rozliczenia.',
        'items' => [
            'q1' => [
                'q' => 'Poprzedni wykonawca zniknął i nie ma dokumentacji. Czy przejmujecie takie projekty?',
                'a' => 'Tak. Zaczynamy od inwentaryzacji tego, co zostało (kod, serwer, baza, dostępy), robimy backup, uruchamiamy kopię testową i krok po kroku odzyskujemy kontrolę.',
            ],
            'q2' => [
                'q' => 'Jak aktualizujecie starszy Laravel (6, 7, 8, 9)?',
                'a' => 'Aktualizujemy etapami na osobnym branchu i serwerze testowym, sprawdzamy zgodność pakietów i dodajemy testy krytycznych ścieżek. Przełączenie na produkcji planujemy w oknie małego ruchu z planem wycofania.',
            ],
            'q3' => [
                'q' => 'Czy realizujecie drobne jednorazowe zadania na kilka godzin?',
                'a' => 'Tak, mniejsze zadania rozliczamy godzinowo od 140 PLN/godz. po krótkim sprawdzeniu kodu i zakresu.',
            ],
            'q4' => [
                'q' => 'Czy pomożecie, jeśli strony działają wolno lub zawieszają się pod obciążeniem?',
                'a' => 'Tak. Profilujemy wolne zapytania SQL, indeksy, problemy N+1, kolejki i cache w Redis oraz zapisujemy mierzalne wyniki przed i po zmianach.',
            ],
            'q5' => [
                'q' => 'Czego potrzebujecie na start?',
                'a' => 'Opisu problemu oraz obecnej wersji PHP i frameworka. Dostęp read-only do repozytorium (z NDA, jeśli trzeba) pozwala przygotować dokładną wycenę.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Stała wycena etapu dla aktualizacji lub stabilizacji albo miesięczny pakiet godzin lub stawka godzinowa na fakturę VAT.',
            ],
            'q7' => [
                'q' => 'Z klientami z jakich krajów pracujecie?',
                'a' => 'Pracujemy zdalnie z firmami z Polski, Ukrainy, UE, Wielkiej Brytanii, USA i Kanady.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Napisz, co wymaga naprawy lub aktualizacji',
        'subtitle' => 'Opisz obecny stan projektu i główny problem. Zaproponujemy bezpieczny plan i wycenę.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'project_name' => 'Imię lub nazwa firmy',
            'project_name_placeholder' => 'Aleksander / Firma sp. z o.o.',
            'contact' => 'Telegram lub e-mail',
            'contact_placeholder' => '@username lub name@company.com',
            'stage' => 'Czego potrzebujesz teraz',
            'not_specified' => 'Nie podano',
            'stage_options' => [
                'idea' => 'Aktualizacja Laravel, Symfony lub PHP',
                'spec' => 'Naprawa błędów, przyspieszenie lub stabilizacja legacy',
                'rewrite' => 'Stała opieka miesięczna',
            ],
            'budget' => 'Preferowany format',
            'budget_options' => [
                'sprint' => 'Od 6 400 PLN (aktualizacja / stabilizacja)',
                'custom' => 'Zadanie doraźne (od 140 PLN/godz.)',
                'retainer' => 'Stałe wsparcie (od 5 600 PLN/mies.)',
            ],
            'description' => 'Opis projektu i problemu',
            'description_placeholder' => 'Jaki stack i wersja, co dokładnie nie działa lub wymaga aktualizacji?',
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
        'tagline' => 'Wsparcie i aktualizacje PHP, Laravel i Symfony',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Stęszew pod Poznaniem, Wielkopolska, Polska.',
    ],
];
