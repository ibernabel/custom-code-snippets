# Custom Code Snippets

A well-structured WordPress plugin for managing custom code snippets and functionality enhancements using modern PHP best practices.

## Features

- 🏗️ **Modular Architecture**: Organized module system for easy maintenance
- 🔒 **Singleton Pattern**: Prevents multiple instances and ensures optimal performance
- 📦 **Object-Oriented**: Clean, maintainable PHP code following best practices
- ⚡ **Performance Optimized**: Currently includes Metform asset preloading
- 🌐 **Translation Ready**: Full i18n support
- 📝 **Well Documented**: Comprehensive inline documentation

## Current Modules

### Performance Module
- **Metform Asset Preloading**: Eliminates the 1-3 second delay when loading Metform forms by preloading CSS and JavaScript assets early in the page load process.

## Installation

1. Download the plugin files
2. Upload the `custom-code-snippets` folder to `/wp-content/plugins/`
3. Activate the plugin through the 'Plugins' menu in WordPress

## Usage

The plugin works automatically once activated. All optimizations are applied based on the detected context (page type, active plugins, etc.).

## Adding New Modules

To add a new module:

1. Create a new file in `includes/modules/`:
```php
// includes/modules/class-your-module.php
class CCS_Your_Module {
    private static $instance = null;
    
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    private function __construct() {
        $this->init_hooks();
    }
    
    private function init_hooks() {
        // Add your hooks here
    }
}
```

2. Load it in the main plugin file (`custom-code-snippets.php`):
```php
require_once $this->plugin_path . 'includes/modules/class-your-module.php';
CCS_Your_Module::get_instance();
```

## Structure

```
custom-code-snippets/
├── custom-code-snippets.php    # Main plugin file
├── includes/
│   └── modules/
│       └── class-performance.php  # Performance optimizations
├── languages/                  # Translation files
├── LICENSE                     # MIT License
└── README.md                   # This file
```

## Requirements

- WordPress 5.0 or higher
- PHP 7.2 or higher

## Development

This plugin follows WordPress Coding Standards and uses:
- Singleton pattern for class instantiation
- Object-oriented programming principles
- Proper documentation with PHPDoc blocks
- Security best practices (nonce verification, capability checks, sanitization)

## Changelog

### 1.0.0
- Initial release
- Added Performance module with Metform asset preloading

## License

MIT License

Copyright (c) 2025 Idequel Bernabel

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Author

**Idequel Bernabel**
- GitHub: [@ibernabel](https://github.com/ibernabel)

## Support

For issues, questions, or contributions, please visit the [GitHub repository](https://github.com/ibernabel/custom-code-snippets).

---

Made with ❤️ for the WordPress community