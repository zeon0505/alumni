# Design Document: SIFORAL UI/UX Modernization

## Introduction

This document specifies the complete modernization of SIFORAL (Sistem Informasi Alumni STAIMAS Wonogiri) user interface and experience. The goal is to transform the existing functional but basic UI into a modern, smooth, and professional system inspired by contemporary design aesthetics (Linear, Notion, Vercel) while maintaining all existing functionality and routes.

**Technology Stack:**
- Laravel 11
- Tailwind CSS 4 (using @theme in CSS)
- Vanilla JavaScript for interactions
- Instrument Sans font family

**Design Philosophy:**
- Modern but simple and professional — not over-designed
- Smooth, purposeful animations (200-300ms transitions)
- Soft, non-jarring color palette
- Mobile-first responsive design
- Consistent component library across all pages

## Overview

The SIFORAL UI modernization enhances the visual design and user experience while preserving all existing backend functionality. This is a frontend-only redesign that updates 18+ Blade template files across two portals (Alumni and Admin).

**Scope:**
- Alumni Portal: 6 views (layouts, dashboard, profile, career, questionnaires)
- Admin Panel: 12+ views (layouts, dashboard, CRUD operations for alumni and questionnaires)
- Shared: Design system, component library, animations

**Key Changes:**
- Design system implementation (colors, typography, spacing, shadows)
- Modern component library (buttons, cards, forms, tables, alerts)
- Smooth animations and micro-interactions (200-300ms transitions)
- Improved responsive behavior (mobile-first approach)
- Enhanced accessibility (WCAG AA compliance)

**Non-Goals:**
- No changes to routes, controllers, or business logic
- No database schema changes
- No new features (only UI/UX improvements)
- No JavaScript framework integration

## Architecture

The modernization follows a layered design approach with no changes to backend architecture:

**Presentation Layer (Views):**
- Blade templates using Tailwind CSS 4 utilities
- Vanilla JavaScript for client-side interactions
- No build-time JavaScript framework
- Progressive enhancement approach

**Design System Layer:**
- Centralized color palette, typography, spacing
- Reusable component patterns
- Consistent animation timings
- Responsive breakpoint strategy

**Component Hierarchy:**
```
Layouts (app.blade.php, admin.blade.php)
├── Shared Components (header, sidebar, footer)
├── Page Templates (dashboard, forms, tables)
│   ├── Cards
│   ├── Forms (inputs, buttons, validation)
│   ├── Tables (headers, rows, pagination)
│   └── Modals
└── Micro-interactions (hover, focus, loading)
```

**View Organization:**
- Alumni Portal: `/resources/views/{layouts, dashboard, profile, karir, kuisioner}`
- Admin Panel: `/resources/views/admin/{layouts, dashboard, alumni, kuesioner}`
- Modals: `/resources/views/karir/modals/{pekerjaan, pendidikan, wirausaha}`

**Technology Decisions:**
- **Tailwind CSS 4**: Utility-first CSS framework, @theme configuration
- **Vanilla JS**: No build step, direct DOM manipulation, minimal dependencies
- **Mobile-first**: Start with mobile styles, progressively enhance for desktop
- **Progressive Enhancement**: Core functionality works without JS, animations enhance

## Components and Interfaces

The design defines a comprehensive component library implemented via Tailwind utility classes in Blade templates:

**Core Components:**
1. **Buttons** (5 variants): Primary, Secondary, Danger, Ghost, Icon
2. **Cards** (4 types): Default, Interactive, Header, Footer
3. **Forms** (6 inputs): Text, Textarea, Select, Checkbox, Radio, File
4. **Tables**: Header, Body, Rows with hover states
5. **Badges**: Status indicators with color variants
6. **Alerts**: Success, Info, Warning, Error with icons
7. **Modals**: Overlay, Container, Header, Body, Footer
8. **Loading**: Spinners, Button loading, Skeleton loaders
9. **Empty States**: Icon, Heading, Description, Action

**Layout Components:**
- Header: Fixed navigation with logo and actions
- Sidebar: Collapsible navigation with active states
- Main: Content area with max-width constraints
- Footer: Timestamp and action buttons

**Component Interfaces (Props via Blade):**

**Button Component Pattern:**
```blade
{{-- Primary Button --}}
<button type="{{ $type ?? 'button' }}"
        class="bg-primary-600 hover:bg-primary-700 active:bg-primary-800
               text-white font-semibold px-4 py-2 rounded-lg
               shadow-sm hover:shadow-md transition-all duration-200
               focus:ring-2 focus:ring-primary-600 focus:ring-offset-2">
    {{ $slot }}
</button>
```

**Card Component Pattern:**
```blade
{{-- Card --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100
            hover:shadow-md transition-shadow duration-200">
    @if(isset($header))
        <div class="bg-gradient-to-r from-primary-600 to-primary-700
                    px-5 py-4 text-white border-b border-primary-700/20">
            {{ $header }}
        </div>
    @endif
    <div class="p-5">{{ $slot }}</div>
</div>
```

**Form Input Pattern:**
```blade
{{-- Text Input --}}
<input type="{{ $type ?? 'text' }}"
       name="{{ $name }}"
       value="{{ old($name, $value ?? '') }}"
       class="w-full bg-white border border-gray-200
              hover:border-gray-300
              focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
              rounded-lg px-3.5 py-2.5 text-sm text-gray-900
              placeholder:text-gray-400
              transition-all duration-200">
```

All components are stateless and rely on Blade template composition and Tailwind utilities. No custom Vue/React components needed.

## Data Models

**No database changes are required** for this UI modernization. All existing models remain unchanged:

**Existing Models (read-only for UI):**
- `Alumni`: User data, profile information
- `DataAkademik`: Academic records
- `RiwayatPekerjaan`: Employment history
- `RiwayatPendidikan`: Education history
- `RiwayatWirausaha`: Entrepreneurship history
- `Kuesioner`: Questionnaire definitions
- `PertanyaanKuesioner`: Questions
- `JawabanKuesioner`: Responses
- `Admin`: Admin user accounts

**View Models (data passed to views):**

**Alumni Dashboard:**
```php
[
    'alumni' => Alumni with relationships (dataAkademik),
    'foto' => Storage URL or null,
    'updated_at' => Carbon timestamp
]
```

**Career Journey:**
```php
[
    'alumni' => Alumni with eager-loaded relationships,
    'riwayatPekerjaan' => Collection<RiwayatPekerjaan>,
    'riwayatPendidikan' => Collection<RiwayatPendidikan>,
    'riwayatWirausaha' => Collection<RiwayatWirausaha>
]
```

**Admin Dashboard:**
```php
[
    'totalAlumni' => int,
    'totalIsi' => int (responses),
    'totalBelumIsi' => int,
    'kuesionerAktif' => Kuesioner|null,
    'alumniTerbaru' => Collection<Alumni> (paginated)
]
```

**Questionnaire Management:**
```php
[
    'kuesioner' => Kuesioner with pertanyaan relationship,
    'pertanyaan' => Collection<PertanyaanKuesioner>,
    'jawaban' => Collection<JawabanKuesioner> grouped by alumni
]
```

All data transformations happen in existing controllers. Views only receive formatted data for display.

---

## 1. Design System

### 1.1 Color Palette

**Primary Colors:**
- `--color-primary-50`: `#f0f9f1` — Lightest green background
- `--color-primary-100`: `#d9f2dc` — Light green highlights
- `--color-primary-600`: `#1B5E20` — Primary brand green (existing)
- `--color-primary-700`: `#154a18` — Hover state for primary green
- `--color-primary-800`: `#0f3812` — Active/pressed state

**Neutral Grays:**
- `--color-gray-50`: `#fafafa` — Card/section backgrounds
- `--color-gray-100`: `#f5f5f5` — Subtle borders, dividers
- `--color-gray-200`: `#e5e5e5` — Input borders
- `--color-gray-300`: `#d4d4d4` — Disabled states
- `--color-gray-400`: `#a3a3a3` — Placeholder text, helper text
- `--color-gray-500`: `#737373` — Secondary text
- `--color-gray-600`: `#525252` — Body text
- `--color-gray-700`: `#404040` — Headings
- `--color-gray-800`: `#262626` — Primary text
- `--color-gray-900`: `#171717` — Darkest text

**Semantic Colors:**
- **Success**: `#10b981` (green-500) — Success messages, positive states
- **Warning**: `#f59e0b` (amber-500) — Warning messages, pending states
- **Danger**: `#ef4444` (red-500) — Error messages, destructive actions
- **Info**: `#3b82f6` (blue-500) — Informational messages

**Implementation via Tailwind:**
Use existing Tailwind color classes: `bg-gray-50`, `text-primary-600`, `border-gray-200`, etc.

### 1.2 Typography Scale

**Font Family:** Instrument Sans (already configured in @theme)

**Type Scale:**
- **Heading 1**: `text-2xl` (24px), `font-bold`, `leading-tight` (1.25), `text-gray-900`
- **Heading 2**: `text-xl` (20px), `font-bold`, `leading-tight`, `text-gray-800`
- **Heading 3**: `text-lg` (18px), `font-semibold`, `leading-snug` (1.375), `text-gray-800`
- **Heading 4**: `text-base` (16px), `font-semibold`, `leading-snug`, `text-gray-700`
- **Body Large**: `text-base` (16px), `font-normal`, `leading-normal` (1.5), `text-gray-700`
- **Body**: `text-sm` (14px), `font-normal`, `leading-normal`, `text-gray-600`
- **Small**: `text-xs` (12px), `font-normal`, `leading-normal`, `text-gray-500`
- **Caption**: `text-[10px]`, `font-normal`, `leading-tight`, `text-gray-400`, `uppercase`, `tracking-wider`

**Label Styling:**
- Form labels: `text-sm`, `font-medium`, `text-gray-700`, `mb-1.5`
- Section labels: `text-xs`, `font-bold`, `text-primary-600`, `uppercase`, `tracking-wide`

### 1.3 Spacing Scale

Use Tailwind's default spacing scale consistently:
- **Card padding**: `p-5` (20px) or `p-6` (24px) for larger sections
- **Section gaps**: `gap-4` (16px) or `gap-6` (24px)
- **Element spacing**: `space-y-3` (12px) for lists, `space-y-4` (16px) for form fields
- **Container margins**: `mb-4`, `mb-5`, `mb-6` based on hierarchy

### 1.4 Shadow Levels

**Elevation System:**
- **Level 0 (flat)**: `shadow-none` — No elevation, same plane
- **Level 1 (raised)**: `shadow-sm` — Subtle lift (cards at rest)
- **Level 2 (floating)**: `shadow-md` — Clear separation (hover states, dropdowns)
- **Level 3 (modal)**: `shadow-lg` — Strong elevation (modals, popovers)
- **Level 4 (overlay)**: `shadow-xl` — Maximum depth (tooltips, notifications)

**Interactive shadows:**
- Cards: `shadow-sm` at rest → `shadow-md` on hover
- Buttons: `shadow-none` at rest → `shadow-sm` on hover (subtle)
- Modals: `shadow-xl` always

### 1.5 Border Radius Scale

**Consistency:**
- **Small elements**: `rounded` (4px) — badges, pills, tags
- **Medium elements**: `rounded-lg` (8px) — buttons, inputs, small cards
- **Large elements**: `rounded-xl` (12px) — main cards, sections, modals
- **Circular**: `rounded-full` — avatars, icon containers
- **Top-only rounding**: `rounded-t-xl` for card headers

### 1.6 Animation & Transition System

**Timing Functions:**
- **Quick interactions**: `duration-200` (200ms), `ease-in-out`
- **Standard interactions**: `duration-300` (300ms), `ease-in-out`
- **Heavy animations**: `duration-500` (500ms), `ease-in-out`

**Default transition class:**
`transition-all duration-200 ease-in-out`

**Common transitions:**
- Hover scale: `hover:scale-[1.02]`
- Hover shadow: `hover:shadow-md`
- Hover translate: `hover:-translate-y-0.5`
- Focus ring: `focus:ring-2 focus:ring-primary-600 focus:ring-offset-1`
- Background change: `transition-colors duration-200`

---

## 2. Component Library

### 2.1 Buttons

**Primary Button:**
```
bg-primary-600 hover:bg-primary-700 active:bg-primary-800
text-white font-semibold
px-4 py-2 (small) | px-5 py-2.5 (medium) | px-6 py-3 (large)
rounded-lg
shadow-sm hover:shadow-md
transition-all duration-200
focus:ring-2 focus:ring-primary-600 focus:ring-offset-2
```

**Secondary Button:**
```
bg-white hover:bg-gray-50 active:bg-gray-100
text-gray-700 font-medium
border border-gray-300 hover:border-gray-400
px-4 py-2 rounded-lg
shadow-sm hover:shadow-md
transition-all duration-200
focus:ring-2 focus:ring-gray-400 focus:ring-offset-2
```

**Danger Button:**
```
bg-red-500 hover:bg-red-600 active:bg-red-700
text-white font-semibold
px-4 py-2 rounded-lg
shadow-sm hover:shadow-md
transition-all duration-200
focus:ring-2 focus:ring-red-500 focus:ring-offset-2
```

**Ghost Button (text only):**
```
text-primary-600 hover:text-primary-700
font-medium
px-3 py-1.5
rounded hover:bg-primary-50
transition-colors duration-200
```

**Icon Button:**
```
w-9 h-9 rounded-lg
flex items-center justify-center
hover:bg-gray-100 active:bg-gray-200
text-gray-600 hover:text-gray-900
transition-all duration-200
```

### 2.2 Cards

**Default Card:**
```
bg-white rounded-xl shadow-sm
hover:shadow-md transition-shadow duration-200
border border-gray-100
overflow-hidden
```

**Card Header:**
```
bg-gradient-to-r from-primary-600 to-primary-700
px-5 py-4 | px-6 py-5 (larger)
text-white
border-b border-primary-700/20
```

**Card Body:**
```
p-5 | p-6 (larger sections)
```

**Card Footer:**
```
px-5 py-3 | px-6 py-4 (larger)
bg-gray-50 border-t border-gray-100
```

**Interactive Card (clickable):**
Add: `cursor-pointer hover:scale-[1.01] hover:-translate-y-0.5`

### 2.3 Forms

**Text Input:**
```
w-full
bg-white border border-gray-200
hover:border-gray-300
focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
rounded-lg px-3.5 py-2.5
text-sm text-gray-900 placeholder:text-gray-400
transition-all duration-200
disabled:bg-gray-100 disabled:text-gray-500 disabled:cursor-not-allowed
```

**Textarea:**
Same as text input, add `resize-none` or `resize-y`

**Select:**
```
w-full
bg-white border border-gray-200
hover:border-gray-300
focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
rounded-lg px-3.5 py-2.5
text-sm text-gray-900
appearance-none
bg-[url('data:image/svg+xml;base64,...')] bg-no-repeat bg-right-3 bg-[length:1.25rem]
transition-all duration-200
```

**Checkbox:**
```
w-4 h-4 rounded
text-primary-600
border-gray-300 focus:ring-primary-600 focus:ring-offset-0
transition-colors duration-200
```

**Radio:**
```
w-4 h-4
text-primary-600
border-gray-300 focus:ring-primary-600 focus:ring-offset-0
transition-colors duration-200
```

**File Input:**
```
text-sm text-gray-600
file:mr-3 file:py-2 file:px-4
file:rounded-lg file:border-0
file:text-sm file:font-medium
file:bg-primary-50 file:text-primary-700
hover:file:bg-primary-100
cursor-pointer
transition-all duration-200
```

**Form Label:**
```
block text-sm font-medium text-gray-700 mb-1.5
```

**Helper Text:**
```
text-xs text-gray-500 mt-1
```

**Error Message:**
```
text-xs text-red-600 mt-1 flex items-center gap-1
```

### 2.4 Tables

**Table Container:**
```
bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden
```

**Table:**
```
w-full text-sm text-left
```

**Table Header:**
```
bg-gray-50 border-b border-gray-200
text-xs font-semibold text-gray-600 uppercase tracking-wider
```

**Table Header Cell:**
```
px-5 py-3.5
```

**Table Row:**
```
border-b border-gray-100 last:border-0
hover:bg-gray-50
transition-colors duration-150
```

**Table Cell:**
```
px-5 py-4 text-gray-700
```

**Striped rows:** Add `odd:bg-white even:bg-gray-50` to `<tr>`

### 2.5 Badges & Pills

**Badge (status indicator):**
```
inline-flex items-center gap-1
px-2.5 py-0.5
rounded-full
text-xs font-medium
```

**Color variants:**
- Success: `bg-green-100 text-green-800`
- Warning: `bg-amber-100 text-amber-800`
- Danger: `bg-red-100 text-red-800`
- Info: `bg-blue-100 text-blue-800`
- Neutral: `bg-gray-100 text-gray-700`

**With dot indicator:**
Add `<span class="w-1.5 h-1.5 rounded-full bg-current"></span>` before text

### 2.6 Alerts & Flash Messages

**Success Alert:**
```
bg-green-50 border-l-4 border-green-500 rounded-r-lg
px-4 py-3
flex items-start gap-3
shadow-sm
```
Content: `text-sm text-green-800`, Icon: `text-green-500`

**Info Alert:**
```
bg-blue-50 border-l-4 border-blue-500 rounded-r-lg
px-4 py-3 flex items-start gap-3 shadow-sm
```

**Warning Alert:**
```
bg-amber-50 border-l-4 border-amber-500 rounded-r-lg
px-4 py-3 flex items-start gap-3 shadow-sm
```

**Error Alert:**
```
bg-red-50 border-l-4 border-red-500 rounded-r-lg
px-4 py-3 flex items-start gap-3 shadow-sm
```

**Dismissible:** Add close button with `hover:bg-opacity-20 rounded p-1 transition-colors`

### 2.7 Loading States

**Spinner (inline):**
```html
<svg class="animate-spin h-5 w-5 text-primary-600" fill="none" viewBox="0 0 24 24">
  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
</svg>
```

**Button loading state:**
```html
<button disabled class="relative opacity-75 cursor-not-allowed">
  <span class="invisible">Save</span>
  <svg class="animate-spin absolute inset-0 m-auto h-5 w-5" ...>...</svg>
</button>
```

**Skeleton loader (for content):**
```
bg-gray-200 animate-pulse rounded
h-4 w-full (for text lines)
h-48 w-full (for images/cards)
```

### 2.8 Empty States

**Empty state container:**
```
text-center py-12 px-6
```

**Icon:**
```
w-16 h-16 mx-auto mb-4 text-gray-300
```

**Heading:**
```
text-lg font-semibold text-gray-700 mb-2
```

**Description:**
```
text-sm text-gray-500 mb-6 max-w-md mx-auto
```

**Action button:** Primary button

### 2.9 Modals

**Modal Overlay:**
```
fixed inset-0 z-50
bg-black/50 backdrop-blur-sm
flex items-center justify-center
p-4
transition-opacity duration-200
```

**Modal Container:**
```
bg-white rounded-xl shadow-xl
max-w-2xl w-full max-h-[90vh]
overflow-hidden
transform transition-all duration-200
scale-95 opacity-0 (initial)
scale-100 opacity-100 (shown)
```

**Modal Header:**
```
px-6 py-4 border-b border-gray-100
flex items-center justify-between
```

**Modal Body:**
```
px-6 py-5 overflow-y-auto max-h-[60vh]
```

**Modal Footer:**
```
px-6 py-4 bg-gray-50 border-t border-gray-100
flex justify-end gap-3
```

**Close button:**
Icon button with `hover:bg-gray-100`

---

## 3. Layout Patterns

### 3.1 Alumni Portal Layout

**Structure:**
- Fixed header (sticky at top)
- Collapsible sidebar (fixed on desktop, slide-in on mobile)
- Main content area (scrollable)

**Header:**
- Height: `h-14` (56px)
- Background: `bg-white`
- Border: `border-b-2 border-primary-600`
- Shadow: `shadow-sm`
- Items: Logo + title (left), system name (right), hamburger (mobile only)

**Sidebar:**
- Width: `w-56` (224px) on desktop
- Background: `bg-gradient-to-b from-primary-600 to-primary-700`
- Position: `fixed lg:sticky`, `top-14`
- Height: `h-[calc(100vh-3.5rem)]`
- Transform: `-translate-x-full lg:translate-x-0` (mobile hidden by default)
- Transition: `transition-transform duration-200 ease-in-out`

**Sidebar Items:**
- Default: `text-white/90 hover:bg-white/10`
- Active: `bg-white text-primary-600 font-semibold`
- Padding: `px-4 py-3`
- Rounded: `rounded-lg mx-2 my-1`
- Icon container: `w-8 h-8 rounded-full flex items-center justify-center`
  - Default: `bg-white/10`
  - Active: `bg-primary-600`
- Transition: `transition-all duration-200`
- Hover effect: `hover:translate-x-1`

**Main Content:**
- Padding: `px-4 py-5 lg:px-6 lg:py-6`
- Max width: `max-w-7xl mx-auto` (for very wide screens)
- Background: `bg-gray-50`

**Mobile Overlay:**
- `fixed inset-0 z-20 bg-black/40 backdrop-blur-sm`
- Hidden by default: `hidden lg:hidden`
- Shown when sidebar open

### 3.2 Admin Panel Layout

**Structure:**
- Header bar (fixed at top)
- Sidebar (fixed, narrow)
- Main content (wide area)

**Header:**
- Height: `h-16` (64px)
- Background: `bg-gradient-to-r from-primary-600 to-primary-700`
- Shadow: `shadow-md`
- Content: Logo + title (left), admin name + logout (right)
- Text: `text-white`

**Sidebar:**
- Width: `w-64` (256px)
- Background: `bg-white`
- Shadow: `shadow-lg`
- Border: `border-r border-gray-100`
- Position: `fixed`, `top-16`
- Height: `h-[calc(100vh-4rem)]`

**Sidebar Items:**
- Default: `text-gray-700 hover:bg-primary-50 hover:text-primary-700`
- Active: `bg-primary-50 text-primary-700 font-semibold border-l-4 border-primary-600`
- Padding: `px-4 py-3`
- Transition: `transition-all duration-200`
- Hover effect: `hover:translate-x-1`

**Main Content:**
- Margin left: `ml-64` (sidebar width)
- Padding: `px-6 py-6`
- Background: `bg-gray-50`
- Min height: `min-h-[calc(100vh-4rem)]`

**Responsive (mobile):**
- Header: stack content vertically if needed
- Sidebar: convert to slide-in menu (same as alumni)
- Main: remove left margin

### 3.3 Responsive Breakpoints

**Mobile-first approach:**
- **Default (mobile)**: < 640px — Single column, stacked layout
- **sm**: 640px — 2 columns for forms, grid cards
- **md**: 768px — Side-by-side forms, wider modals
- **lg**: 1024px — Full desktop layout, sidebar visible
- **xl**: 1280px — Max widths engaged, spacious layout

**Common patterns:**
- Cards: `grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4`
- Forms: `grid grid-cols-1 md:grid-cols-2 gap-5`
- Stats: `grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4`

---

## 4. Page-Specific Designs

### 4.1 Alumni Dashboard (`dashboard/index.blade.php`)

**Structure:**
- Full-width card with gradient header
- 3-column layout (desktop) / stacked (mobile)
- Photo + contact (left), Academic info (center), Personal info (right)

**Design changes:**
- Card: `rounded-xl shadow-md border border-gray-100`
- Header: Remove dark green, use subtle gradient `bg-gradient-to-br from-primary-50 to-white`
- Photo section:
  - Avatar: `ring-4 ring-primary-100` instead of border
  - Social icons: Modern icon buttons with `hover:scale-110`
- Info sections:
  - Labels: `text-xs font-semibold text-primary-700 uppercase tracking-wider`
  - Values: `text-sm text-gray-800`
  - Dividers: `border-gray-100`
- Footer:
  - Timestamp: `text-[10px] text-gray-400`
  - Edit button: Primary button with icon, `flex items-center gap-2`
- Hover effects: Whole card subtle `hover:shadow-lg`

### 4.2 Profile Edit (`profile/edit.blade.php`)

**Structure:**
- Form card with header
- 2-column grid (desktop) / stacked (mobile)
- Grouped sections with visual hierarchy

**Design changes:**
- Card: `rounded-xl shadow-md`
- Header: Gradient `bg-gradient-to-r from-primary-600 to-primary-700` with icon
- Photo upload:
  - Preview: `ring-4 ring-primary-600 shadow-md`
  - Upload area: Dashed border `border-2 border-dashed border-gray-300 hover:border-primary-400`
  - Drag-drop styling (optional JS enhancement)
- Section headers:
  - Style: `text-xs font-bold text-primary-600 uppercase tracking-wide mb-3`
  - Underline: `border-b-2 border-primary-100 pb-2`
- Form fields: Use updated input styles from component library
- Buttons:
  - Cancel: Secondary button
  - Submit: Primary button with `flex items-center gap-2` and save icon
- Validation errors: Styled alert at top with list

### 4.3 Career Journey (`karir/index.blade.php`)

**Structure:**
- 3-column layout (work, education, entrepreneurship)
- Timeline-style entries in each column
- Add buttons at bottom of each column

**Design changes:**
- Main card: `rounded-xl shadow-md`
- Header: Gradient with icon and description
- Columns: `divide-x divide-gray-200` on desktop
- Entry cards:
  - Style: `bg-gradient-to-br from-white to-gray-50 rounded-lg border border-gray-200 p-4`
  - Hover: `hover:shadow-md hover:border-gray-300 transition-all duration-200`
  - Timeline indicator: Left border `border-l-4 border-primary-500`
  - Badge for status: "Bekerja", "Sekarang" using success badge
- Dates: `text-xs text-gray-500` with calendar icon
- Position/title: `text-base font-semibold text-gray-900`
- Company: `text-sm text-gray-600`
- Action buttons:
  - Edit: Ghost button with pencil icon
  - Delete: Ghost danger button with trash icon
  - Row: `flex gap-2 mt-3 pt-3 border-t border-gray-100`
- Add button: Primary button, full width, with plus icon
- Empty state: Custom empty illustration with helpful text

### 4.4 Questionnaire List (`kuisioner/index.blade.php`)

**Structure:**
- Header with title and description
- List of available questionnaires (cards)
- Each card shows: title, period, status badge, action button

**Design changes:**
- Container: `max-w-4xl mx-auto`
- Header: Large heading with subtitle
- Questionnaire cards:
  - Style: `bg-white rounded-xl shadow-sm border border-gray-100 p-5`
  - Hover: `hover:shadow-md hover:border-primary-200 transition-all duration-200`
  - Layout: Flex between content and action
  - Title: `text-lg font-semibold text-gray-900`
  - Period: `text-sm text-gray-500` with clock icon
  - Status badge:
    - Active: Success badge
    - Completed: Neutral badge
    - Expired: Warning badge
  - Action button: Primary (if not filled) or secondary (if filled)
- Empty state: "No questionnaires available" with icon

### 4.5 Fill Questionnaire (`kuisioner/isi.blade.php`) - NEW

**Structure:**
- Progress indicator at top
- Question cards (one per question)
- Navigation (previous/next/submit)

**Design:**
- Progress bar:
  - Container: `h-2 bg-gray-200 rounded-full overflow-hidden mb-6`
  - Fill: `h-full bg-gradient-to-r from-primary-500 to-primary-600 transition-all duration-300`
  - Text: `text-sm text-gray-600 mb-2` — "Question 3 of 10"
- Question cards:
  - One visible at a time (JS toggle)
  - Style: `bg-white rounded-xl shadow-md p-6 mb-5`
  - Question number badge: `inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-600 text-white font-semibold text-sm`
  - Question text: `text-lg font-medium text-gray-900 mb-4`
  - Input types:
    - Text: Standard input
    - Textarea: `rows="4"`
    - Radio: Custom styled with checkmark
    - Checkbox: Custom styled
    - Select: Custom dropdown
- Navigation:
  - Container: `flex justify-between items-center mt-6`
  - Previous: Secondary button or disabled ghost
  - Next/Submit: Primary button with arrow icon
- Submit confirmation: Modal with summary

### 4.6 Admin Dashboard (`admin/dashboard.blade.php`)

**Structure:**
- Page title
- Stat cards (4 columns)
- Recent alumni table

**Design changes:**
- Page title: `text-2xl font-bold text-gray-900 mb-6`
- Stat cards:
  - Grid: `grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4`
  - Style: `bg-white rounded-xl shadow-sm border border-gray-100 p-5`
  - Hover: `hover:shadow-md hover:-translate-y-0.5 transition-all duration-200`
  - Icon: Large circular icon container `w-12 h-12 rounded-full bg-primary-100 text-primary-600 flex items-center justify-center mb-3`
  - Label: `text-xs text-gray-500 uppercase tracking-wide mb-1`
  - Value: `text-3xl font-bold text-gray-900`
  - Subtitle: `text-xs text-gray-400 mt-1`
- Recent alumni section:
  - Card: `bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden`
  - Header: `px-6 py-4 bg-gray-50 border-b border-gray-100 flex justify-between items-center`
  - Title: `text-lg font-semibold text-gray-900`
  - "View all" link: Ghost button
  - Table: Use table component styles
  - Rows: Hover effect with quick actions appearing

### 4.7 Alumni Management (`admin/alumni/index.blade.php`)

**Structure:**
- Page header with title + create button
- Search bar and filters
- Alumni table with pagination

**Design changes:**
- Header:
  - Flex between title and button
  - Title: H1 with count badge
  - Create button: Primary with plus icon
- Search section:
  - Card: `bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-5`
  - Search input: Full width with search icon inside
  - Filters: Dropdown selects inline (program, year, status)
- Table:
  - Full table component styles
  - Columns: Photo, NIM, Name, Program, Year, Status, Actions
  - Photo: Small avatar `w-10 h-10 rounded-full`
  - Status: Badge component
  - Actions: Icon buttons (view, edit, delete)
- Pagination:
  - Style: `flex items-center justify-between border-t border-gray-100 bg-white px-6 py-3 rounded-b-xl`
  - Buttons: Icon buttons with disabled states
- Empty state: "No alumni found" with illustration

### 4.8 Alumni Detail (`admin/alumni/show.blade.php`)

**Structure:**
- Back button
- Profile header (photo + key info)
- Tabbed sections (Profile, Academic, Career, Questionnaires)
- Action buttons (edit, reset password, delete)

**Design changes:**
- Back button: Ghost button with left arrow
- Profile card:
  - Large avatar: `w-24 h-24 rounded-full ring-4 ring-gray-200 shadow-md`
  - Name: `text-2xl font-bold text-gray-900`
  - NIM: `text-sm text-gray-500`
  - Contact badges: Row of icon + text badges
- Tabs:
  - Container: `border-b border-gray-200 mb-6`
  - Tab button: `px-4 py-3 text-sm font-medium text-gray-600 hover:text-gray-900 border-b-2 border-transparent hover:border-gray-300 transition-colors`
  - Active tab: `text-primary-600 border-primary-600 font-semibold`
- Content sections: Cards with proper spacing
- Action buttons:
  - Row: `flex gap-3 mt-6`
  - Edit: Primary button
  - Reset password: Secondary button
  - Delete: Danger button
  - Confirmation modals for destructive actions

### 4.9 Alumni Form (`admin/alumni/create.blade.php`, `admin/alumni/edit.blade.php`) - NEW

**Structure:**
- Form with multiple sections
- Step indicator (optional)
- Save/cancel buttons

**Design:**
- Form card: `bg-white rounded-xl shadow-md`
- Header: Gradient with title
- Sections:
  - Collapsible accordion OR visible sections with dividers
  - Section header: `text-sm font-bold text-primary-600 uppercase tracking-wide mb-4 pb-2 border-b-2 border-primary-100`
- Fields: 2-column grid on desktop
- Required indicator: `text-red-500` asterisk
- Buttons:
  - Sticky footer on mobile OR static at bottom
  - Cancel: Secondary
  - Save: Primary with icon

### 4.10 Questionnaire Management (`admin/kuesioner/index.blade.php`) - NEW

**Structure:**
- Header with create button
- Questionnaire cards (list)
- Each card: title, period, status toggle, manage questions link, monitoring link

**Design:**
- Create button: Primary with plus icon (top right)
- Questionnaire cards:
  - Grid: `grid grid-cols-1 lg:grid-cols-2 gap-5`
  - Style: `bg-white rounded-xl shadow-sm border border-gray-100 p-5`
  - Hover: `hover:shadow-md transition-all duration-200`
  - Header: Title + status toggle (switch component)
  - Period: Icon + text
  - Stats: Small stat row (responses count, questions count)
  - Actions row: Manage questions (ghost), View monitoring (ghost), Edit (icon), Delete (icon)
- Status toggle:
  - Switch component: `relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 transition-colors focus:ring-2 focus:ring-primary-600`
  - Active: `bg-primary-600`
  - Thumb: `h-5 w-5 rounded-full bg-white shadow transform transition-transform`

### 4.11 Questionnaire Form (`admin/kuesioner/create.blade.php`, `admin/kuesioner/edit.blade.php`) - NEW

**Structure:**
- Questionnaire details form
- Questions section (only in edit mode)
- Save button

**Design:**
- Two cards: Details card + Questions card (edit only)
- Details fields: Title, description, start date, end date
- Questions section:
  - List of questions with order, type, text
  - Drag handle icon for reordering (optional enhancement)
  - Edit/delete icons
  - Add question button at bottom
- Question types: Short text, long text, single choice, multiple choice, dropdown
- For choice types: Option management (add/remove)

### 4.12 Question Management (`admin/kuesioner/pertanyaan.blade.php`) - NEW

**Structure:**
- Question list
- Add question form/modal
- Edit question modal

**Design:**
- Question cards:
  - Each: `bg-white rounded-lg border border-gray-200 p-4 mb-3`
  - Order badge: Circle with number
  - Question text: `font-medium text-gray-900`
  - Type badge: Small neutral badge
  - Options preview (if applicable)
  - Actions: Edit, delete, reorder (drag handle)
- Add question:
  - Modal OR inline form at bottom
  - Fields: Order, type, question text, required toggle, options (conditional)
- Reordering: Drag-and-drop with visual feedback (optional JS enhancement)

### 4.13 Monitoring (`admin/kuesioner/monitoring.blade.php`) - NEW

**Structure:**
- Stats overview (completion rate)
- Alumni response table
- Filters (status: filled/not filled)

**Design:**
- Stats cards: 3 columns (total alumni, completed, pending)
- Filters: Tabs or segmented control
- Response table:
  - Columns: Alumni name, NIM, program, completion date, status, actions
  - Status: Badge (completed/pending)
  - Actions: View answers (if completed)
- Export button: Secondary button with download icon (top right)

### 4.14 Answer Detail (`admin/kuesioner/detail-jawaban.blade.php`) - NEW

**Structure:**
- Back button
- Alumni info header
- Question-answer pairs (read-only)

**Design:**
- Back button: Ghost with left arrow
- Alumni header: Same as detail page (avatar + name + NIM)
- Q&A cards:
  - Each: `bg-white rounded-lg border border-gray-100 p-5 mb-4`
  - Question: `text-sm font-semibold text-gray-700 mb-2`
  - Answer: `text-base text-gray-900` or `text-gray-400 italic` (if empty)
  - For choice questions: Show selected option(s) with checkmark icon
- Print button: Secondary button (top right) for printing responses

---

## 5. Animation & Interaction Patterns

### 5.1 Hover Effects

**Cards:**
```
hover:shadow-md hover:-translate-y-0.5 transition-all duration-200
```

**Buttons:**
```
hover:shadow-md hover:scale-[1.02] transition-all duration-200
```

**Links:**
```
hover:text-primary-700 transition-colors duration-150
```

**Table rows:**
```
hover:bg-gray-50 transition-colors duration-150
```

**Sidebar items:**
```
hover:bg-white/10 hover:translate-x-1 transition-all duration-200
```

**Icon buttons:**
```
hover:bg-gray-100 hover:scale-110 transition-all duration-200
```

### 5.2 Focus States

**All interactive elements:**
```
focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-1
transition-all duration-200
```

**Form inputs:**
```
focus:border-primary-600 focus:ring-2 focus:ring-primary-600/20
```

### 5.3 Loading States

**Button loading:**
- Add spinner inside button
- Disable button: `disabled:opacity-75 disabled:cursor-not-allowed`
- Optional: Add loading text "Saving..."

**Page loading:**
- Skeleton loaders for content areas
- Fade in when content appears: `opacity-0` → `opacity-100` with `transition-opacity duration-300`

**Data fetching:**
- Show spinner in data area
- Or pulse animation on skeleton

### 5.4 Transition Timings

**Quick (200ms):**
- Color changes (hover, focus)
- Small transforms (scale, translate)
- Icon rotations

**Standard (300ms):**
- Shadow changes
- Modal/overlay appearances
- Sidebar slide-in
- Content fades

**Slow (500ms):**
- Page transitions
- Complex animations
- Multi-step transformations

### 5.5 Micro-interactions

**Form submission:**
1. Button shows loading spinner
2. Success: Button shows checkmark with green background (1s)
3. Redirect or show success message

**Delete confirmation:**
1. Click delete → Modal fades in (300ms)
2. Confirm → Modal shakes slightly (200ms)
3. Delete executes → Item fades out (300ms)
4. List re-flows smoothly

**Toggle switch:**
1. Click → Thumb slides (200ms)
2. Background color changes (200ms)
3. Optional: Haptic-like bounce (scale animation)

**Drag and drop (reordering):**
1. Grab: Item lifts (scale + shadow)
2. Drag: Item follows cursor
3. Drop: Item settles into new position (300ms ease-out)
4. List items shift smoothly

**Search input:**
1. Focus: Border animates to primary color, icon changes color
2. Type: Debounced search after 300ms
3. Results: Fade in with stagger (each item delays 50ms)

**Tooltip/Popover:**
1. Hover: Delay 300ms
2. Appear: Fade + scale from 95% to 100% (150ms)
3. Disappear: Fade out (100ms)

---

## 6. Technical Implementation Notes

### 6.1 Tailwind CSS 4 Considerations

- All styles use Tailwind utility classes
- Custom colors defined in @theme (already done for font)
- No custom CSS classes except for complex animations if needed
- Use arbitrary values sparingly: `w-[42px]`, `text-[10px]`

### 6.2 Responsive Design Approach

- Mobile-first: Start with mobile styles, add `md:`, `lg:` prefixes
- Breakpoints: Use Tailwind defaults (sm: 640px, md: 768px, lg: 1024px, xl: 1280px)
- Touch targets: Minimum 44×44px on mobile
- Font sizes: Slightly larger on mobile for readability

### 6.3 JavaScript Requirements

**Minimal JS for:**
- Sidebar toggle (mobile)
- Modal open/close
- Form validation (browser default + optional custom)
- Tab switching
- File upload preview
- Dropdown menus (if not using <details>)
- Optional: Drag-and-drop reordering
- Optional: Debounced search

**No framework needed** — vanilla JS with event listeners

### 6.4 Accessibility

- Semantic HTML: Use `<nav>`, `<main>`, `<article>`, `<section>`
- ARIA labels on icon-only buttons
- Focus visible states
- Keyboard navigation (tab order)
- Screen reader text for icons: `<span class="sr-only">Delete</span>`
- Form labels properly associated
- Color contrast: Ensure WCAG AA (4.5:1 for text)

### 6.5 Performance

- Lazy load images where applicable
- Minimize repaints: Use `transform` and `opacity` for animations
- Debounce expensive operations (search, API calls)
- Pagination for large lists
- Avoid layout shifts: Reserve space for dynamic content

### 6.6 Browser Support

- Modern browsers (last 2 versions)
- Chrome, Firefox, Safari, Edge
- Graceful degradation for older browsers (no animations, but functional)

---

## 7. Design Deliverables Summary

This design document provides:

1. ✅ **Complete design system**: Colors, typography, spacing, shadows, borders, animations
2. ✅ **Component library**: 9 categories of reusable components with full specifications
3. ✅ **Layout patterns**: Alumni portal and admin panel layouts with responsive behavior
4. ✅ **Page-specific designs**: 14 views with detailed structural and styling specifications
5. ✅ **Animation patterns**: Hover, focus, loading, and micro-interaction specifications
6. ✅ **Technical notes**: Implementation guidelines for Tailwind CSS 4, accessibility, performance

**Next step**: Generate implementation tasks that reference this design document for each view and component.

---

## Appendix: Color Reference (Tailwind Classes)

**Primary (Green):**
- `bg-primary-50` / `text-primary-50`
- `bg-primary-600` / `text-primary-600` ← Main brand color
- `bg-primary-700` / `text-primary-700` ← Hover
- `bg-primary-800` / `text-primary-800` ← Active

**Note:** Use Tailwind's default green scale if custom primary not configured:
- `bg-green-50` → `#f0fdf4`
- `bg-green-600` → `#16a34a`
- `bg-green-700` → `#15803d`

**For this project, continue using `#1B5E20` as the primary green:**
- Use as custom value: `bg-[#1B5E20]`
- Or configure in Tailwind theme

**Grays:** Use Tailwind's default gray scale (`gray-50` through `gray-900`)

**Semantic:** Use Tailwind's default colors (`green-500`, `amber-500`, `red-500`, `blue-500`)

---

## Error Handling

**UI Error States:**

**Form Validation Errors:**
- Display above form: `bg-red-50 border-l-4 border-red-500 px-4 py-3`
- Inline field errors: `text-xs text-red-600 mt-1 flex items-center gap-1`
- Invalid input styling: `border-red-500 focus:ring-red-500`

**Network Errors:**
- Show dismissible alert at top of content area
- Retry button for failed requests
- Loading states prevent multiple submissions

**Not Found / Empty States:**
- Centered icon + message + optional action button
- Helpful guidance for user next steps

**Permission Errors:**
- Redirect to appropriate page with flash message
- No sensitive information exposed

**Backend errors are handled by existing Laravel validation and error handling** — UI only displays formatted errors.

## Testing Strategy

**Manual Visual Testing:**
- Each view tested on mobile (375px), tablet (768px), desktop (1280px)
- Hover states verified on desktop
- Focus states verified via keyboard navigation
- Animation smoothness checked (no jank)

**Cross-Browser Testing:**
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile Safari (iOS)
- Chrome Mobile (Android)

**Accessibility Testing:**
- Keyboard navigation (tab order, focus visible)
- Screen reader testing (NVDA/VoiceOver on key flows)
- Color contrast verification (WCAG AA 4.5:1 for text)
- Touch target sizes (minimum 44×44px)

**Performance Testing:**
- Lighthouse audit (Performance, Accessibility scores)
- Animation performance (60fps, no layout thrashing)
- Image optimization (compressed, lazy-loaded)

**Regression Testing:**
- All existing functionality still works
- Forms submit correctly
- Data displays accurately
- Routes navigate properly

**No unit tests required** — this is a pure UI/styling change with no logic changes.

---

## Correctness Properties

**Note:** This is a UI/UX redesign with no business logic changes. Properties validate visual and interaction correctness.

### Property 1: Visual Consistency

*For any* two components of the same type (button, card, input), their styling properties SHALL be identical according to the design system specifications.

**Validates:** Design system compliance across all 18+ views

### Property 2: Responsive Layout Integrity

*For any* viewport width between 320px and 2560px, all content SHALL remain readable, accessible, and properly laid out without horizontal scrolling.

**Validates:** Mobile-first responsive design requirements

### Property 3: Animation Smoothness

*For any* interactive element with transitions, the animation duration SHALL be between 150ms and 500ms and SHALL maintain 60fps performance.

**Validates:** Smooth micro-interactions and transition requirements

### Property 4: Accessibility Compliance

*For any* interactive element, it SHALL have appropriate ARIA labels, keyboard focus states, and minimum touch target sizes of 44×44px.

**Validates:** WCAG AA accessibility requirements

### Property 5: Color Contrast

*For any* text element, the color contrast ratio against its background SHALL meet WCAG AA standards (minimum 4.5:1 for normal text, 3:1 for large text).

**Validates:** Readability and accessibility requirements

### Property 6: Component Reusability

*For any* component pattern defined in the design system, it SHALL be implemented identically wherever that component type appears across all views.

**Validates:** Consistent user experience across alumni and admin portals

### Property 7: Loading State Visibility

*For any* form submission or data-fetching operation, a loading indicator SHALL be visible within 100ms of initiation.

**Validates:** User feedback during asynchronous operations

### Property 8: Focus Management

*For any* modal or overlay opened, keyboard focus SHALL move to the modal and trap within it until closed, then return to the triggering element.

**Validates:** Keyboard accessibility in interactive overlays

---

## 1. Design System
