<?php

return [
    'seo' => [
        'title' => 'Programowanie Symfony: moduły, API, płatności i kolejki | DigiSpace',
        'description' => 'Rozwój i utrzymanie aplikacji w Symfony: obsługa zamówień, integracje płatności, API, kolejki Symfony Messenger i aktualizacje wersji. Od 12 800 PLN netto.',
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
        'badge' => 'Programowanie Symfony · PHP i Doctrine',
        'title' => 'Programowanie i rozwój aplikacji w Symfony',
        'subtitle' => 'Pomagamy rozwijać istniejące systemy w Symfony oraz tworzyć nowe moduły: obsługę zamówień, integracje płatności, API i zadania w tle. Zmiany w złożonej logice sprawdzamy najpierw w środowisku testowym.',
        'subtitle_short' => 'Dodajemy moduły, API, integracje płatności i zadania w tle w aplikacjach Symfony. Zakres, budżet i plan wdrożenia ustalamy przed startem.',
        'cta_primary' => 'Otrzymaj wycenę zadania',
        'status' => 'Przyjmujemy nowe projekty',
        'metric_labels' => [
            'price' => 'Budżet',
            'timeline' => 'Termin',
            'ownership' => 'Podejście',
        ],
        'metrics' => [
            'price' => 'Od 12 800 PLN netto',
            'timeline' => 'Zwykle 3–6 tygodni',
            'ownership' => 'PHPUnit, PHPStan i wdrożenie etapowe',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Systemy, które tworzymy i utrzymujemy',
        'subtitle' => 'Komercyjne doświadczenie w Symfony (w tym w sklepach biletowych z dużym ruchem oraz obsługą zamówień i płatności) oraz własne produkty PHP.',
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
                'tagline' => 'Monitoring dostępności stron z powiadomieniami i przetwarzaniem w tle',
                'stack' => ['PHP 8', 'PostgreSQL', 'Redis', 'Go', 'Docker'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Platforma B2B multi-tenant',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Kalendarz miesięczny: liczba wizyt każdego lekarza w poszczególnych dniach (dane demonstracyjne)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Kalendarz wizyt: filtry według oddziałów i lekarzy (dane demonstracyjne)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Panel administracyjny: plany subskrypcji zsynchronizowane ze Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'Dokumentacja API: żądania do obsługi wizyt'],
                ],
                'tagline' => 'Platforma B2B z dokumentacją OpenAPI, kontrolą dostępu i płatnościami Stripe',
                'stack' => ['PHP API', 'PostgreSQL', 'Stripe', 'OpenAPI', 'Nuxt SSR'],
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
        'title' => 'Jakie zadania realizujemy w Symfony',
        'subtitle' => 'Pracujemy z nowymi usługami i działającymi systemami na Symfony 5, 6 i 7.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Logika biznesowa, moduły i Doctrine ORM',
            ],
            'billing' => [
                'title' => 'Obsługa zamówień i integracje płatności',
            ],
            'workers' => [
                'title' => 'Symfony Messenger i kolejki (Redis / RabbitMQ)',
            ],
            'admin' => [
                'title' => 'REST API, OpenAPI i integracje zewnętrzne',
            ],
            'ai' => [
                'title' => 'Etapowe aktualizacje Symfony i PHP',
            ],
            'devops' => [
                'title' => 'PHPUnit, PHPStan i wdrożenie w Dockerze',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Jak pracujemy',
        'title' => 'Na co możesz liczyć',
        'subtitle' => 'Wdrożenia etapowe, analiza statyczna i bezpośrednia współpraca z programistą.',
        'items' => [
            'staging' => [
                'badge' => 'Staging',
                'title' => 'Sprawdzenie na środowisku testowym',
                'desc' => 'Wszystkie zmiany trafiają najpierw na staging, gdzie sprawdzasz scenariusze i wymianę danych przed wdrożeniem produkcyjnym.',
            ],
            'testing' => [
                'badge' => 'Testy',
                'title' => 'Testy automatyczne i analiza statyczna',
                'desc' => 'Dodajemy testy PHPUnit dla głównych ścieżek i uruchamiamy PHPStan, aby ograniczyć ryzyko regresji.',
            ],
            'ownership' => [
                'badge' => 'Współpraca',
                'title' => 'Praca w Twoim repozytorium Git',
                'desc' => 'Pracujemy według standardów Twojego zespołu przez pull requesty z krótkim opisem zmian i dokumentacją.',
            ],
            'direct' => [
                'badge' => 'Bezpośrednio',
                'title' => 'Rozmowa wprost z inżynierem',
                'desc' => 'Architekturę, ograniczenia i priorytety omawiasz bezpośrednio z programistą realizującym zadanie.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Cztery etapy pracy nad projektem Symfony',
        'subtitle' => 'Uporządkowany proces zmniejszający ryzyko zmian w działającej aplikacji.',
        'sprints' => [
            's1' => [
                'name' => 'Analiza kodu i wymagań',
                'duration' => 'Etap 1',
                'desc' => 'Przeglądamy architekturę, schemat Doctrine i zależności, aby ustalić realny plan prac.',
            ],
            's2' => [
                'name' => 'Rozwój modułów i kolejek',
                'duration' => 'Etap 2',
                'desc' => 'Wdrażamy serwisy, kontrolery, handlery Messenger i integracje zgodnie z ustalonym zakresem.',
            ],
            's3' => [
                'name' => 'Testy i przegląd zapytań',
                'duration' => 'Etap 3',
                'desc' => 'Dodajemy testy automatyczne, sprawdzamy zapytania SQL i przypadki brzegowe wymiany danych.',
            ],
            's4' => [
                'name' => 'Wdrożenie i dokumentacja',
                'duration' => 'Etap 4',
                'desc' => 'Wspieramy wydanie na produkcję, sprawdzamy logi i przekazujemy opis zmian.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Pracujesz bezpośrednio z programistą bez pośredników. Dokładny zakres i wycenę ustalamy po przeglądzie kodu i wymagań.',
        'badge' => 'Cennik',
        'title' => 'Formy współpracy w Symfony',
        'subtitle' => 'Osobny moduł w stałym zakresie albo regularny rozwój działającej aplikacji.',
        'plans' => [
            'mvp' => [
                'name' => 'Moduł lub rozwój w Symfony',
                'badge' => 'Stały zakres',
                'price' => 'od 12 800 PLN',
                'price_sub' => '≈ $3 200 · stały zakres',
                'timeline' => 'Zwykle 3–6 tygodni',
                'desc' => 'Dla nowego modułu, integracji płatności lub API albo przebudowy krytycznego elementu aplikacji.',
                'features' => [
                    'Przegląd obecnej architektury i modeli Doctrine',
                    'Rozwój logiki biznesowej, serwisów i REST API',
                    'Obsługa zadań w tle w Symfony Messenger',
                    'Integracje płatności i usług zewnętrznych',
                    'Testy PHPUnit i kontrola PHPStan',
                    'Środowisko testowe do odbioru przed wdrożeniem',
                    'Kod w Twoim repozytorium i opis zmian',
                    'Poprawki błędów przez 2 tygodnie po wdrożeniu',
                ],
                'cta' => 'Otrzymaj wycenę',
            ],
            'retainer' => [
                'name' => 'Stały rozwój Symfony',
                'badge' => 'Dla działającego produktu',
                'price' => 'od 9 500 PLN',
                'price_sub' => '≈ $2 400 · miesięcznie / od 140 PLN/godz.',
                'timeline' => 'Miesięcznie',
                'desc' => 'Regularny rozwój systemu, stopniowe aktualizacje Symfony i PHP, przyspieszanie zapytań i wsparcie zespołu.',
                'features' => [
                    'Uzgodniona liczba godzin tygodniowo',
                    'Nowe funkcje i usuwanie przyczyn błędów',
                    'Przyspieszanie zapytań Doctrine i strojenie kolejek',
                    'Stopniowe aktualizacje wersji Symfony i PHP',
                    'Bezpośredni kanał na Telegramie lub Slacku',
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
        'bio' => "Pracuję z komercyjnymi systemami PHP w Symfony i Laravel, w tym ze sklepami biletowymi, obsługą zamówień, bramkami płatności i kolejkami w tle.\n\nZaczynam od przeczytania istniejącego kodu, zależności i ograniczeń, a potem proponuję jasny plan zmian pod kontrolą.",
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'Symfony, Doctrine, Messenger, PostgreSQL, Docker',
            'Doświadczenie z zamówieniami, płatnościami i kolejkami',
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
        'title' => 'Częste pytania o programowanie Symfony',
        'subtitle' => 'Wersje, praca z zespołem, testy i rozliczenia.',
        'items' => [
            'q1' => [
                'q' => 'Z jakimi wersjami Symfony pracujecie?',
                'a' => 'Pracujemy z Symfony 5, 6 i 7, a także planujemy etapowe aktualizacje starszych wersji z weryfikacją bundli i zgodności z PHP 8.x.',
            ],
            'q2' => [
                'q' => 'Czy możecie dołączyć do naszego zespołu?',
                'a' => 'Tak. Możemy przejąć osobny moduł albo pracować w ramach Waszego workflow w GitHub/GitLab i Jira/Linear.',
            ],
            'q3' => [
                'q' => 'Czy pracujecie z Symfony Messenger i API?',
                'a' => 'Tak, budujemy REST API z dokumentacją OpenAPI oraz przetwarzanie asynchroniczne przez Messenger z Redis lub RabbitMQ.',
            ],
            'q4' => [
                'q' => 'Czego potrzebujecie do wyceny?',
                'a' => 'Krótkiego opisu zadania oraz wersji Symfony i PHP. W istniejących systemach krótki przegląd repozytorium pozwala wcześnie zauważyć ograniczenia.',
            ],
            'q5' => [
                'q' => 'Jak ograniczacie ryzyko błędów na produkcji?',
                'a' => 'Piszemy testy jednostkowe i integracyjne PHPUnit, uruchamiamy PHPStan i testujemy scenariusze na stagingu przed wydaniem.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Płatności etapowe przy stałym zakresie albo rozliczenie miesięczne lub godzinowe na fakturę VAT. Możliwe także escrow.',
            ],
            'q7' => [
                'q' => 'Czy pracujecie z firmami spoza Polski?',
                'a' => 'Tak. Pracujemy zdalnie z klientami z Polski, Ukrainy, UE, Wielkiej Brytanii, USA i Kanady.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Opowiedz o swoim projekcie w Symfony',
        'subtitle' => 'Opisz moduł, integrację lub problem. Doprecyzujemy szczegóły i przygotujemy wstępną wycenę.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'project_name' => 'Imię lub nazwa firmy',
            'project_name_placeholder' => 'Aleksander / Tech sp. z o.o.',
            'contact' => 'Telegram lub e-mail',
            'contact_placeholder' => '@username lub name@company.com',
            'stage' => 'Etap projektu',
            'not_specified' => 'Nie podano',
            'stage_options' => [
                'idea' => 'Nowy serwis lub moduł',
                'spec' => 'Mam specyfikację techniczną lub wymagania',
                'rewrite' => 'Istniejący system Symfony do rozwoju lub aktualizacji',
            ],
            'budget' => 'Orientacyjny budżet',
            'budget_options' => [
                'sprint' => '12 800 – 26 000 PLN (moduł / integracja)',
                'custom' => '26 000+ PLN (większy zakres prac)',
                'retainer' => 'Współpraca miesięczna / godzinowa',
            ],
            'description' => 'Krótki opis zadania',
            'description_placeholder' => 'Jaka to wersja Symfony i co dokładnie trzeba wdrożyć?',
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
