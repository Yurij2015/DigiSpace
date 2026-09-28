<?php

return [
    'seo' => [
        'title' => 'Tworzenie SaaS MVP w Poznaniu | DigiSpace',
        'description' => 'Tworzenie SaaS MVP w 6–8 tygodni: multi-tenancy, subskrypcje Stripe, kolejki zadań w tle i integracje AI. DigiSpace współpracuje z klientami z Poznania, całej Polski i UE.',
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
        'title' => 'SaaS MVP od pomysłu do startu w 6–8 tygodni',
        'subtitle' => 'Projektujemy i tworzymy produkty SaaS na solidnych podstawach: osobne dane dla każdej firmy-klienta, subskrypcje Stripe, zadania w tle i funkcje AI tam, gdzie mają sens. Rozmawiasz bezpośrednio z programistą, który pisze kod.',
        'subtitle_short' => 'Produkty SaaS na solidnych podstawach: osobne dane dla każdego klienta, subskrypcje Stripe, zadania w tle i AI. Rozmawiasz bezpośrednio z programistą.',
        'cta_primary' => 'Otrzymaj wycenę zakresu i terminu',
        'status' => 'Przyjmujemy nowe projekty',
        'metric_labels' => [
            'price' => 'Budżet',
            'timeline' => 'Termin',
            'ownership' => 'Własność',
        ],
        'metrics' => [
            'price' => 'MVP od 19 000 PLN netto',
            'timeline' => '6–8 tygodni do startu',
            'ownership' => 'Kod i serwery należą do Ciebie',
        ],
    ],

    'proofs' => [
        'badge' => 'Nasze projekty',
        'title' => 'Produkty, które sami stworzyliśmy i utrzymujemy',
        'subtitle' => 'Każdy z tych systemów działa produkcyjnie. Zobacz zrzuty ekranu albo otwórz sam produkt.',
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
                    ['file' => 'digipulse-dashboard', 'caption' => 'Dashboard: status, typy sprawdzeń, SSL, ping i uptime z 30 dni dla każdej strony (nazwy stron rozmyte)'],
                    ['file' => 'digipulse-history', 'caption' => 'Historia strony: czas odpowiedzi z tygodnia, P95, Apdex i incydenty'],
                ],
                'tagline' => 'Monitoring dostępności stron z powiadomieniami o incydentach',
                'stack' => ['Laravel Octane', 'Go', 'Redis', 'Filament', 'PostgreSQL', 'MCP'],
                'live_url' => 'https://digipulse.cloud',
            ],
            'vetspace' => [
                'badge' => 'Platforma B2B multi-tenant',
                'name' => 'VetSpace & VetCard',
                'screens' => [
                    ['file' => 'vetspace-clinic-month', 'caption' => 'Panel kliniki: widok miesiąca z liczbą wizyt każdego lekarza na każdy dzień (dane demonstracyjne)'],
                    ['file' => 'vetspace-clinic-calendar', 'caption' => 'Panel kliniki: kalendarz wizyt z filtrami oddziałów i lekarzy (dane demonstracyjne)'],
                    ['file' => 'vetspace-admin-plans', 'caption' => 'Panel administracyjny w Filament: plany subskrypcji zsynchronizowane ze Stripe'],
                    ['file' => 'vetspace-swagger-appointments', 'caption' => 'REST API z dokumentacją OpenAPI (Swagger): endpointy wizyt'],
                ],
                'tagline' => 'Platforma dla klinik weterynaryjnych i właścicieli zwierząt',
                'stack' => ['Laravel API', 'Nuxt SSR', 'Multi-tenancy', 'Stripe Cashier', 'Tailwind CSS', 'PostgreSQL'],
                'live_url' => 'https://vetspace.pro',
            ],
            'netpostpanel' => [
                'badge' => 'Platforma AI i RAG',
                'name' => 'NetPostPanel',
                'screens' => [
                    ['file' => 'netpostpanel-workbench', 'caption' => 'Workbench: typ treści, prompt i research źródeł w jednym procesie'],
                    ['file' => 'netpostpanel-autopilot', 'caption' => 'Auto Pilot: codzienne generowanie według harmonogramu z własnych tematów i źródeł'],
                ],
                'tagline' => 'Przygotowanie treści z AI: research źródeł, szkice, wyszukiwanie semantyczne',
                'stack' => ['Laravel', 'RAG', 'Qdrant', 'Langfuse', 'Horizon', 'LLM API'],
                'live_url' => 'https://github.com/Yurij2015/net-post-panel-overview',
                // Not a public product: link the descriptive repository, as the portfolio does.
                'link_label' => 'Opis projektu na GitHubie',
            ],
        ],
    ],

    'engine' => [
        'title' => 'Elementy typowego SaaS MVP',
        'subtitle' => 'Które z nich są potrzebne Twojemu produktowi, ustalamy na starcie. Nie budujemy tego, z czego nie skorzystasz.',
        'pillars' => [
            'multitenancy' => [
                'title' => 'Multi-tenancy',
            ],
            'billing' => [
                'title' => 'Subskrypcje Stripe',
            ],
            'workers' => [
                'title' => 'Zadania w tle',
            ],
            'admin' => [
                'title' => 'Panel administracyjny (Filament)',
            ],
            'ai' => [
                'title' => 'Funkcje AI i RAG',
            ],
            'devops' => [
                'title' => 'Docker i wdrożenie',
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
                'title' => 'Serwer testowy od pierwszego tygodnia',
                'desc' => 'W pierwszym tygodniu dostajesz serwer testowy chroniony hasłem. Każda zmiana, która przejdzie testy automatyczne, trafia tam automatycznie (GitHub Actions), więc widzisz sam produkt, a nie raporty o statusie.',
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
                'desc' => 'Bez project managerów pośrodku: zadania omawiasz bezpośrednio z senior full-stack developerem, który pisze kod.',
            ],
        ],
    ],

    'process' => [
        'title' => 'Cztery etapy do startu',
        'subtitle' => 'Etap trwa do dwóch tygodni i kończy się prezentacją na serwerze testowym. Przy mniejszym zakresie etapy są krótsze, a start jest możliwy po 6 tygodniach.',
        'sprints' => [
            's1' => [
                'name' => 'Architektura i fundamenty',
                'duration' => 'Tygodnie 1–2',
                'desc' => 'Architektura z zapasem na rozwój produktu.',
            ],
            's2' => [
                'name' => 'Główne funkcje i płatności',
                'duration' => 'Tygodnie 3–4',
                'desc' => 'Najważniejsza funkcja Twojego produktu oraz subskrypcje.',
            ],
            's3' => [
                'name' => 'Panel użytkownika i panel administracyjny',
                'duration' => 'Tygodnie 5–6',
                'desc' => 'Miejsce pracy Twoich klientów i Twojego zespołu.',
            ],
            's4' => [
                'name' => 'Testy i uruchomienie',
                'duration' => 'Tygodnie 7–8',
                'desc' => 'Testy end-to-end, przegląd bezpieczeństwa i wdrożenie produkcyjne.',
            ],
        ],
    ],

    'pricing' => [
        'net_label' => 'netto',
        'vat_note' => 'Wszystkie ceny są cenami netto. Jako czynny podatnik VAT doliczamy VAT zgodnie z polskimi przepisami (23% dla klientów w Polsce).',
        'comparison_note' => 'Software house z zespołem i project managerem sprawdza się przy dużych projektach. Przy MVP zwykle wystarczy jeden senior developer — dlatego budżet jest niższy.',
        'badge' => 'Cennik',
        'title' => 'Dwie formy współpracy',
        'subtitle' => 'Stały zakres i cena, żeby uruchomić MVP, albo współpraca miesięczna przy produkcie, który już działa.',
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
                'name' => 'Wsparcie senior',
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
        'bio' => 'Projektuję i tworzę produkty webowe od początku do końca: od bazy danych i płatności po wdrożenie i utrzymanie. Moje własne produkty SaaS działają produkcyjnie, więc wiem, że praca nie kończy się na uruchomieniu.',
        'more_links' => 'Wideo i blog',
        'facts' => [
            'Ponad 8 lat doświadczenia komercyjnego',
            'Laravel, Symfony, Filament, Vue/Nuxt, Go',
            'Własne produkty SaaS działające produkcyjnie: DigiPulse, VetSpace, NetPostPanel',
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
                'q' => 'Dlaczego 6–8 tygodni?',
                'a' => 'Pierwsza wersja obejmuje 3–5 funkcji, które rozwiązują główny problem Twoich użytkowników i za które są gotowi zapłacić. Logowanie, multi-tenancy i rozliczenia Stripe budujemy z gotowych, sprawdzonych modułów, a nie od zera. Typowy plan to cztery dwutygodniowe etapy; przy mniejszym zakresie etapy są krótsze, a start jest możliwy po 6 tygodniach. Jeśli zakres jest większy, powiemy o tym już na etapie wyceny.',
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
                'a' => 'Krótkiego opisu: jaki problem rozwiązuje produkt, dla kogo jest i jak będzie zarabiać. Wypełnij formularz na tej stronie albo napisz na Telegramie, a potem na krótkiej rozmowie online lub na spotkaniu w Poznaniu ustalamy zakres MVP i przygotowujemy specyfikację techniczną.',
            ],
            'q6' => [
                'q' => 'Jak wyglądają płatności?',
                'a' => 'Płatność jest podzielona na cztery etapy: 25% na początku każdego; możliwy jest też escrow. Rezultat każdego etapu widzisz na serwerze testowym, zanim zapłacisz za kolejny.',
            ],
            'q7' => [
                'q' => 'Czy pracujecie z firmami z Poznania i okolic?',
                'a' => 'Tak. Jesteśmy w Stęszewie pod Poznaniem, więc z klientami z Poznania i powiatu poznańskiego — Lubonia, Komornik, Dopiewa, Mosiny, Puszczykowa, Swarzędza, Suchego Lasu, Tarnowa Podgórnego — możemy spotkać się osobiście: u Ciebie w firmie albo w Poznaniu, na przykład na starcie projektu lub przed uruchomieniem. Z klientami z innych regionów Polski i z zagranicy pracujemy zdalnie, według tego samego procesu.',
            ],
        ],
    ],

    'contact' => [
        'badge' => 'Kontakt',
        'title' => 'Opowiedz nam o swoim produkcie',
        'subtitle' => 'Wypełnij krótki formularz albo napisz na Telegramie — odpowiemy z wyceną zakresu i terminu.',
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
                'custom' => '34 000+ PLN (złożony projekt, AI)',
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
        'tagline' => 'Tworzenie SaaS i aplikacji webowych',
        'all_rights_reserved' => 'Wszelkie prawa zastrzeżone',
        'location' => 'Stęszew pod Poznaniem, Wielkopolska, Polska.',
    ],
];
