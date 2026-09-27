<?php

return [
    'seo' => [
        'title' => 'Tworzenie SaaS MVP w Poznaniu | DigiSpace',
        'description' => 'Tworzenie SaaS MVP w 6–8 tygodni: multi-tenancy, subskrypcje Stripe, kolejki zadań w tle i integracje AI. DigiSpace działa w Poznaniu i pracuje z klientami z Wielkopolski, całej Polski i UE.',
    ],

    'nav' => [
        'proofs' => 'Projekty',
        'engine' => 'Co obejmuje',
        'guarantees' => 'Jak pracujemy',
        'process' => 'Plan',
        'pricing' => 'Cennik',
        'faq' => 'FAQ',
        'cta' => 'Porozmawiajmy o projekcie',
        'location' => 'Poznań · Wielkopolska',
        'theme_toggle' => 'Przełącz jasny / ciemny motyw',
    ],

    'hero' => [
        'badge' => 'Tworzenie SaaS · Poznań',
        'title' => 'SaaS MVP od pomysłu do uruchomienia w 6–8 tygodni',
        'subtitle' => 'Projektujemy i tworzymy produkty SaaS na solidnych podstawach: osobne dane dla każdej firmy-klienta, subskrypcje Stripe, zadania w tle i funkcje AI tam, gdzie mają sens. Kod pisze ten sam programista, z którym rozmawiasz, bez pośredników. Działamy w Poznaniu i pracujemy z klientami z Wielkopolski, całej Polski oraz zdalnie.',
        'cta_primary' => 'Otrzymaj wycenę zakresu i terminu',
        'cta_secondary' => 'Zobacz nasze projekty',
        'status' => 'Przyjmujemy nowe projekty',
        'metric_labels' => [
            'timeline' => 'Termin',
            'ownership' => 'Własność',
            'staging' => 'Postęp',
        ],
        'metrics' => [
            'timeline' => '6–8 tygodni do startu',
            'ownership' => 'Kod i serwery należą do Ciebie',
            'staging' => 'Serwer testowy w pierwszym tygodniu',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Produkty, które sami stworzyliśmy i utrzymujemy',
        'subtitle' => 'Każdy z tych systemów działa produkcyjnie. Otwórz je i zobacz, jak działają.',
        'view_live' => 'Otwórz produkt',
        'projects' => [
            'digipulse' => [
                'badge' => 'Własny produkt SaaS',
                'name' => 'DigiPulse',
                'tagline' => 'Monitoring dostępności stron z powiadomieniami o incydentach',
                'desc' => 'Laravel Octane i Filament odpowiadają za harmonogram, Redis przekazuje sprawdzenia do workerów w Go, a powiadomienia trafiają na Telegram i e-mail. Jest też serwer MCP, dzięki któremu asystenci AI mogą odczytywać dane z monitoringu.',
                'stack' => ['Laravel Octane', 'Go', 'Redis', 'Filament', 'PostgreSQL', 'MCP'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Platforma B2B multi-tenant',
                'name' => 'VetSpace & VetCard',
                'tagline' => 'Platforma dla klinik weterynaryjnych i właścicieli zwierząt',
                'desc' => 'Każda klinika ma odizolowane dane, własną subdomenę lub domenę, rezerwacje online, panel dla personelu i subskrypcję Stripe (Laravel Cashier). Frontend w Nuxt korzysta z renderowania po stronie serwera (SSR), dzięki czemu serwisy klinik szybko się ładują i są dobrze indeksowane przez wyszukiwarki.',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Multi-tenancy', 'Stripe Cashier', 'Tailwind CSS', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
                'mock' => [
                    'caption' => 'Panel kliniki',
                    'points' => [
                        'Dane kliniki odizolowane od innych klinik',
                        'Własna subdomena lub domena',
                        'Subskrypcja rozliczana przez Stripe',
                    ],
                ],
            ],
            'netpostpanel' => [
                'badge' => 'Platforma AI i RAG',
                'name' => 'NetPostPanel',
                'tagline' => 'Przygotowanie treści z AI: research źródeł, szkice, wyszukiwanie semantyczne',
                'desc' => 'Pipeline RAG: research źródeł, pobieranie danych ze stron, przygotowanie szkiców z pomocą LLM i embeddingi wektorowe. Qdrant obsługuje wyszukiwanie semantyczne, Langfuse śledzi koszt i czas odpowiedzi LLM, a Laravel Horizon zarządza kolejkami, w tym automatycznymi uruchomieniami według harmonogramu.',
                'stack' => ['Laravel', 'RAG', 'Qdrant', 'Langfuse', 'Horizon', 'LLM API'],
                'live_url' => 'https://net-post-panel.digispace.pro',
            ],
        ],
    ],

    'engine' => [
        'badge' => 'Co obejmuje',
        'title' => 'Elementy typowego SaaS MVP',
        'subtitle' => 'Które z nich są potrzebne Twojemu produktowi, ustalamy na starcie. Nie budujemy tego, z czego nie skorzystasz.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Multi-tenancy',
                'desc' => 'Każda firma-klient widzi tylko swoje dane: osobna baza albo wspólna z podziałem na tenantów. W razie potrzeby własne domeny i branding.',
                'tag' => 'Izolacja danych',
            ],
            'billing' => [
                'title' => 'Subskrypcje Stripe',
                'desc' => 'Stripe Checkout, portal klienta do zarządzania kartami i planami, obsługa webhooków, plany miesięczne i roczne, faktury.',
                'tag' => 'Płatności',
            ],
            'workers' => [
                'title' => 'Zadania w tle',
                'desc' => 'Czasochłonne operacje (PDF, e-maile, pobieranie danych, zapytania do AI) działają w kolejkach, więc interfejs nie zwalnia. Workery w Go tam, gdzie przepustowość naprawdę ma znaczenie.',
                'tag' => 'Wydajność',
            ],
            'admin' => [
                'title' => 'Panel administracyjny (Filament)',
                'desc' => 'Zarządzanie użytkownikami, firmami i subskrypcjami, logowanie jako użytkownik w celu odtworzenia problemu, dziennik zdarzeń i podstawowe dane o przychodach.',
                'tag' => 'Operacje',
            ],
            'ai' => [
                'title' => 'Funkcje AI i RAG',
                'desc' => 'Wyszukiwanie semantyczne w Twoich dokumentach (Qdrant), asystenci odpowiadający na podstawie Twoich danych ze wskazaniem źródeł oraz porządkowanie danych od użytkowników za pomocą LLM.',
                'tag' => 'AI',
            ],
            'devops' => [
                'title' => 'Docker i wdrożenie',
                'desc' => 'Docker Compose, CI/CD w GitHub Actions i wdrożenie na Twoim koncie Hetzner, AWS lub DigitalOcean. Hosting nie zależy od nas.',
                'tag' => 'Infrastruktura',
            ],
        ],
    ],

    'guarantees' => [
        'badge' => 'Jak pracujemy',
        'title' => 'Na co możesz liczyć',
        'subtitle' => 'Cztery zasady, których trzymamy się w każdym projekcie.',
        'items' => [
            'staging' => [
                'badge' => 'Pierwszy tydzień',
                'title' => 'Serwer testowy od pierwszego tygodnia',
                'desc' => 'W pierwszym tygodniu dostajesz serwer testowy chroniony hasłem. Aktualizuje się w miarę postępu prac, więc widzisz sam produkt, a nie raporty o statusie.',
            ],
            'testing' => [
                'badge' => 'Testy',
                'title' => 'Testy automatyczne',
                'desc' => 'Testy jednostkowe sprawdzają logikę biznesową i rozliczenia, a testy Playwright przechodzą rejestrację, onboarding i płatność tak, jak zrobiłby to użytkownik. Uruchamiają się przy każdym pushu, więc regresje są wykrywane przed wydaniem.',
            ],
            'ownership' => [
                'badge' => 'Własność',
                'title' => 'Kod i infrastruktura należą do Ciebie',
                'desc' => 'Od pierwszego dnia commity trafiają do Twojego prywatnego repozytorium na GitHub lub GitLab, a aplikacja działa na Twoim koncie w chmurze. Bez zamkniętych licencji.',
            ],
            'direct' => [
                'badge' => 'Bezpośrednio',
                'title' => 'Rozmawiasz z programistą',
                'desc' => 'Bez project managerów pośrodku: zadania omawiasz bezpośrednio z senior full-stack developerem, który pisze kod (ponad 8 lat doświadczenia komercyjnego).',
            ],
        ],
    ],

    'comparison' => [
        'badge' => 'Porównanie',
        'title' => 'Czym to się różni od typowego software house’u',
        'subtitle' => 'Software house sprawdza się przy dużych zespołach i długich projektach. Przy MVP często wystarczy mniejsza forma współpracy.',
        'headers' => [
            'feature' => 'Kryterium',
            'software_house' => 'Typowy software house',
            'digispace' => 'DigiSpace',
        ],
        'rows' => [
            'team' => [
                'label' => 'Kto pisze kod',
                'agency' => 'Zespół; komunikacja przez project managera',
                'us' => 'Jeden senior developer, z którym rozmawiasz bezpośrednio',
            ],
            'timeline' => [
                'label' => 'Czas do MVP',
                'agency' => 'Często 3–6 miesięcy',
                'us' => '6–8 tygodni dla uzgodnionego zakresu',
            ],
            'cost' => [
                'label' => 'Budżet MVP',
                'agency' => 'Często od 60 000 PLN',
                'us' => 'Od 19 000 PLN za stały zakres',
            ],
            'staging' => [
                'label' => 'Pierwsza działająca wersja',
                'agency' => 'Często po etapie projektowania',
                'us' => 'Na serwerze testowym w pierwszym tygodniu',
            ],
            'testing' => [
                'label' => 'Testowanie',
                'agency' => 'Zależy od zespołu i budżetu',
                'us' => 'Testy jednostkowe i Playwright są częścią zakresu',
            ],
            'ownership' => [
                'label' => 'Kod i serwery',
                'agency' => 'Zależy od umowy',
                'us' => 'Twoje repozytorium i Twoje konto w chmurze od pierwszego dnia',
            ],
        ],
    ],

    'process' => [
        'badge' => 'Plan',
        'title' => 'Cztery dwutygodniowe sprinty do startu',
        'subtitle' => 'Każdy sprint ma konkretny rezultat i kończy się prezentacją na serwerze testowym.',
        'sprints' => [
            's1' => [
                'number' => '01',
                'name' => 'Architektura i fundamenty',
                'duration' => 'Tygodnie 1–2',
                'desc' => 'Podstawa, której nie trzeba będzie przepisywać, gdy produkt zacznie rosnąć.',
                'deliverables' => [
                    'Projekt bazy danych (PostgreSQL lub MySQL)',
                    'Logowanie, role i podział danych między firmami',
                    'Serwer testowy z automatycznym wdrażaniem (CI/CD)',
                    'Podstawowy układ interfejsu i komponenty UI',
                ],
            ],
            's2' => [
                'number' => '02',
                'name' => 'Główne funkcje i płatności',
                'duration' => 'Tygodnie 3–4',
                'desc' => 'Najważniejsza funkcja Twojego produktu oraz subskrypcje.',
                'deliverables' => [
                    'Główna logika produktu',
                    'Stripe Checkout i portal klienta (plany i subskrypcje)',
                    'Obsługa webhooków Stripe (odnowienia, anulowania, faktury)',
                    'Kolejki dla zadań w tle',
                ],
            ],
            's3' => [
                'number' => '03',
                'name' => 'Panel użytkownika i panel administracyjny',
                'duration' => 'Tygodnie 5–6',
                'desc' => 'Miejsce pracy Twoich klientów i Twojego zespołu.',
                'deliverables' => [
                    'Responsywny panel użytkownika (Tailwind CSS, Vue lub Blade)',
                    'Panel administracyjny w Filament do zarządzania firmami i subskrypcjami',
                    'Funkcje AI lub integracje z zewnętrznymi API, jeśli są w zakresie',
                    'Szablony e-maili i powiadomienia',
                ],
            ],
            's4' => [
                'number' => '04',
                'name' => 'Testy i uruchomienie',
                'duration' => 'Tygodnie 7–8',
                'desc' => 'Testy end-to-end, przegląd bezpieczeństwa i wdrożenie produkcyjne.',
                'deliverables' => [
                    'Testy Playwright dla rejestracji, onboardingu i płatności',
                    'Optymalizacja zapytań, cache i przegląd bezpieczeństwa',
                    'Wdrożenie w Twojej chmurze (Hetzner, AWS lub DigitalOcean)',
                    'Dokumentacja, przekazanie repozytorium i omówienie panelu administracyjnego',
                ],
            ],
        ],
    ],

    'pricing' => [
        'badge' => 'Cennik',
        'title' => 'Dwie formy współpracy',
        'subtitle' => 'Sprint o stałym zakresie, żeby uruchomić MVP, albo współpraca miesięczna przy produkcie, który już działa.',
        'plans' => [
            'mvp' => [
                'name' => 'SaaS MVP',
                'badge' => 'Dla nowego produktu',
                'price' => 'od 19 000 PLN',
                'price_sub' => '≈ $4 800 · stały zakres',
                'timeline' => '6–8 tygodni',
                'desc' => 'Dla założycieli, którzy chcą wystartować, sprawdzić popyt i pozyskać pierwszych płacących klientów.',
                'features' => [
                    'Projekt bazy danych i podział danych między firmami',
                    'Subskrypcje Stripe: płatność, portal klienta, faktury',
                    'Panel użytkownika i panel administracyjny w Filament',
                    'Serwer testowy od pierwszego tygodnia',
                    'Testy jednostkowe i Playwright',
                    'Wdrożenie w Dockerze na Twoim koncie w chmurze',
                    'Pełne przekazanie kodu i dokumentacji',
                    '2 tygodnie poprawek błędów po uruchomieniu',
                ],
                'cta' => 'Porozmawiajmy o MVP',
            ],
            'retainer' => [
                'name' => 'Fractional CTO',
                'badge' => 'Dla działającego produktu',
                'price' => 'od 9 500 PLN',
                'price_sub' => '≈ $2 400 · miesięcznie',
                'timeline' => 'Miesięcznie',
                'desc' => 'Dla działającego produktu SaaS, który potrzebuje wsparcia technicznego na poziomie senior: nowe funkcje, refaktoryzacja, integracje AI, skalowanie.',
                'features' => [
                    'Przegląd architektury, zapytań SQL i bezpieczeństwa',
                    'Złożone zadania backendowe (AI, RAG, workery w Go)',
                    'Testy obciążeniowe i przygotowanie do wzrostu',
                    'Code review i usprawnienia CI/CD',
                    'Bezpośredni kanał na Telegramie',
                    'Zarezerwowana liczba godzin tygodniowo',
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
            ],
            'linkedin' => [
                'quote' => 'Yurii to odpowiedzialny specjalista, który samodzielnie radzi sobie z szerokim zakresem zadań. Ma solidne doświadczenie w PHP (Symfony, Laravel) i frameworkach JavaScript (Vue.js, Angular) — potrafi samodzielnie zbadać złożone problemy, znaleźć ich przyczynę i wdrożyć skuteczne rozwiązanie.',
                'source' => 'Rekomendacja na LinkedIn · tłumaczenie z angielskiego',
                'url' => 'https://linkedin.com/in/yurii-mokryi',
            ],
        ],
    ],

    'faq' => [
        'badge' => 'FAQ',
        'title' => 'Częste pytania',
        'subtitle' => 'Terminy, płatności, hosting i forma współpracy.',
        'items' => [
            'q1' => [
                'q' => 'Dlaczego 6–8 tygodni?',
                'a' => 'Pierwsza wersja obejmuje 3–5 funkcji, które rozwiązują główny problem Twoich użytkowników i za które są gotowi zapłacić. Logowanie, multi-tenancy i rozliczenia Stripe budujemy z gotowych, sprawdzonych modułów, a nie od zera. Jeśli zakres jest większy, powiemy o tym już na etapie wyceny.',
            ],
            'q2' => [
                'q' => 'Do kogo należy kod?',
                'a' => 'Do Ciebie. Cała praca od pierwszego dnia trafia do Twojego prywatnego repozytorium na GitHub lub GitLab. Kod, konta i dostępy zostają u Ciebie.',
            ],
            'q3' => [
                'q' => 'Gdzie będzie działać aplikacja i ile kosztuje hosting?',
                'a' => 'W Dockerze na Twoim własnym koncie w chmurze (Hetzner, AWS lub DigitalOcean). Na MVP zwykle wystarcza VPS za około 60–140 PLN miesięcznie; konfigurację dobierzemy do spodziewanego obciążenia.',
            ],
            'q4' => [
                'q' => 'Czego potrzebujecie ode mnie na start?',
                'a' => 'Krótkiego opisu: jaki problem rozwiązuje produkt, dla kogo jest i jak będzie zarabiać. Na 30-minutowej rozmowie ustalamy zakres MVP i przygotowujemy specyfikację techniczną.',
            ],
            'q5' => [
                'q' => 'Jak ograniczacie ryzyko błędów na produkcji?',
                'a' => 'Testy jednostkowe sprawdzają logikę biznesową i rozliczenia, a testy Playwright przed każdym wydaniem przechodzą rejestrację, onboarding i płatność przez Stripe. Nie wyklucza to błędów całkowicie, ale pozwala wyłapać regresje, zanim zauważą je użytkownicy.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Płatność jest podzielona na sprinty: zwykle 25% na początku każdego dwutygodniowego sprintu; możliwy jest też escrow. Rezultat każdego sprintu widzisz na serwerze testowym, zanim zapłacisz za kolejny.',
            ],
            'q7' => [
                'q' => 'Czy pracujecie z firmami z Poznania i Wielkopolski?',
                'a' => 'Tak. Działamy w Poznaniu, więc z klientami z Poznania i okolic możemy spotkać się osobiście, na przykład na starcie projektu albo przed uruchomieniem. Z klientami z innych regionów Polski i z zagranicy pracujemy zdalnie, według tego samego procesu.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Opowiedz nam o swoim produkcie',
        'subtitle' => 'Napisz do nas na Telegramie albo wypełnij krótki formularz — odpowiemy z wyceną zakresu i terminu.',
        'telegram_cta' => 'Napisz na Telegramie',
        'telegram_hint' => 'Zwykle odpowiadamy tego samego dnia',
        'email_cta' => 'Napisz e-mail',
        'form' => [
            'title' => 'Wycena zakresu i terminu',
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
                'custom' => '34 000+ PLN (złożony projekt, AI)',
                'retainer' => 'Współpraca miesięczna',
            ],
            'description' => 'Krótki opis produktu',
            'description_placeholder' => 'Co będzie robić produkt i dla kogo jest?',
            'submit' => 'Wyślij',
            'submitting' => 'Wysyłanie…',
            'errors_title' => 'Sprawdź formularz:',
            'recaptcha_required' => 'Potwierdź, że nie jesteś robotem.',
            'success_title' => 'Dziękujemy!',
            'success_message' => 'Otrzymaliśmy Twoją wiadomość i w ciągu jednego dnia roboczego odpowiemy z pytaniami albo wstępną wyceną.',
        ],
    ],

    'footer' => [
        'privacy_policy' => 'Polityka prywatności',
        'tagline' => 'Tworzenie SaaS i aplikacji webowych',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Poznań, Wielkopolska, Polska.',
    ],
];
