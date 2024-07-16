# AccessMeter

A custom WordPress theme designed for maximum accessibility, SEO optimization, and user customization. This theme integrates Lighthouse API by default to help site owners gauge the accessibility of their pages right from the dashboard. Additionally, the theme is WooCommerce ready and offers a variety of customization options to make it versatile and attractive.

## Features

### Accessibility
- **Lighthouse API Integration**: Provides real-time accessibility scores and suggestions directly within the WordPress dashboard.
- **ARIA Attributes**: Proper use of ARIA attributes to improve screen reader accessibility.
- **Keyboard Navigation**: Ensures all interactive elements are accessible via keyboard navigation.
- **Color Contrast**: High contrast options to meet WCAG guidelines.

### SEO Optimization
- **Optimized HTML Structure**: Proper use of HTML5 elements and schema markup.
- **Meta Tags**: Easy management of meta tags for better SEO performance.
- **SEO Plugin Compatibility**: Full support for popular SEO plugins like Yoast SEO and Rank Math.

### Customization Options
- **Header and Footer**: Options to expand or collapse the header and footer sections.
- **Sidebar Layouts**: Choose from right sidebar, left sidebar, both sidebars, or no sidebar at all.
- **Color Schemes**: Four color schemes available: Blue, Purple, Red, and Green.
- **Light/Dark Modes**: Switch between light and dark modes to suit your preferences.

### WooCommerce Ready
- **Modular Integration**: WooCommerce support is integrated in a modular way to avoid bloat. Features and styles load only if WooCommerce is active.
- **Custom WooCommerce Styles**: Custom styles for WooCommerce to match the theme’s aesthetics.
- **Product Gallery Features**: Includes zoom, swipe, and lightbox functionalities for product images.

### Development and Workflow
- **Modern Workflow**: Utilizes modern development tools and practices for an efficient workflow.
- **CLI Commands**: A set of CLI commands tailored for WordPress theme development.
- **SASS Support**: Uses SASS for organized and maintainable CSS.
- **Gulp Automation**: Automates tasks like CSS compilation, JavaScript minification, and live reloading.

## Installation

### Requirements
- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)

### Quick Start
1. Clone or download this repository.
2. Install the necessary Node.js and Composer dependencies:
    ```sh
    composer install
    npm install
    ```
3. Run the setup commands to initialize the development environment:
    ```sh
    npm run build
    ```

## Available CLI Commands

- `composer lint:wpcs`: Checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- `composer lint:php`: Checks all PHP files for syntax errors.
- `composer make-pot`: Generates a .pot file in the `languages/` directory.
- `npm run compile:css`: Compiles SASS files to CSS.
- `npm run compile:rtl`: Generates an RTL stylesheet.
- `npm run watch`: Watches all SASS files and recompiles them to CSS when they change.
- `npm run lint:scss`: Checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
- `npm run lint:js`: Checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
- `npm run bundle`: Generates a .zip archive for distribution, excluding development and system files.

## Customization Instructions

1. **Header and Footer Customization**:
   - Access the theme customizer to toggle the expanded/collapsed states.
2. **Sidebar Layouts**:
   - Choose your preferred sidebar layout from the theme customizer.
3. **Color Schemes**:
   - Select from Blue, Purple, Red, and Green color schemes in the theme customizer.
4. **Light/Dark Modes**:
   - Toggle between light and dark modes from the theme customizer.

## License
Licensed under GPLv2 or later. Use it to make something cool and share your improvements.

Good luck and happy theming!
