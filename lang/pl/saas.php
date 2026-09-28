<?php

return [
    'seo' => [
        'title' => 'Tworzenie SaaS MVP w Poznaniu | DigiSpace',
        'description' => 'Tworzymy SaaS MVP, aby pomóc Ci sprawdzić pomysł i uruchomić produkt. Od 19 000 PLN netto, zwykle 6–8 tygodni. Współpracujemy z klientami z Polski i UE.',
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
        'badge' => 'Tworzenie SaaS · Poznań',
        'title' => 'SaaS MVP od pomysłu do uruchomienia',
        'subtitle' => 'Tworzymy pierwszą wersję Twojego SaaS, aby przetestować pomysł z prawdziwymi użytkownikami. Wspólnie wybieramy funkcje, ustalamy budżet i termin oraz przygotowujemy produkt do uruchomienia.',
        'subtitle_short' => 'Tworzymy pierwszą wersję SaaS, z którą sprawdzisz swój pomysł z prawdziwymi użytkownikami. Funkcje, budżet i termin ustalamy przed rozpoczęciem prac.',
        'cta_primary' => 'Poznaj koszt i termin realizacji',
        'status' => 'Przyjmujemy nowe projekty',
        'metric_labels' => [
            'price' => 'Budżet',
            'timeline' => 'Termin',
            'ownership' => 'Przejrzystość',
        ],
        'metrics' => [
            'price' => 'MVP od 19 000 PLN netto',
            'timeline' => 'Zwykle 6–8 tygodni',
            'ownership' => 'Widzisz postępy na każdym etapie',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Produkty, które sami stworzyliśmy i utrzymujemy',
        'subtitle' => 'Zobacz nasze produkty, ich funkcje i technologie, z których korzystamy.',
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
                'tagline' => 'Monitoring dostępności stron z powiadomieniami o incydentach',
                'stack' => ['Laravel Octane', 'Go', 'Redis', 'Filament', 'PostgreSQL', 'MCP'],
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
                'tagline' => 'Platforma dla klinik weterynaryjnych i właścicieli zwierząt',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Multi-tenancy', 'Stripe Cashier', 'Tailwind CSS', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
            ],
            'netpostpanel' => [
                'badge' => 'AI do tworzenia treści',
                'name' => 'NetPostPanel',
                'screens' => [
                    ['file' => 'netpostpanel-workbench', 'caption' => 'Przestrzeń robocza: rodzaj treści, instrukcje dla AI i wyszukiwanie źródeł'],
                    ['file' => 'netpostpanel-autopilot', 'caption' => 'Przygotowywanie szkiców według harmonogramu na podstawie wybranych tematów i źródeł'],
                ],
                'tagline' => 'Wyszukiwanie źródeł i przygotowywanie szkiców artykułów oraz postów z pomocą AI',
                'stack' => ['Laravel', 'RAG', 'Qdrant', 'Langfuse', 'Horizon', 'LLM API'],
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                // Not a public product: link the descriptive repository, as the portfolio does.
                'link_label' => 'Opis projektu na GitHubie',
            ],
        ],
    ],

    'engine' => [
        'title' => 'Co możemy zbudować w Twoim SaaS',
        'subtitle' => 'Na początku ustalamy, co jest potrzebne w pierwszej wersji, a co można dodać później.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Izolacja danych firm',
            ],
            'billing' => [
                'title' => 'Subskrypcje Stripe',
            ],
            'workers' => [
                'title' => 'Przetwarzanie zadań w tle',
            ],
            'admin' => [
                'title' => 'Panel administracyjny (Filament)',
            ],
            'ai' => [
                'title' => 'Funkcje AI i wyszukiwanie w Twoich danych',
            ],
            'devops' => [
                'title' => 'Wdrożenie w Dockerze',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Jak pracujemy',
        'title' => 'Na co możesz liczyć',
        'subtitle' => 'Dostęp do efektów pracy, testowanie funkcji i bezpośredni kontakt.',
        'items' => [
            'staging' => [
                'badge' => 'Wersja testowa',
                'title' => 'Sprawdzaj produkt przed uruchomieniem',
                'desc' => 'Na czas prac udostępniamy środowisko testowe. Sprawdzaj gotowe funkcje i zgłaszaj, co wymaga dopracowania.',
            ],
            'testing' => [
                'badge' => 'Testy',
                'title' => 'Testy automatyczne',
                'desc' => 'Testy automatyczne sprawdzają logikę biznesową i kluczowe działania użytkownika: rejestrację, logowanie i płatność. Pomagają wykrywać błędy przed udostępnieniem aktualizacji.',
            ],
            'ownership' => [
                'badge' => 'Współpraca',
                'title' => 'Dostęp do kodu w trakcie prac',
                'desc' => 'Pracujemy w Twoim repozytorium GitHub albo udostępniamy nasze na czas prac. Sposób współpracy ustalamy na początku projektu.',
            ],
            'direct' => [
                'badge' => 'Bezpośrednio',
                'title' => 'Rozmawiasz z programistą',
                'desc' => 'Wymagania i rozwiązania techniczne omawiasz bezpośrednio z programistą, który tworzy Twój produkt.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Cztery etapy do startu',
        'subtitle' => 'Poniżej przedstawiamy przykładowy plan na osiem tygodni. Czas poszczególnych etapów zależy od uzgodnionego zakresu prac.',
        'sprints' => [
            's1' => [
                'name' => 'Architektura i baza danych',
                'duration' => 'Tygodnie 1–2',
                'desc' => 'Projektujemy strukturę aplikacji i bazę danych.',
            ],
            's2' => [
                'name' => 'Główne funkcje i płatności',
                'duration' => 'Tygodnie 3–4',
                'desc' => 'Tworzymy główne funkcje i integrujemy płatności, jeśli są potrzebne.',
            ],
            's3' => [
                'name' => 'Panel użytkownika i panel administracyjny',
                'duration' => 'Tygodnie 5–6',
                'desc' => 'Tworzymy panel użytkownika i narzędzia do zarządzania produktem.',
            ],
            's4' => [
                'name' => 'Testy i uruchomienie',
                'duration' => 'Tygodnie 7–8',
                'desc' => 'Sprawdzamy działanie produktu i bezpieczeństwo, a następnie wdrażamy go na uzgodnionym hostingu.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Software house z rozbudowanym zespołem sprawdza się przy dużych projektach. Przy MVP pracujesz bezpośrednio z doświadczonym programistą — bez narzutu agencyjnego.',
        'badge' => 'Cennik',
        'title' => 'Dwie formy współpracy',
        'subtitle' => 'Pierwsza wersja produktu za uzgodnioną cenę albo miesięczne wsparcie i rozwój działającego produktu.',
        'plans' => [
            'mvp' => [
                'name' => 'SaaS MVP',
                'badge' => 'Dla nowego produktu',
                'price' => 'od 19 000 PLN',
                'price_sub' => '≈ $4 800 · stały zakres',
                'timeline' => 'Zwykle 6–8 tygodni',
                'desc' => 'Dla osób, które chcą uruchomić pierwszą wersję i sprawdzić popyt. Listę funkcji i ostateczną cenę ustalamy przed rozpoczęciem prac.',
                'features' => [
                    'Projekt bazy danych i kontrola dostępu do danych',
                    'Integracja subskrypcji i płatności Stripe',
                    'Panel użytkownika i panel administracyjny w Filament',
                    'Dostęp do środowiska testowego w trakcie prac',
                    'Automatyczne testy głównych funkcji i działań użytkownika',
                    'Wdrożenie na uzgodnionym hostingu',
                    'Dostęp do kodu i dokumentacja projektu',
                    'Poprawki błędów przez 2 tygodnie po uruchomieniu',
                ],
                'cta' => 'Porozmawiajmy o MVP',
            ],
            'retainer' => [
                'name' => 'Wsparcie i rozwój SaaS',
                'badge' => 'Dla działającego produktu',
                'price' => 'od 9 500 PLN',
                'price_sub' => '≈ $2 400 · miesięcznie',
                'timeline' => 'Miesięcznie',
                'desc' => 'Dla produktu, z którego korzystają już użytkownicy: nowe funkcje, integracje, poprawki błędów i zwiększanie wydajności.',
                'features' => [
                    'Przegląd architektury, zapytań do bazy danych i bezpieczeństwa',
                    'Rozwój backendu i integracje',
                    'Testy pod obciążeniem',
                    'Przegląd kodu oraz automatyzacja testów i wdrożeń',
                    'Bezpośredni kanał na Telegramie',
                    'Uzgodniona liczba godzin pracy tygodniowo',
                ],
                'cta' => 'Porozmawiajmy o współpracy',
            ],
        ],
    ],

    'social_proof' => [
        'badge' => 'Opinie klientów',
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
        'role' => 'Założyciel DigiSpace · Senior full-stack developer',
        'bio' => 'Jestem Yurii, założyciel DigiSpace. Projektuję i tworzę aplikacje webowe: od baz danych i płatności po uruchomienie i wsparcie. Tworzę i rozwijam też własne produkty: DigiPulse, VetSpace i NetPostPanel.',
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'Laravel, Symfony, Filament, Vue/Nuxt, Go',
            'Własne produkty: DigiPulse, VetSpace, NetPostPanel',
            'Stęszew pod Poznaniem, Polska',
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
        'title' => 'Częste pytania',
        'subtitle' => 'Terminy, płatności, hosting i forma współpracy.',
        'items' => [
            'q1' => [
                'q' => 'Od czego zależy czas realizacji?',
                'a' => 'Od złożoności funkcji, integracji i tego, jak dokładnie określone są wymagania. Do pierwszej wersji wybieramy funkcje potrzebne do sprawdzenia pomysłu. Orientacyjny czas to 6–8 tygodni; harmonogram ustalamy po omówieniu zakresu prac.',
            ],
            'q2' => [
                'q' => 'Jak wygląda dostęp do kodu?',
                'a' => 'Pracujemy w Twoim repozytorium GitHub albo udostępniamy nasze na czas prac. Warunki przekazania kodu i hosting gotowego produktu ustalamy przed rozpoczęciem projektu.',
            ],
            'q3' => [
                'q' => 'Gdzie będzie działać aplikacja i ile kosztuje hosting?',
                'a' => 'Na czas prac udostępniamy środowisko testowe. Hosting gotowego produktu i sposób jego opłacania ustalamy osobno. Koszt zależy od obciążenia i potrzebnych usług.',
            ],
            'q4' => [
                'q' => 'Czego potrzebujecie ode mnie na start?',
                'a' => 'Krótkiego opisu problemu, który rozwiązuje produkt, jego odbiorców i planowanego sposobu zarabiania. Wypełnij formularz albo napisz na Telegramie. Podczas pierwszej rozmowy omówimy pomysł, doprecyzujemy wymagania i ustalimy kolejne kroki.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Płatność dzielimy na cztery części po 25%, płatne na początku każdego etapu. Przed opłaceniem kolejnego sprawdzasz wyniki poprzedniego w środowisku testowym. Możliwa jest też płatność przez serwis escrow.',
            ],
            'q7' => [
                'q' => 'Czy pracujecie z firmami z Poznania i okolic?',
                'a' => 'Tak. Działamy ze Stęszewa pod Poznaniem. Z klientami z Poznania i okolic możemy umówić się na spotkanie osobiste. Z klientami z innych miast i krajów pracujemy zdalnie.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Opowiedz nam o swoim produkcie',
        'subtitle' => 'Opisz pomysł lub zadanie. Doprecyzujemy wymagania i przygotujemy wstępną wycenę oraz termin realizacji.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'project_name' => 'Imię lub nazwa firmy',
            'project_name_placeholder' => 'Aleksander / Startup sp. z o.o.',
            'contact' => 'Telegram lub e-mail',
            'contact_placeholder' => '@username lub name@company.com',
            'stage' => 'Etap projektu',
            'not_specified' => 'Nie podano',
            'stage_options' => [
                'idea' => 'Pomysł',
                'spec' => 'Mam specyfikację lub makiety',
                'rewrite' => 'Działający produkt do rozbudowy lub skalowania',
            ],
            'budget' => 'Budżet',
            'budget_options' => [
                'sprint' => '19 000 – 34 000 PLN (MVP)',
                'custom' => '34 000+ PLN (większy zakres prac)',
                'retainer' => 'Współpraca miesięczna',
            ],
            'description' => 'Krótki opis produktu',
            'description_placeholder' => 'Co będzie robić produkt i dla kogo jest?',
            'submit' => 'Otrzymaj wycenę',
            'response_time' => 'Odpowiadamy w ciągu jednego dnia roboczego.',
            'errors_title' => 'Sprawdź formularz:',
            'validation' => [
                'required' => 'Uzupełnij pole „:attribute”.',
                'max' => 'Pole „:attribute” jest za długie (maks. :max znaków).',
                'invalid' => 'Wybierz wartość z listy w polu „:attribute”.',
            ],
            'recaptcha_failed' => 'Weryfikacja reCAPTCHA nie powiodła się. Spróbuj ponownie albo napisz do nas na Telegramie.',
            'recaptcha_notice' => 'Formularz jest chroniony przez Google reCAPTCHA:',
            'recaptcha_privacy' => 'Polityka prywatności',
            'recaptcha_terms' => 'Warunki korzystania',
            'privacy_notice' => 'Administratorem danych jest Yurii Mokryi JDG (DigiSpace). Dane z formularza wykorzystujemy wyłącznie do odpowiedzi na Twoje zapytanie.',
            'success_title' => 'Dziękujemy!',
            'success_message' => 'Otrzymaliśmy Twoją wiadomość. W ciągu jednego dnia roboczego prześlemy dodatkowe pytania lub wstępną wycenę.',
        ],
    ],

    'footer' => [
        'legal' => 'Yurii Mokryi JDG · NIP 7773404080 · REGON 524949632',
        'privacy_policy' => 'Polityka prywatności',
        'tagline' => 'Tworzenie SaaS i aplikacji webowych',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Stęszew pod Poznaniem, Wielkopolska, Polska.',
    ],
];
