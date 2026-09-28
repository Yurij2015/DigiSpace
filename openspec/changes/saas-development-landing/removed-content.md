# Content removed from the SaaS landing (restructure, 2026-09-28)

The landing was cut down to a short funnel (tasks §12). The texts below were taken out word for word so they can be reused elsewhere — none of them is wrong, they just don't belong on a landing page. **Parked until the landing is finished**; then decide where each piece goes.

## Where each piece could go

| Piece | Suggested home | Why |
|---|---|---|
| Project architecture descriptions + code/pipeline illustrations | Case-study pages (one per product) or the project widgets on `/about` | Readers who want details look there; also useful for SEO |
| Agency comparison table | New "How we work" tab on `/about` (widget category 7) | Explains the format of work, not the offer |
| Building-block descriptions (multi-tenancy, Stripe, queues…) | `/services` pages | Describe services, not the landing offer |
| Sprint deliverable lists | The written proposal sent after the first call | Details for someone who has already decided to talk |
| FAQ q5 (production bugs) | Nowhere for now — it repeated the "Automated tests" rule | — |
| VetSpace mock card points | Nowhere — the real screenshots replaced it | — |

`/about` is built from DB widgets edited in the admin panel (old Bootstrap theme), so moving content there is a content change in production, not a code change.

---

## 1. Project descriptions (`saas.proofs.projects.*.desc`)

**DigiPulse**
- en: Laravel Octane and Filament handle scheduling, Redis passes checks to workers written in Go, and alerts go out through Telegram and email. It also has an MCP server, so AI assistants can read monitoring data.
- uk: Laravel Octane і Filament відповідають за планування, Redis передає перевірки воркерам на Go, а сповіщення надходять у Telegram та на email. Також є MCP-сервер, через який AI-асистенти можуть читати дані моніторингу.
- pl: Laravel Octane i Filament odpowiadają za harmonogram, Redis przekazuje sprawdzenia do workerów w Go, a powiadomienia trafiają na Telegram i e-mail. Jest też serwer MCP, dzięki któremu asystenci AI mogą odczytywać dane z monitoringu.

**VetSpace & VetCard**
- en: Every clinic has its own isolated data, its own subdomain or domain, online booking, a staff area and a Stripe subscription (Laravel Cashier). The Nuxt frontend renders pages on the server, so clinic pages load fast and are easy for search engines to index.
- uk: Кожна клініка має ізольовані дані, свій піддомен або домен, онлайн-запис, кабінет персоналу й підписку Stripe (Laravel Cashier). Фронтенд на Nuxt рендерить сторінки на сервері, тому вони швидко завантажуються й добре індексуються пошуковиками.
- pl: Każda klinika ma odizolowane dane, własną subdomenę lub domenę, rezerwacje online, panel dla personelu i subskrypcję Stripe (Laravel Cashier). Frontend w Nuxt korzysta z renderowania po stronie serwera (SSR), dzięki czemu serwisy klinik szybko się ładują i są dobrze indeksowane przez wyszukiwarki.

**NetPostPanel**
- en: A RAG pipeline: source research, web scraping, LLM-assisted drafting and vector embeddings. Qdrant handles semantic search, Langfuse tracks LLM cost and latency, and Laravel Horizon runs the queues, including scheduled automatic runs.
- uk: RAG-конвеєр: дослідження джерел, збір даних з вебсторінок, підготовка чернеток за допомогою LLM і векторні ембединги. Qdrant відповідає за семантичний пошук, Langfuse стежить за вартістю й затримками LLM-запитів, а Laravel Horizon керує чергами, зокрема автоматичними запусками за розкладом.
- pl: Pipeline RAG: research źródeł, pobieranie danych ze stron, przygotowanie szkiców z pomocą LLM i embeddingi wektorowe. Qdrant obsługuje wyszukiwanie semantyczne, Langfuse śledzi koszt i czas odpowiedzi LLM, a Laravel Horizon zarządza kolejkami, w tym automatycznymi uruchomieniami według harmonogramu.

### Illustrations that were next to the descriptions

DigiPulse — simplified from `monitor/internal/worker/worker.go`:

```go
// Simplified from DigiPulse's Go monitor
func (w *Worker) Start(ctx context.Context) {
    w.redis.BRPop(ctx, block, "monitoring:tasks")
    // http · ssl · dns · port · ping
    w.processTask(task)
}
func (w *Worker) reportResult(r CheckResult) {
    w.redis.LPush(ctx, "monitoring:results", data)
}
```

VetSpace — mock card `{clinic}.vetspace.pro`, caption "Clinic workspace / Кабінет клініки / Panel kliniki", badge "Stripe", points:
- en: Clinic data is isolated from other clinics · Own subdomain or custom domain · Subscription billed through Stripe
- uk: Дані клініки ізольовані від інших клінік · Власний піддомен або домен · Підписка через Stripe
- pl: Dane kliniki odizolowane od innych klinik · Własna subdomena lub domena · Subskrypcja rozliczana przez Stripe

NetPostPanel — "RAG Vector Pipeline · Qdrant + Langfuse": 1. Web Scraping — 200 OK · 2. Vector Embeddings — 768 dims · 3. Semantic Search (Qdrant) — top_k=5 cosine · 4. LLM Synthesis & Tracing — Langfuse Tracked

## 2. Building blocks (`saas.engine.pillars.*.desc` / `.tag`; section badge "What’s included / Що входить / Co obejmuje")

| Block | en | uk | pl |
|---|---|---|---|
| Multi-tenancy · *Data isolation / Ізоляція даних / Izolacja danych* | Each client company sees only its own data: a separate database or a shared one scoped by tenant. Custom domains and branding when needed. | Кожна компанія-клієнт бачить лише свої дані: окрема база або спільна з розмежуванням за тенантом. За потреби — власні домени й брендинг. | Każda firma-klient widzi tylko swoje dane: osobna baza albo wspólna z podziałem na tenantów. W razie potrzeby własne domeny i branding. |
| Stripe subscriptions · *Payments / Платежі / Płatności* | Stripe Checkout, a customer portal for cards and plans, webhook handling, monthly and annual plans, invoices. | Stripe Checkout, клієнтський портал для карток і тарифів, обробка вебхуків, місячні та річні тарифи, рахунки. | Stripe Checkout, portal klienta do zarządzania kartami i planami, obsługa webhooków, plany miesięczne i roczne, faktury. |
| Background jobs · *Performance / Швидкодія / Wydajność* | Slow work (PDFs, emails, scraping, AI requests) runs in queues so the interface stays responsive. Go workers are used where throughput actually matters. | Повільні операції (PDF, листи, збір даних, AI-запити) виконуються в чергах, тому інтерфейс не гальмує. Воркери на Go — там, де справді важлива пропускна здатність. | Czasochłonne operacje (PDF, e-maile, pobieranie danych, zapytania do AI) działają w kolejkach, więc interfejs nie zwalnia. Workery w Go tam, gdzie przepustowość naprawdę ma znaczenie. |
| Admin panel (Filament) · *Operations / Операції / Operacje* | Manage users, companies and subscriptions, sign in as a user to reproduce issues, activity log and basic revenue figures. | Керування користувачами, компаніями й підписками, вхід від імені користувача для відтворення проблем, журнал дій і базові показники виручки. | Zarządzanie użytkownikami, firmami i subskrypcjami, logowanie jako użytkownik w celu odtworzenia problemu, dziennik zdarzeń i podstawowe dane o przychodach. |
| AI features and RAG · *AI* | Semantic search over your documents (Qdrant), assistants that answer from your own data with sources, and structuring of user input with LLMs. | Семантичний пошук по ваших документах (Qdrant), асистенти, що відповідають на основі ваших даних із посиланнями на джерела, і структурування введених користувачами даних за допомогою LLM. | Wyszukiwanie semantyczne w Twoich dokumentach (Qdrant), asystenci odpowiadający na podstawie Twoich danych ze wskazaniem źródeł oraz porządkowanie danych od użytkowników za pomocą LLM. |
| Docker and deployment · *Infrastructure / Інфраструктура / Infrastruktura* | Docker Compose, CI/CD on GitHub Actions and deployment to your own Hetzner, AWS or DigitalOcean account. No dependency on us for hosting. | Docker Compose, CI/CD на GitHub Actions і розгортання у вашому акаунті Hetzner, AWS або DigitalOcean. Хостинг не залежить від нас. | Docker Compose, CI/CD w GitHub Actions i wdrożenie na Twoim koncie Hetzner, AWS lub DigitalOcean. Hosting nie zależy od nas. |

## 3. Agency comparison table (`saas.comparison`)

- Badge: Comparison / Порівняння / Porównanie
- Title: How this differs from a typical agency / Чим це відрізняється від типової агенції / Czym to się różni od typowego software house’u
- Subtitle:
  - en: Agencies suit large teams and long projects. For an MVP, a smaller format is often enough.
  - uk: Агенції добре підходять для великих команд і довгих проєктів. Для MVP часто достатньо меншого формату.
  - pl: Software house sprawdza się przy dużych zespołach i długich projektach. Przy MVP często wystarczy mniejsza forma współpracy.
- Headers: Aspect · Typical agency · DigiSpace / Критерій · Типова агенція · DigiSpace / Kryterium · Typowy software house · DigiSpace

| Row | Typical agency (en / uk / pl) | DigiSpace (en / uk / pl) |
|---|---|---|
| Who writes the code / Хто пише код / Kto pisze kod | A team; you communicate through a project manager / Команда; спілкування через проєктного менеджера / Zespół; komunikacja przez project managera | One senior developer you talk to directly / Один senior-розробник, з яким ви говорите напряму / Jeden senior developer, z którym rozmawiasz bezpośrednio |
| Time to MVP / Термін до MVP / Czas do MVP | Often 3–6 months / Часто 3–6 місяців / Często 3–6 miesięcy | 6–8 weeks for an agreed scope / 6–8 тижнів для погодженого обсягу / 6–8 tygodni dla uzgodnionego zakresu |
| MVP budget / Бюджет MVP / Budżet MVP | Often $15,000+ / Часто від $15 000 / Często od 60 000 PLN | From $4,800 for a fixed scope / Від $4 800 за фіксований обсяг / Od 19 000 PLN za stały zakres |
| First working version / Перша робоча версія / Pierwsza działająca wersja | Often after the design phase / Часто після етапу дизайну / Często po etapie projektowania | On a test server in the first week / На тестовому сервері в перший тиждень / Na serwerze testowym w pierwszym tygodniu |
| Testing / Тестування / Testowanie | Depends on the team and budget / Залежить від команди й бюджету / Zależy od zespołu i budżetu | Unit and Playwright tests are part of the scope / Unit- і Playwright-тести входять в обсяг робіт / Testy jednostkowe i Playwright są częścią zakresu |
| Code and servers / Код і сервери / Kod i serwery | Depends on the contract / Залежить від договору / Zależy od umowy | Your repository and your cloud account from day one / Ваш репозиторій і ваш хмарний акаунт з першого дня / Twoje repozytorium i Twoje konto w chmurze od pierwszego dnia |

## 4. Sprint deliverables (`saas.process.sprints.*.deliverables`; section badge "Plan / План / Plan")

**Sprint 1 — Architecture and foundation**
- en: Database design (PostgreSQL or MySQL) · Sign-in, roles and data separation between companies · Test server with automatic deployment (CI/CD) · Basic interface layout and UI components
- uk: Проєктування бази даних (PostgreSQL або MySQL) · Вхід, ролі та розмежування даних між компаніями · Тестовий сервер з автоматичним розгортанням (CI/CD) · Базовий макет інтерфейсу й UI-компоненти
- pl: Projekt bazy danych (PostgreSQL lub MySQL) · Logowanie, role i podział danych między firmami · Serwer testowy z automatycznym wdrażaniem (CI/CD) · Podstawowy układ interfejsu i komponenty UI

**Sprint 2 — Core features and payments**
- en: Core product logic · Stripe Checkout and customer portal (plans and subscriptions) · Stripe webhook handling (renewals, cancellations, invoices) · Queues for background jobs
- uk: Основна логіка продукту · Stripe Checkout і клієнтський портал (тарифи й підписки) · Обробка вебхуків Stripe (продовження, скасування, рахунки) · Черги для фонових задач
- pl: Główna logika produktu · Stripe Checkout i portal klienta (plany i subskrypcje) · Obsługa webhooków Stripe (odnowienia, anulowania, faktury) · Kolejki dla zadań w tle

**Sprint 3 — User area and admin panel**
- en: Responsive user dashboard (Tailwind CSS, Vue or Blade) · Filament admin panel for companies and subscriptions · AI features or third-party API integrations, if in scope · Email templates and notifications
- uk: Адаптивний кабінет користувача (Tailwind CSS, Vue або Blade) · Адмін-панель на Filament для компаній і підписок · AI-функції або інтеграції зі сторонніми API, якщо вони є в обсязі · Шаблони листів і сповіщення
- pl: Responsywny panel użytkownika (Tailwind CSS, Vue lub Blade) · Panel administracyjny w Filament do zarządzania firmami i subskrypcjami · Funkcje AI lub integracje z zewnętrznymi API, jeśli są w zakresie · Szablony e-maili i powiadomienia

**Sprint 4 — Testing and launch**
- en: Playwright tests for sign-up, onboarding and payment · Query optimisation, caching and a security review · Deployment to your cloud (Hetzner, AWS or DigitalOcean) · Documentation, repository handover and an admin panel walkthrough
- uk: Тести Playwright для реєстрації, онбордингу й оплати · Оптимізація запитів, кешування й перевірка безпеки · Розгортання у вашій хмарі (Hetzner, AWS або DigitalOcean) · Документація, передача репозиторію й огляд адмін-панелі
- pl: Testy Playwright dla rejestracji, onboardingu i płatności · Optymalizacja zapytań, cache i przegląd bezpieczeństwa · Wdrożenie w Twojej chmurze (Hetzner, AWS lub DigitalOcean) · Dokumentacja, przekazanie repozytorium i omówienie panelu administracyjnego

## 5. FAQ q5

- en: **How do you reduce the risk of production bugs?** Unit tests cover business logic and billing, and Playwright tests go through sign-up, onboarding and Stripe payment before every release. That does not rule out bugs, but it catches regressions before users do.
- uk: **Як ви зменшуєте ризик помилок у продакшні?** Unit-тести перевіряють бізнес-логіку й білінг, а тести Playwright перед кожним релізом проходять реєстрацію, онбординг і оплату через Stripe. Це не виключає помилок повністю, але дає змогу виявити регресії раніше, ніж їх помітять користувачі.
- pl: **Jak ograniczacie ryzyko błędów na produkcji?** Testy jednostkowe sprawdzają logikę biznesową i rozliczenia, a testy Playwright przed każdym wydaniem przechodzą rejestrację, onboarding i płatność przez Stripe. Nie wyklucza to błędów całkowicie, ale pozwala wyłapać regresje, zanim zauważą je użytkownicy.
