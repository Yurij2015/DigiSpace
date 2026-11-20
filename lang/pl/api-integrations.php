<?php

return [
    'seo' => [
        'title' => 'Tworzenie API, integracje płatności i AI | DigiSpace',
        'description' => 'Tworzenie REST API z dokumentacją OpenAPI, podłączenie Stripe i bramek płatności, synchronizacja CRM oraz wyszukiwanie AI/RAG na Twoich danych. Od 7 200 PLN netto.',
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
        'badge' => 'API · Płatności · Integracje AI',
        'title' => 'Tworzenie API oraz integracje płatności, CRM i AI',
        'subtitle' => 'Projektujemy i tworzymy API dla aplikacji webowych, mobilnych i partnerów. Podłączamy płatności i subskrypcje (Stripe oraz inne bramki REST), synchronizujemy CRM i dodajemy wyszukiwanie AI w Twoich dokumentach.',
        'subtitle_short' => 'Budujemy REST API, podłączamy Stripe, synchronizację CRM oraz AI/RAG, z dokumentacją OpenAPI, obsługą webhooków i testami.',
        'cta_primary' => 'Otrzymaj wycenę integracji',
        'status' => 'Przyjmujemy nowe projekty',
        'metric_labels' => [
            'price' => 'Budżet',
            'timeline' => 'Termin',
            'ownership' => 'Niezawodność',
        ],
        'metrics' => [
            'price' => 'Od 7 200 PLN netto',
            'timeline' => 'Zwykle 1–4 tygodnie',
            'ownership' => 'Dokumentacja OpenAPI i testy',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'API, płatności i integracje AI w działających produktach',
        'subtitle' => 'Przykłady z naszych własnych systemów: dokumentacja OpenAPI, billing Stripe, webhooki i wyszukiwanie RAG.',
        'view_live' => 'Otwórz produkt',
        'gallery_hint' => 'Zrzuty ekranu z działających produktów',
        'gallery_open' => 'Otwórz zrzut ekranu',
        'gallery_close' => 'Zamknij',
        'gallery_prev' => 'Poprzedni zrzut ekranu',
        'gallery_next' => 'Następny zrzut ekranu',
        'gallery_count' => 'Zrzuty ekranu: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'API + workery + alerty',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Przegląd stron: dostępność, czas odpowiedzi i certyfikaty SSL (nazwy stron rozmyte)'],
                    ['file' => 'digipulse-history', 'caption' => 'Historia strony: czas odpowiedzi i incydenty z ostatniego tygodnia'],
                ],
                'tagline' => 'Integracja backendu Laravel z workerami Go, serwerem MCP i powiadomieniami Telegram/e-mail',
                'stack' => ['REST API', 'MCP', 'Webhooks', 'Go', 'Redis'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'OpenAPI + Stripe Cashier',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'Dokumentacja API (Swagger/OpenAPI): żądania do obsługi wizyt'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Panel administracyjny w Filament: plany subskrypcji zsynchronizowane ze Stripe'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Kalendarz wizyt: filtry według oddziałów i lekarzy (dane demonstracyjne)'],
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Kalendarz miesięczny: liczba wizyt każdego lekarza w poszczególnych dniach (dane demonstracyjne)'],
                ],
                'tagline' => 'Wspólne REST API dla katalogu publicznego, panelu klinik i synchronizacji subskrypcji Stripe',
                'stack' => ['OpenAPI / Swagger', 'Stripe Webhooks', 'Laravel API', 'PostgreSQL'],
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
        'title' => 'Jakie API i integracje budujemy',
        'subtitle' => 'Projektujemy obsługę błędów, ponawianie prób i ochronę przed duplikatami, aby wymiana danych była przewidywalna.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'REST API dla webu, aplikacji mobilnych i partnerów',
            ],
            'billing' => [
                'title' => 'Płatności i subskrypcje (Stripe i inne bramki REST)',
            ],
            'workers' => [
                'title' => 'Webhooki, kolejki, ponawianie prób i idempotentność',
            ],
            'admin' => [
                'title' => 'Synchronizacja CRM / ERP (Zoho i zewnętrzne REST API)',
            ],
            'ai' => [
                'title' => 'Integracje AI i wyszukiwanie RAG w Twoich dokumentach',
            ],
            'devops' => [
                'title' => 'Dokumentacja OpenAPI / Swagger i testy automatyczne',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Jak pracujemy',
        'title' => 'Przewidywalna wymiana danych między systemami',
        'subtitle' => 'Testujemy ścieżki błędów, logujemy awarie i przekazujemy czytelną dokumentację.',
        'items' => [
            'staging' => [
                'badge' => 'Sandbox',
                'title' => 'Testy na kluczach sandbox przed startem',
                'desc' => 'Sprawdzamy poprawne odpowiedzi, odmowy, timeouty i powtórzone webhooki w sandboxie przed przełączeniem na produkcję.',
            ],
            'testing' => [
                'badge' => 'Testy',
                'title' => 'Automatyczne testy endpointów i webhooków',
                'desc' => 'Pokrywamy endpointy, autoryzację i obsługę webhooków testami, aby aktualizacje nie psuły integracji.',
            ],
            'ownership' => [
                'badge' => 'Dokumentacja',
                'title' => 'OpenAPI / Swagger i przykłady żądań',
                'desc' => 'Przekazujemy aktualną specyfikację API, aby zespół frontendowy, mobilny lub partnerzy mogli się podpiąć bez zgadywania.',
            ],
            'direct' => [
                'badge' => 'Bezpośrednio',
                'title' => 'Bezpośredni kontakt z programistą',
                'desc' => 'Formaty danych, uprawnienia i przypadki brzegowe ustalasz bezpośrednio z inżynierem.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Cztery etapy wdrożenia API lub integracji',
        'subtitle' => 'Od kontraktu API do zweryfikowanego ruchu produkcyjnego. Czas zależy od liczby usług i ograniczeń zewnętrznego API.',
        'sprints' => [
            's1' => [
                'name' => 'Kontrakt i scenariusze błędów',
                'duration' => 'Etap 1',
                'desc' => 'Ustalamy endpointy, autoryzację, strukturę danych, limity i zachowanie przy awarii.',
            ],
            's2' => [
                'name' => 'Implementacja i webhooki',
                'duration' => 'Etap 2',
                'desc' => 'Budujemy API lub integrację, weryfikację podpisów webhooków, kolejki i zabezpieczenia przed duplikatami.',
            ],
            's3' => [
                'name' => 'Testy w sandboxie i dokumentacja',
                'duration' => 'Etap 3',
                'desc' => 'Piszemy testy automatyczne, sprawdzamy przypadki brzegowe i finalizujemy dokumentację OpenAPI.',
            ],
            's4' => [
                'name' => 'Uruchomienie i przegląd logów',
                'duration' => 'Etap 4',
                'desc' => 'Przełączamy klucze na produkcję, konfigurujemy logowanie błędów i sprawdzamy pierwsze rzeczywiste żądania.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Błędy w integracjach najczęściej kończą się podwójnymi płatnościami lub zgubionymi zgłoszeniami. Dobra obsługa webhooków i kolejek zamyka te ryzyka na początku.',
        'badge' => 'Cennik',
        'title' => 'Formy współpracy przy API i integracjach',
        'subtitle' => 'Osobna integracja w stałym zakresie albo regularny rozwój i utrzymanie API.',
        'plans' => [
            'mvp' => [
                'name' => 'API lub integracja pod klucz',
                'badge' => 'Stały zakres',
                'price' => 'od 7 200 PLN',
                'price_sub' => '≈ $1 800 · stały zakres',
                'timeline' => 'Zwykle 1–4 tygodnie',
                'desc' => 'Budowa REST API, podłączenie Stripe lub innej bramki płatności, synchronizacji CRM albo modułu AI/RAG.',
                'features' => [
                    'Projekt kontraktu API i autoryzacji (OAuth, Sanctum, JWT)',
                    'Endpointy, obsługa webhooków i kolejki w tle',
                    'Ochrona przed duplikatami (idempotentność) i retry',
                    'Logowanie błędów przy awarii serwisu zewnętrznego',
                    'Dokumentacja OpenAPI / Swagger',
                    'Testy automatyczne scenariuszy poprawnych i błędnych',
                    'Sprawdzenie w sandboxie i przełączenie na produkcję',
                    'Poprawki błędów przez 2 tygodnie po uruchomieniu',
                ],
                'cta' => 'Wyceń integrację',
            ],
            'retainer' => [
                'name' => 'Rozwój API i integracji',
                'badge' => 'Dla działającego produktu',
                'price' => 'od 6 400 PLN',
                'price_sub' => '≈ $1 600 · miesięcznie / od 140 PLN/godz.',
                'timeline' => 'Miesięcznie',
                'desc' => 'Stopniowe rozszerzanie API, nowi partnerzy, aktualizacje wersji SDK i utrzymanie kolejek.',
                'features' => [
                    'Nowe endpointy i integracje partnerskie',
                    'Aktualizacje wersji zewnętrznych API',
                    'Cache odpowiedzi i przyspieszanie zapytań',
                    'Przegląd błędów webhooków i kolejek',
                    'Bezpośredni kontakt na Telegramie lub Slacku',
                    'Uzgodniona liczba godzin tygodniowo',
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
        'bio' => "Projektuję backend, REST API i integracje zewnętrzne: subskrypcje Stripe, konektory Zoho CRM, wymianę danych między serwisami oraz narzędzia RAG na Qdrant i Langfuse.\n\nObsługę błędów i ponawianie prób wpisuję w architekturę od początku, aby chwilowe awarie dostawców nie zatrzymywały procesów biznesowych.",
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'REST / OpenAPI, Stripe, Webhooks, Zoho CRM, AI/RAG',
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
        'title' => 'Częste pytania o API i integracje',
        'subtitle' => 'Płatności, obsługa błędów, dokumentacja i terminy.',
        'items' => [
            'q1' => [
                'q' => 'Jakie bramki płatności integrujecie?',
                'a' => 'Regularnie integrujemy Stripe (płatności jednorazowe, subskrypcje, portal klienta, webhooki) oraz inne bramki płatności z jawną dokumentacją REST API i środowiskiem testowym.',
            ],
            'q2' => [
                'q' => 'Czy wykonujecie integracje AI i wyszukiwanie RAG?',
                'a' => 'Tak. Wdrażamy wyszukiwanie po Twoich dokumentach i bazie wiedzy (RAG), ustrukturyzowane odpowiedzi oraz integracje API modeli językowych z kontrolą kosztów i logowaniem.',
            ],
            'q3' => [
                'q' => 'Co się dzieje, gdy zewnętrzny serwis chwilowo nie odpowiada?',
                'a' => 'Krytyczne wywołania i webhooki obsługujemy przez kolejki z ponawianiem prób, weryfikacją podpisu i idempotentnością. Ogranicza to ryzyko utraty zgłoszeń lub duplikacji płatności.',
            ],
            'q4' => [
                'q' => 'Czy dostarczacie dokumentację dla zespołu frontendowego lub mobilnego?',
                'a' => 'Tak, przygotowujemy specyfikację OpenAPI / Swagger z przykładami żądań, odpowiedzi i kodów błędów.',
            ],
            'q5' => [
                'q' => 'W jakich technologiach budujecie API?',
                'a' => 'Głównie PHP (Laravel, Symfony) oraz Go, z bazami PostgreSQL lub MySQL i Redisem dla kolejek oraz cache.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Przy stałym zakresie rozliczenie dzielimy na zaliczkę i płatność końcową po testach w sandboxie i uruchomieniu. Współpracę ciągłą rozliczamy miesięcznie lub godzinowo.',
            ],
            'q7' => [
                'q' => 'Z klientami z jakich krajów pracujecie?',
                'a' => 'Pracujemy zdalnie z firmami z Polski, Ukrainy, UE, Wielkiej Brytanii, USA i Kanady.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Opisz potrzebne API lub integrację',
        'subtitle' => 'Napisz, jakie systemy trzeba połączyć albo jakie API stworzyć. Przygotujemy wstępną wycenę i termin.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'project_name' => 'Imię lub nazwa firmy',
            'project_name_placeholder' => 'Aleksander / Firma sp. z o.o.',
            'contact' => 'Telegram lub e-mail',
            'contact_placeholder' => '@username lub name@company.com',
            'stage' => 'Rodzaj zadania',
            'not_specified' => 'Nie podano',
            'stage_options' => [
                'idea' => 'Nowe API (dla webu / aplikacji mobilnej)',
                'spec' => 'Integracja płatności, CRM/ERP lub zewnętrznego serwisu',
                'rewrite' => 'Integracja AI lub rozbudowa istniejącego API',
            ],
            'budget' => 'Orientacyjny budżet',
            'budget_options' => [
                'sprint' => '7 200 – 16 000 PLN (integracja / bazowe API)',
                'custom' => '16 000+ PLN (złożone API lub kilka integracji)',
                'retainer' => 'Miesięczne wsparcie / godzinowo',
            ],
            'description' => 'Krótki opis integracji',
            'description_placeholder' => 'Jakie systemy trzeba połączyć i jakie dane mają być przesyłane?',
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
        'tagline' => 'Tworzenie API, płatności i integracji AI',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Stęszew pod Poznaniem, Wielkopolska, Polska.',
    ],
];
