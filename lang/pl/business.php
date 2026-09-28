<?php

// Copy of the business landing (/{locale}/development/business): the same offer, prices and process as
// saas.php, told in the words of a business owner rather than a technical founder. Same key structure.
return [
    'seo' => [
        'title' => 'Systemy dla firm na zamówienie w Poznaniu | DigiSpace',
        'description' => 'Rezerwacje online, CRM, panel klienta i systemy wewnętrzne dopasowane do tego, jak działa Twoja firma; pierwsza wersja zwykle w 6–8 tygodni. Uzgodniony zakres i stała cena. Współpracujemy z firmami z Poznania, całej Polski i UE.',
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
        'badge' => 'Systemy dla firm · Poznań',
        'title' => 'System szyty na miarę Twojej firmy',
        'subtitle' => 'Rezerwacje online, panel klienta, CRM albo system wewnętrzny zamiast arkuszy i ręcznej pracy. Pierwsza wersja zwykle powstaje w 6–8 tygodni, a rozmawiasz bezpośrednio z programistą, który ją tworzy. Termin zależy od uzgodnionego zakresu prac.',
        'subtitle_short' => 'Rezerwacje online, panel klienta, CRM albo system wewnętrzny zamiast arkuszy i ręcznej pracy. Pierwsza wersja zwykle w 6–8 tygodni. Termin zależy od uzgodnionego zakresu prac.',
        'cta_primary' => 'Poznaj koszt i termin realizacji',
        'status' => 'Przyjmujemy nowe projekty',
        'metric_labels' => [
            'price' => 'Budżet',
            'timeline' => 'Termin',
            'ownership' => 'Przejrzystość',
        ],
        'metrics' => [
            'price' => 'Od 19 000 PLN netto',
            'timeline' => 'Zwykle 6–8 tygodni',
            'ownership' => 'Widzisz postępy na każdym etapie',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Systemy, które sami stworzyliśmy i codziennie utrzymujemy',
        'subtitle' => 'To działające produkty, a nie makiety. Zobacz zrzuty ekranu albo otwórz sam produkt.',
        'view_live' => 'Otwórz produkt',
        'gallery_hint' => 'Zrzuty ekranu z działających produktów',
        'gallery_open' => 'Otwórz zrzut ekranu',
        'gallery_close' => 'Zamknij',
        'gallery_prev' => 'Poprzedni zrzut ekranu',
        'gallery_next' => 'Następny zrzut ekranu',
        'gallery_count' => 'Zrzuty ekranu: :count',
        'projects' => [
            'digipulse' => [
                'badge' => 'Własny produkt',
                'name' => 'DigiPulse',
                'screens' => [
                    ['file' => 'digipulse-dashboard', 'caption' => 'Przegląd: które strony działają, które zwalniają lub nie odpowiadają i kiedy wygasają certyfikaty (nazwy stron rozmyte)'],
                    ['file' => 'digipulse-history', 'caption' => 'Historia jednej strony: czas odpowiedzi z tygodnia i każda awaria'],
                ],
                'tagline' => 'Daje znać, gdy tylko Twoja strona przestaje działać',
                'stack' => ['Powiadomienia na Telegram i e-mail', 'Raporty dostępności', 'Sprawdzanie co minutę'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Rezerwacje i obsługa klientów',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Widok miesiąca: ile wizyt ma każdy lekarz każdego dnia (dane demonstracyjne)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Kalendarz kliniki: wizyty każdego lekarza i gabinetu, nowe zgłoszenia po prawej (dane demonstracyjne)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Panel administracyjny: plany i płatności klinik korzystających z platformy'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'Udokumentowane punkty połączenia, przez które inne systemy wymieniają wizyty'],
                ],
                'tagline' => 'Rezerwacje online, kalendarz, karty klientów i strona dla każdej kliniki',
                'stack' => ['Rezerwacje online', 'Kalendarz i CRM', 'Strona kliniki'],
                'live_url' => 'https://vetspace.pro',
            ],
            'netpostpanel' => [
                'badge' => 'Asystent AI',
                'name' => 'NetPostPanel',
                'screens' => [
                    ['file' => 'netpostpanel-workbench', 'caption' => 'Przestrzeń robocza: rodzaj tekstu, zadanie i źródła w jednym miejscu'],
                    ['file' => 'netpostpanel-autopilot', 'caption' => 'Autopilot: nowe szkice codziennie według harmonogramu, z Twoich tematów i źródeł'],
                ],
                'tagline' => 'Przygotowuje artykuły i posty na podstawie sprawdzonych źródeł',
                'stack' => ['AI na Twoich danych', 'Wyszukiwanie źródeł', 'Uruchamianie według harmonogramu'],
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                // Not a public product: link the descriptive repository, as the portfolio does.
                'link_label' => 'Opis projektu na GitHubie',
            ],
        ],
    ],

    'engine' => [
        'title' => 'Co możemy dla Ciebie zbudować',
        'subtitle' => 'Na starcie ustalamy, czego naprawdę potrzebuje Twoja firma. Nie budujemy tego, z czego nie skorzystasz.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Rezerwacje online i kalendarz',
            ],
            'billing' => [
                'title' => 'Płatności online i abonamenty',
            ],
            'workers' => [
                'title' => 'Karty klientów i CRM',
            ],
            'admin' => [
                'title' => 'Panel administracyjny dla zespołu',
            ],
            'ai' => [
                'title' => 'Asystenci AI na Twoich danych',
            ],
            'devops' => [
                'title' => 'Integracje z Twoimi narzędziami',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Jak pracujemy',
        'title' => 'Na co możesz liczyć',
        'subtitle' => 'Cztery zasady, których trzymamy się w każdym projekcie, i plan startu.',
        'items' => [
            'staging' => [
                'badge' => 'Pierwszy tydzień',
                'title' => 'Postęp widać od pierwszego tygodnia',
                'desc' => 'W pierwszym tygodniu dostajesz zamkniętą wersję testową swojego systemu. Każda gotowa zmiana pojawia się tam automatycznie, więc sprawdzasz sam system, a nie czytasz raporty.',
            ],
            'testing' => [
                'badge' => 'Jakość',
                'title' => 'Sprawdzone przed każdą aktualizacją',
                'desc' => 'Automatyczne testy przechodzą kluczowe scenariusze — rezerwację, rejestrację, płatność — tak jak zrobiliby to Twoi klienci, zanim aktualizacja trafi do użytku.',
            ],
            'ownership' => [
                'badge' => 'Współpraca',
                'title' => 'Dostęp do kodu w trakcie prac',
                'desc' => 'Pracujemy w Twoim repozytorium GitHub albo udostępniamy nasze na czas prac. Sposób współpracy ustalamy na początku projektu.',
            ],
            'direct' => [
                'badge' => 'Bezpośrednio',
                'title' => 'Rozmawiasz z osobą, która buduje system',
                'desc' => 'Bez opiekunów klienta pośrodku: zadania omawiasz bezpośrednio z senior developerem, który pisze kod.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Cztery etapy do startu',
        'subtitle' => 'Etap trwa do dwóch tygodni i kończy się prezentacją na wersji testowej. Przy mniejszym zakresie etapy są krótsze, a start jest możliwy po 6 tygodniach.',
        'sprints' => [
            's1' => [
                'name' => 'Planowanie i fundamenty',
                'duration' => 'Tygodnie 1–2',
                'desc' => 'Opisujemy Twój proces i budujemy podstawę, która będzie rosła razem z firmą.',
            ],
            's2' => [
                'name' => 'Główne funkcje i płatności',
                'duration' => 'Tygodnie 3–4',
                'desc' => 'To, dla czego powstaje system, oraz płatności online, jeśli są potrzebne.',
            ],
            's3' => [
                'name' => 'Panel klienta i panel administracyjny',
                'duration' => 'Tygodnie 5–6',
                'desc' => 'To, z czego codziennie będą korzystać Twoi klienci i zespół.',
            ],
            's4' => [
                'name' => 'Testy i uruchomienie',
                'duration' => 'Tygodnie 7–8',
                'desc' => 'Końcowe testy, przegląd bezpieczeństwa i wdrożenie na uzgodnionym hostingu.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Software house z zespołem i project managerem sprawdza się przy dużych projektach. Przy większości systemów dla firm wystarczy jeden senior developer — dlatego budżet jest niższy.',
        'badge' => 'Cennik',
        'title' => 'Dwie formy współpracy',
        'subtitle' => 'Stały zakres i cena za pierwszą wersję systemu albo miesięczne wsparcie systemu, który już działa.',
        'plans' => [
            'mvp' => [
                'name' => 'Nowy system',
                'badge' => 'Dla nowego systemu',
                'price' => 'od 19 000 PLN',
                'price_sub' => '≈ $4 800 · stały zakres',
                'timeline' => 'Zwykle 6–8 tygodni',
                'desc' => 'Dla firm, które chcą mieć własne rezerwacje online, panel klienta, CRM lub system wewnętrzny zamiast arkuszy i zewnętrznych platform.',
                'features' => [
                    'Analiza Twojego procesu i jasny zakres prac',
                    'Rezerwacje online, panel klienta lub system wewnętrzny — jak ustalimy',
                    'Panel administracyjny dla Twojego zespołu',
                    'Zamknięta wersja testowa od pierwszego tygodnia',
                    'Automatyczne testy kluczowych scenariuszy',
                    'Wdrożenie na uzgodnionym hostingu',
                    'Dostęp do kodu i dokumentacja projektu',
                    '2 tygodnie poprawek po uruchomieniu',
                ],
                'cta' => 'Porozmawiajmy o systemie',
            ],
            'retainer' => [
                'name' => 'Wsparcie i rozwój',
                'badge' => 'Dla działającego systemu',
                'price' => 'od 9 500 PLN',
                'price_sub' => '≈ $2 400 · miesięcznie',
                'timeline' => 'Miesięcznie',
                'desc' => 'Dla systemu, który już działa i potrzebuje nowych funkcji, usprawnień, integracji lub niezawodnej opieki.',
                'features' => [
                    'Przegląd systemu, danych i bezpieczeństwa',
                    'Nowe funkcje i integracje',
                    'Poprawa szybkości i niezawodności',
                    'Monitoring i aktualizacje',
                    'Bezpośredni kanał na Telegramie',
                    'Zarezerwowana liczba godzin tygodniowo',
                ],
                'cta' => 'Porozmawiajmy o wsparciu',
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
        'role' => 'Założyciel DigiSpace · Senior developer',
        'bio' => 'Tworzę systemy webowe dla firm od początku do końca: od zrozumienia procesu po uruchomienie i utrzymanie. Moje własne produkty działają codziennie, więc wiem, że system musi działać także długo po starcie.',
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'Systemy rezerwacji, CRM, panele klienta, narzędzia AI',
            'Własne produkty w codziennym użyciu: DigiPulse, VetSpace, NetPostPanel',
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
        'subtitle' => 'Terminy, koszty, hosting i forma współpracy.',
        'items' => [
            'q1' => [
                'q' => 'Ile to trwa?',
                'a' => 'Pierwsza wersja obejmuje 3–5 funkcji najważniejszych dla Twojej firmy. Typowy plan to cztery dwutygodniowe etapy; przy mniejszym zakresie start jest możliwy po 6 tygodniach. Jeśli potrzeba więcej, powiemy o tym już na etapie wyceny i wspólnie zaplanujemy kolejne kroki.',
            ],
            'q2' => [
                'q' => 'Jak wygląda dostęp do kodu?',
                'a' => 'Pracujemy w Twoim repozytorium GitHub albo udostępniamy nasze na czas prac. Warunki przekazania kodu i hosting gotowego produktu ustalamy przed rozpoczęciem projektu.',
            ],
            'q3' => [
                'q' => 'Ile kosztuje utrzymanie systemu?',
                'a' => 'Na czas prac udostępniamy środowisko testowe. Hosting gotowego produktu i sposób jego opłacania ustalamy osobno. Koszt zależy od obciążenia i potrzebnych usług.',
            ],
            'q4' => [
                'q' => 'Czego potrzebujecie ode mnie na start?',
                'a' => 'Krótkiego opisu tego, co chcesz usprawnić: jaki proces, kto z niego korzysta i co dziś zabiera za dużo czasu. Wypełnij formularz na tej stronie albo napisz na Telegramie, a potem na krótkiej rozmowie online lub na spotkaniu w Poznaniu ustalamy zakres.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Płatność jest podzielona na cztery etapy: 25% na początku każdego. Możliwa jest też płatność przez escrow. Rezultat każdego etapu widzisz w wersji testowej, zanim zapłacisz za kolejny.',
            ],
            'q7' => [
                'q' => 'Czy pracujecie z firmami z Poznania i okolic?',
                'a' => 'Tak. Jesteśmy w Stęszewie pod Poznaniem, więc z klientami z Poznania i powiatu poznańskiego — Lubonia, Komornik, Dopiewa, Mosiny, Puszczykowa, Swarzędza, Suchego Lasu, Tarnowa Podgórnego — możemy spotkać się osobiście: u Ciebie w firmie albo w Poznaniu, na przykład na starcie projektu lub przed uruchomieniem. Z klientami z innych regionów Polski i z zagranicy pracujemy zdalnie, według tego samego procesu.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Opowiedz nam o swojej firmie',
        'subtitle' => 'Wypełnij krótki formularz albo napisz na Telegramie — omówimy zakres prac, koszt i termin realizacji.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'project_name' => 'Imię lub nazwa firmy',
            'project_name_placeholder' => 'Anna / Twoja Firma sp. z o.o.',
            'contact' => 'Telegram lub e-mail',
            'contact_placeholder' => '@username lub name@company.com',
            'stage' => 'Co masz teraz',
            'not_specified' => 'Nie podano',
            'stage_options' => [
                'idea' => 'Pomysł albo ręczny proces do usprawnienia',
                'spec' => 'Spisany opis tego, co jest potrzebne',
                'rewrite' => 'System, który trzeba zmienić lub zastąpić',
            ],
            'budget' => 'Budżet',
            'budget_options' => [
                'sprint' => '19 000 – 34 000 PLN (pierwsza wersja)',
                'custom' => '34 000+ PLN (większy system, AI)',
                'retainer' => 'Wsparcie miesięczne',
            ],
            'description' => 'Co ma robić system?',
            'description_placeholder' => 'Na przykład: rezerwacje online do 3 specjalistów, historia klientów i przypomnienia',
            'submit' => 'Otrzymaj wycenę',
            'response_time' => 'Odpowiadamy w ciągu jednego dnia roboczego.',
            'errors_title' => 'Sprawdź formularz:',
            'validation' => [
                'required' => 'Uzupełnij pole „:attribute”.',
                'max' => 'Pole „:attribute” jest za długie (maks. :max znaków).',
                'invalid' => 'Wybierz wartość z listy w polu „:attribute”.',
            ],
            'recaptcha_failed' => 'Nie udało się potwierdzić, że formularz wysłała osoba. Spróbuj ponownie albo napisz do nas na Telegramie.',
            'recaptcha_notice' => 'Formularz jest chroniony przez Google reCAPTCHA:',
            'recaptcha_privacy' => 'Polityka prywatności',
            'recaptcha_terms' => 'Warunki korzystania',
            'privacy_notice' => 'Administratorem danych jest Yurii Mokryi JDG (DigiSpace). Dane z formularza wykorzystujemy wyłącznie do odpowiedzi na Twoje zapytanie.',
            'success_title' => 'Dziękujemy!',
            'success_message' => 'Otrzymaliśmy Twoją wiadomość i w ciągu jednego dnia roboczego odpowiemy z pytaniami albo wstępną wyceną.',
        ],
    ],

    'footer' => [
        'legal' => 'Yurii Mokryi JDG · NIP 7773404080 · REGON 524949632',
        'privacy_policy' => 'Polityka prywatności',
        'tagline' => 'Systemy dla firm na zamówienie',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Stęszew pod Poznaniem, Wielkopolska, Polska.',
    ],
];
