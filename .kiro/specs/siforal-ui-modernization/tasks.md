# Implementation Plan: SIFORAL UI/UX Modernization

## Overview

This plan modernizes all SIFORAL views with a consistent, modern design system based on Tailwind CSS 4 utilities. Each task implements the designs specified in `design.md` and includes visual verification.

**Tech Stack:**
- Laravel 11 + Blade templates
- Tailwind CSS 4 (@theme configuration)
- Vanilla JavaScript for interactions
- Instrument Sans font

**Implementation Approach:**
- Start with shared layouts and component patterns
- Move to alumni portal views
- Finish with admin panel views
- Test responsive behavior at each step

---

## Tasks

- [-] 1. Update base CSS configuration and shared utilities
  - Add custom color configuration to `resources/css/app.css` using @theme
  - Configure primary green (#1B5E20) and color scale
  - Add transition utility defaults
  - Verify Tailwind compilation works
  - _Design ref: Section 1 (Design System)_

- [~] 2. Modernize alumni layout (`resources/views/layouts/app.blade.php`)
  - Update header styling: shadow-sm, refined logo placement
  - Modernize sidebar: gradient background, smooth transitions, hover effects
  - Implement active state with proper highlighting and icons
  - Polish mobile overlay and hamburger button
  - Add smooth slide-in animation for mobile sidebar
  - Update flash message styling (success/info alerts)
  - Verify responsive behavior (mobile, tablet, desktop)
  - _Design ref: Section 3.1 (Alumni Portal Layout), Section 2.6 (Alerts)_

- [~] 3. Modernize alumni dashboard (`resources/views/dashboard/index.blade.php`)
  - Update card container: rounded-xl, shadow-md
  - Refine 3-column layout with better spacing
  - Style photo section: ring-4, modern social icons
  - Update information sections: improved typography, cleaner labels
  - Style footer: better timestamp and edit button
  - Add subtle hover effects on entire card
  - Verify responsive behavior (columns stack on mobile)
  - _Design ref: Section 4.1 (Alumni Dashboard)_

- [~] 4. Modernize profile edit form (`resources/views/profile/edit.blade.php`)
  - Update card: rounded-xl, shadow-md
  - Style form header with gradient
  - Modernize photo upload section: ring-4, dashed border on upload area
  - Update all form inputs: focus states, transitions, consistent padding
  - Style section headers: uppercase, tracking-wide, border-b-2
  - Update select dropdowns: custom styling
  - Modernize buttons: primary/secondary styles with transitions
  - Style validation errors: improved alert
  - Verify responsive 2-column layout
  - _Design ref: Section 4.2 (Profile Edit), Section 2.3 (Forms)_

- [~] 5. Modernize career journey page (`resources/views/karir/index.blade.php`)
  - Update main card: rounded-xl, shadow-md
  - Style header with gradient and description
  - Modernize 3-column layout with better dividers
  - Update entry cards: gradient backgrounds, border-l-4 timeline indicators
  - Add hover effects to entry cards
  - Style status badges (Bekerja, Sekarang)
  - Modernize action buttons (edit/delete): ghost buttons with icons
  - Style "Add" buttons: full-width primary with icons
  - Add empty states for each column
  - Verify responsive (columns stack on mobile)
  - _Design ref: Section 4.3 (Career Journey), Section 2.1 (Buttons), Section 2.5 (Badges)_

- [~] 6. Update career modals (existing modal files)
  - Modernize modal overlay: backdrop-blur-sm
  - Update modal container: rounded-xl, shadow-xl
  - Style modal headers, bodies, and footers consistently
  - Update form inputs inside modals
  - Add smooth open/close transitions
  - Improve close button styling
  - Test all three modals (pekerjaan, pendidikan, wirausaha)
  - _Design ref: Section 2.9 (Modals)_

- [~] 7. Modernize questionnaire list (`resources/views/kuisioner/index.blade.php`)
  - Update page header: better typography hierarchy
  - Create questionnaire cards with hover effects
  - Add status badges (active/completed/expired)
  - Style action buttons contextually
  - Add empty state illustration
  - Add period display with clock icon
  - Verify responsive card layout
  - _Design ref: Section 4.4 (Questionnaire List), Section 2.2 (Cards)_

- [~] 8. Create fill questionnaire view (`resources/views/kuisioner/isi.blade.php`)
  - Build progress indicator bar at top
  - Create question card design
  - Style question number badges
  - Implement different input types: text, textarea, radio, checkbox, select
  - Add navigation buttons (previous/next/submit)
  - Create JS for question navigation
  - Build submit confirmation modal
  - Add form validation styling
  - Test all question types
  - _Design ref: Section 4.5 (Fill Questionnaire), Section 2.3 (Forms)_

- [~] 9. Checkpoint - Test alumni portal
  - Ensure all alumni pages render correctly
  - Test responsive behavior on mobile/tablet/desktop
  - Verify all forms work (profile edit, career management, questionnaire)
  - Check animations and transitions are smooth (200-300ms)
  - Test sidebar toggle on mobile
  - Verify accessibility (keyboard navigation, focus states)

- [~] 10. Modernize admin layout (`resources/views/layouts/admin.blade.php`)
  - Update top header: gradient background, refined styling
  - Modernize sidebar: white background, shadow-lg, better borders
  - Update sidebar items: active states with border-l-4, hover translate
  - Style admin name and logout button in header
  - Add smooth transitions to all interactive elements
  - Verify responsive behavior (mobile menu)
  - _Design ref: Section 3.2 (Admin Panel Layout)_

- [~] 11. Modernize admin dashboard (`resources/views/admin/dashboard.blade.php`)
  - Update page title styling
  - Create modern stat cards: circular icons, hover effects, translations
  - Style recent alumni section: refined table with hover states
  - Add icon containers for stats
  - Implement hover effects on stat cards (scale, translate)
  - Update "View all" link styling
  - Verify 4-column responsive grid
  - _Design ref: Section 4.6 (Admin Dashboard), Section 2.4 (Tables)_

- [~] 12. Modernize alumni index table (`resources/views/admin/alumni/index.blade.php`)
  - Update page header: title with count badge, create button
  - Build search/filter card: search input with icon, filter dropdowns
  - Modernize table: proper headers, hover states on rows
  - Add avatar column with rounded images
  - Style status badges in table
  - Create icon buttons for actions (view/edit/delete)
  - Update pagination styling
  - Add empty state
  - _Design ref: Section 4.7 (Alumni Management), Section 2.4 (Tables)_

- [~] 13. Modernize alumni detail page (`resources/views/admin/alumni/show.blade.php`)
  - Add back button with icon
  - Create profile header: large avatar with ring, name, NIM
  - Build contact badges row
  - Implement tab navigation: profile/academic/career/questionnaires
  - Style content sections in each tab
  - Update action buttons row: edit/reset password/delete
  - Create confirmation modals for destructive actions
  - _Design ref: Section 4.8 (Alumni Detail)_

- [~] 14. Create alumni edit form (`resources/views/admin/alumni/edit.blade.php`)
  - Build form card with gradient header
  - Create collapsible sections or visible sections with dividers
  - Style all form fields with 2-column grid
  - Add required field indicators
  - Style section headers consistently
  - Create sticky footer with cancel/save buttons
  - Add form validation styling
  - Test form submission
  - _Design ref: Section 4.9 (Alumni Form), Section 2.3 (Forms)_

- [~] 15. Create alumni create form (`resources/views/admin/alumni/create.blade.php`)
  - Similar structure to edit form
  - Add step indicator (optional)
  - Style initial password fields
  - Add helpful hints for required information
  - Test form submission and validation
  - _Design ref: Section 4.9 (Alumni Form)_

- [~] 16. Create questionnaire index (`resources/views/admin/kuesioner/index.blade.php`)
  - Add page header with create button
  - Build questionnaire cards in 2-column grid
  - Create status toggle switch component
  - Add stats row (response count, question count)
  - Style action buttons: manage questions, monitoring, edit, delete
  - Implement hover effects on cards
  - _Design ref: Section 4.10 (Questionnaire Management), Section 2.2 (Cards)_

- [~] 17. Create questionnaire create form (`resources/views/admin/kuesioner/create.blade.php`)
  - Build details form card
  - Style fields: title, description, period dates
  - Add date pickers styling
  - Create save button
  - Add form validation
  - _Design ref: Section 4.11 (Questionnaire Form)_

- [~] 18. Create questionnaire edit form (`resources/views/admin/kuesioner/edit.blade.php`)
  - Include details card (same as create)
  - Add questions section card
  - List existing questions with order, type, text
  - Add edit/delete icons for each question
  - Create "Add question" button
  - Add drag handles for reordering (optional)
  - _Design ref: Section 4.11 (Questionnaire Form)_

- [~] 19. Create question management view (`resources/views/admin/kuesioner/pertanyaan.blade.php`)
  - Build question list with order badges
  - Style question cards: type badge, question text, options preview
  - Create add question modal/form
  - Build question type selector
  - Add conditional options field (for choice types)
  - Implement reordering UI (drag-and-drop or up/down buttons)
  - Add edit/delete actions
  - _Design ref: Section 4.12 (Question Management)_

- [~] 20. Create monitoring view (`resources/views/admin/kuesioner/monitoring.blade.php`)
  - Build stats cards: total alumni, completed, pending
  - Create filter tabs (filled/not filled)
  - Build response table: alumni info, completion date, status badge
  - Add "View answers" action for completed responses
  - Create export button
  - Verify responsive table behavior
  - _Design ref: Section 4.13 (Monitoring), Section 2.4 (Tables)_

- [~] 21. Create answer detail view (`resources/views/admin/kuesioner/detail-jawaban.blade.php`)
  - Add back button
  - Create alumni info header (avatar + name + NIM)
  - Build Q&A cards: question text, answer text
  - Style empty answers (italic gray)
  - Add checkmarks for choice questions
  - Create print button
  - _Design ref: Section 4.14 (Answer Detail)_

- [~] 22. Implement loading states across all forms
  - Add spinner component
  - Update button loading states (spinner inside button)
  - Add skeleton loaders for data tables (optional)
  - Test form submissions show loading correctly
  - _Design ref: Section 2.7 (Loading States), Section 5.3_

- [~] 23. Add micro-interactions and polish
  - Implement form submission feedback (success checkmark animation)
  - Add tooltip animations (optional)
  - Polish delete confirmations (modal shake)
  - Add stagger animations for search results (optional)
  - Fine-tune all transition timings
  - _Design ref: Section 5.5 (Micro-interactions)_

- [~] 24. Accessibility improvements
  - Add ARIA labels to icon-only buttons
  - Ensure keyboard navigation works everywhere
  - Add sr-only text for screen readers on icons
  - Verify focus visible states are clear
  - Test color contrast ratios (WCAG AA)
  - Verify semantic HTML usage
  - _Design ref: Section 6.4 (Accessibility)_

- [~] 25. Final checkpoint - Complete system test
  - Test all alumni portal flows end-to-end
  - Test all admin panel flows end-to-end
  - Verify responsive behavior on actual devices (phone, tablet)
  - Check all animations are smooth (no jank)
  - Verify browser compatibility (Chrome, Firefox, Safari, Edge)
  - Test with slow network (loading states)
  - Verify all forms validate correctly
  - Check print styles (optional)

---

## Notes

### Task Dependencies
- Tasks 1-2 must complete before other tasks (shared layout/config)
- Alumni portal tasks (3-8) are mostly independent after task 2
- Admin panel tasks (10-21) are mostly independent after task 10
- Tasks 22-24 should be done after main views are complete
- Task 25 is final verification

### Implementation Tips
- Reference the design document for exact styling specifications
- Use consistent component styling across all pages
- Test responsive behavior immediately after implementing each view
- Commit after each completed task for easy rollback
- Take screenshots before/after for comparison

### Visual Verification Checklist (per task)
- [~] Correct colors (primary green, grays, semantic colors)
- [~] Proper shadows (sm, md, lg levels)
- [~] Smooth transitions (200-300ms)
- [~] Hover effects work
- [~] Focus states visible
- [~] Responsive behavior correct
- [~] Typography hierarchy clear
- [~] Spacing consistent

### Performance Notes
- Keep animations performant (use transform/opacity)
- Lazy load images where applicable
- Debounce search inputs
- Test with large datasets

### Browser Testing
- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile Safari (iOS)
- Chrome Mobile (Android)

## Task Dependency Graph

```json
{
  "waves": [
    { "id": 0, "tasks": ["1"] },
    { "id": 1, "tasks": ["2", "10"] },
    { "id": 2, "tasks": ["3", "4", "5", "7", "11", "12", "16"] },
    { "id": 3, "tasks": ["6", "8", "13", "17", "20"] },
    { "id": 4, "tasks": ["14", "15", "18", "19", "21"] },
    { "id": 5, "tasks": ["9", "22", "23", "24"] },
    { "id": 6, "tasks": ["25"] }
  ]
}
```
