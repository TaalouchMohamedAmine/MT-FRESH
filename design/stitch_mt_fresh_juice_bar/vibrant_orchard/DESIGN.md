---
name: Vibrant Orchard
colors:
  surface: '#f8f9ff'
  surface-dim: '#d6dae4'
  surface-bright: '#f8f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f0f4fd'
  surface-container: '#eaeef8'
  surface-container-high: '#e4e8f2'
  surface-container-highest: '#dee2ec'
  on-surface: '#171c23'
  on-surface-variant: '#594139'
  inverse-surface: '#2c3138'
  inverse-on-surface: '#edf1fb'
  outline: '#8d7168'
  outline-variant: '#e1bfb5'
  surface-tint: '#ab3500'
  primary: '#ab3500'
  on-primary: '#ffffff'
  primary-container: '#ff6b35'
  on-primary-container: '#5f1900'
  inverse-primary: '#ffb59d'
  secondary: '#006a62'
  on-secondary: '#ffffff'
  secondary-container: '#70f8e8'
  on-secondary-container: '#007168'
  tertiary: '#7c5800'
  on-tertiary: '#ffffff'
  tertiary-container: '#c78f00'
  on-tertiary-container: '#432e00'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#ffdbd0'
  primary-fixed-dim: '#ffb59d'
  on-primary-fixed: '#390c00'
  on-primary-fixed-variant: '#832600'
  secondary-fixed: '#70f8e8'
  secondary-fixed-dim: '#4fdbcc'
  on-secondary-fixed: '#00201d'
  on-secondary-fixed-variant: '#005049'
  tertiary-fixed: '#ffdea8'
  tertiary-fixed-dim: '#ffba20'
  on-tertiary-fixed: '#271900'
  on-tertiary-fixed-variant: '#5e4200'
  background: '#f8f9ff'
  on-background: '#171c23'
  surface-variant: '#dee2ec'
typography:
  display-hero:
    fontFamily: Plus Jakarta Sans
    fontSize: 48px
    fontWeight: '800'
    lineHeight: 56px
    letterSpacing: -0.02em
  display-hero-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 36px
    fontWeight: '800'
    lineHeight: 44px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
    letterSpacing: -0.015em
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 26px
    fontWeight: '700'
    lineHeight: 34px
    letterSpacing: -0.015em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 22px
    fontWeight: '700'
    lineHeight: 30px
    letterSpacing: -0.01em
  headline-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '600'
    lineHeight: 26px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 15px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Inter
    fontSize: 13px
    fontWeight: '400'
    lineHeight: 20px
  label-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 15px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.01em
  label-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 13px
    fontWeight: '600'
    lineHeight: 18px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 11px
    fontWeight: '700'
    lineHeight: 16px
    letterSpacing: 0.04em
rounded:
  sm: 0.5rem
  DEFAULT: 1rem
  md: 1.5rem
  lg: 2rem
  xl: 3rem
  full: 9999px
spacing:
  gutter: 1rem
  gutter-tablet: 1.25rem
  gutter-desktop: 1.5rem
  margin: 1rem
  margin-tablet: 2rem
  margin-desktop: 3rem
  space-2xs: 0.25rem
  space-xs: 0.5rem
  space-sm: 0.75rem
  space-md: 1rem
  space-lg: 1.5rem
  space-xl: 2rem
  space-2xl: 3rem
---

## Brand & Style

This design system embodies a fresh, vibrant, and sun-drenched aesthetic tailored for an energetic cold-pressed beverage and nutrition lifestyle. The experience centers on organic energy, instant refreshment, and cheerful accessibility. The visual tone must feel warm, juicy, and wholesome without descending into juvenile whimsy.

The interface combines modern soft minimalism with high-tactility, juicy design elements: generous tap targets, lush warm-tinted shadows, and crisp pill contours. Visual rhythm relies on luminous warm canvases, high-contrast typography, and radiant citrus and mint accents that trigger appetite appeal and effortless daily ordering.

## Colors

The palette mirrors nature’s harvest:
- **Primary (`#FF6B35`)**: Sun-ripened citrus orange. Serves as the primary conversion driver for key CTAs, highlights, and energy anchors.
- **Secondary (`#2EC4B6`)**: Crisp mint eucalyptus. Applied to fresh ingredients, botanical tags, success states, and balancing accents.
- **Tertiary (`#FFB800`)**: Golden zest yellow. Used sparingly for promotions, ratings, and special dietary badges.
- **Neutral (`#1E232A`)**: Deep charcoal bark. Provides maximum legibility against the canvas without the sterile harshness of pure black.

### Canvas & Surface Hierarchy
- **Canvas Base**: `#FAF8F5` (warm, natural linen off-white).
- **Surface Level 1**: `#FFFFFF` (crisp white product cards, sheets, elevated layers).
- **Surface Level 2**: `#F3EFEA` (subtle inset sections, search bars, and quantity selector wells).
- **Subtle Stroke**: `#ECE6DE` (delicate, low-contrast component borders).

## Typography

The typography pairing contrasts the inviting, geometric roundness of **Plus Jakarta Sans** with the structural precision of **Inter**. 

- **Display & Headings (Plus Jakarta Sans)**: Conveys juiciness, warmth, and culinary craftsmanship. Generous curves enhance organic brand personality. Always set with slight negative letter tracking at display sizes to ensure punchy editorial impact.
- **Body & Captions (Inter)**: Delivers rapid scannability on dense ingredient lists, nutrition cards, and transaction flows. 
- **Interactive Labels (Plus Jakarta Sans)**: Buttons and badges use bold weights with slight positive letter tracking for legibility across thumb-touch targets.

## Layout & Spacing

A mobile-first fluid layout standard governs all viewports with intentional safe zones tailored for rapid one-handed interactions:
- **Mobile (<640px)**: 4-column layout, `1rem` margins, dynamic horizontal snap carousels for quick flavor and recipe exploration.
- **Tablet (640px - 1024px)**: 8-column layout, `2rem` margins, staggered grid arrangement for catalog browsing.
- **Desktop (>1024px)**: 12-column layout capped at a maximum container width of `1200px` to maintain focused culinary storytelling and uncluttered checkout flows.

Component rhythm adheres to an explicit 4px/8px modular base scale. Generous vertical breathing room (`space-xl` to `space-2xl`) surrounds hero bottles and recipe titles, reflecting the pure clarity of the brand.

## Elevation & Depth

Visual hierarchy uses warm ambient lighting rather than generic cool grays. Surfaces float above the warm base through sunlit amber undertones:

- **Level 0 (Flat Canvas)**: `#FAF8F5` surface with no shadow. Used for page root and grouped category wells.
- **Level 1 (Cards, Rest State)**: `#FFFFFF` surface bordered by a crisp `1px` stroke of `#ECE6DE` and sustained by ambient warmth: `0 4px 16px -2px rgba(255, 107, 53, 0.06), 0 2px 6px -1px rgba(30, 35, 42, 0.04)`.
- **Level 2 (Hover, Popovers, Active Drawers)**: Elevated state: `0 12px 28px -4px rgba(255, 107, 53, 0.12), 0 4px 12px -2px rgba(30, 35, 42, 0.06)`.
- **Level 3 (Modals & Bottom Sticky Bars)**: Floating navigational anchors: `0 20px 40px -8px rgba(30, 35, 42, 0.15)`.
- **Juicy Glass**: Sticky navigation headers and floating category pills leverage an ultra-subtle backdrop blur (`backdrop-blur-md` with `rgba(250, 248, 245, 0.82)`) and a `1px` translucent edge to preserve visibility while scrolling vibrant imagery.

## Shapes

The design system employs a **Pill-shaped (Level 3)** geometry standard to echo organic droplets, bottle silhouettes, and produce curves:

- **Pills (`9999px`)**: Interactive buttons, category filters, ingredient tags, status badges, and search inputs.
- **Outer Shell Cards (`rounded-2xl` / 1.5rem to 2rem)**: Product showcase panels, recipe summaries, and bottom sheets.
- **Inner Nested Elements (`rounded-xl` / 1rem)**: Media containers, nutrition breakout panels, and quantity controls nested within outer cards.

## Components

### Buttons
- **Primary**: Full pill radius (`rounded-full`), height `52px` on mobile for ergonomic thumb reach. `#FF6B35` fill with pure white label typography (`label-lg`). Shadow: warm citrus glow (`0 8px 20px -4px rgba(255, 107, 53, 0.35)`). Active/Pressed scales down to `0.98`.
- **Secondary**: Pill radius, height `52px`. Crisp white background with a `1.5px` border in `#2EC4B6`, text in `#2EC4B6`. Hover shifts fill to `rgba(46, 196, 182, 0.08)`.
- **Ghost/Text**: Pill radius, no border, text in `#1E232A`. Provides clear affordance via warm background hover (`#F3EFEA`).

### Chips & Filter Pills
- Fully rounded pills (`height: 36px`, horizontal padding `16px`).
- **Unselected**: `#FFFFFF` surface with `1px` border of `#ECE6DE`, text in `#1E232A`.
- **Selected**: Fill `#1E232A` with `#FFFFFF` text, or filled `#2EC4B6` with white text for dietary traits (e.g., *Cold-Pressed*, *No Added Sugar*, *Organic*).

### Product Cards
- Encased in `#FFFFFF` with Level 1 warm elevation and `rounded-2xl` contour.
- Imagery rests on an organic, circular pastel backdrop tone (e.g., soft peach `rgba(255, 107, 53, 0.1)` or mint wash `rgba(46, 196, 182, 0.1)`).
- Bottom row integrates a direct-action round `+` thumb button (`44px` diameter) in vivid citrus orange.

### Input Fields & Search Bars
- Pill-shaped (`rounded-full`), `48px` minimum height, filled with `#FFFFFF` and bounded by `1.5px` border `#ECE6DE`.
- Focus shifts border to `#FF6B35` accompanied by an orange glow ring (`0 0 0 3px rgba(255, 107, 53, 0.15)`).
- Leading circular fruit or search icons rendered in `#2EC4B6` or subtle neutral `#6B7280`.

### Selection Controls (Checkboxes & Radios)
- **Checkboxes**: Smooth rounded squares (`rounded-md`, `6px` radius). Checked state transitions to `#2EC4B6` fill with clean white checkmark.
- **Radio Buttons**: Concentric circles. Selected state features a vivid `#FF6B35` ring encompassing a crisp white halo and centered dot.

### Specialized Product Components
- **Nutrition/Ingredient Dots**: Compact circular pill chips displaying ingredient icons (ginger root, fresh lemon, celery) alongside dosage percentages.
- **Bottle Size Selector**: Segmented horizontal pill switch with fluid background slide effect.
- **Floating Cart Bar**: Mobile bottom-pinned floating pill banner featuring total quantity badge and checkout action with elevated Level 3 drop shadow.