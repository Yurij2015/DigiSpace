# admin/navigation Specification

## Purpose
Keeps the control panel sidebar predictable: everyday content work is at the top, site configuration is one collapsed group below, and the portfolio module stays separate.

## Requirements

### Requirement: Three navigation groups in a fixed order
The sidebar MUST present resources in exactly three groups, in this order: **Content** (Posts, Categories, Pages, Blog banners), **Settings** (Products, Product services, Services, Service categories, Widgets, Widget icons, Menus, Menu items, Header, Footer bottom bar, Useful links) and **Portfolio** (all `Pf*` resources). No resource MAY appear outside these groups.

#### Scenario: Sidebar composition
- **WHEN** an authorised user opens any control-panel page
- **THEN** the sidebar shows Content first with Posts as its first item, then Settings, then Portfolio, and every resource is inside one of them

### Requirement: Settings and Portfolio start collapsed
The Content group MUST be expanded by default; Settings and Portfolio MUST be collapsible and collapsed on first visit.

#### Scenario: First visit
- **WHEN** a user opens the panel in a fresh browser session
- **THEN** Content items are visible and Settings/Portfolio show only their headings until expanded
