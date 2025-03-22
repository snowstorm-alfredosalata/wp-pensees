# Pensées

**Pensées** is a lightweight WordPress plugin to manage and display short-form reflective thoughts ("pensées"). It includes a custom post type and an AJAX-powered viewer with next, previous, and random navigation.

---

## ✨ Features

- `pensee` custom post type
- Frontend viewer with AJAX navigation
- Shortcode: `[pensee_viewer]`
- Clean, minimal styling
- Multiple viewer instances per page
- Designed for easy customization and extension

---

## 📦 Installation

1. Download the plugin or clone the repository:
   ```bash
   git clone https://github.com/snowstorm-alfredosalata/pensees.git
   ```
2. Move the plugin folder into your WordPress `wp-content/plugins/` directory.
3. Activate the plugin from the WordPress admin panel.
4. Use the `[pensee_viewer]` shortcode in a page or post.

---

## 🧩 Shortcode

Use this shortcode anywhere to display a pensée viewer:

```
[pensee_viewer]
```

Each viewer is independently navigable. Supports multiple instances on the same page.

---

## 📁 File Structure

```
pensees/
├── css/
│   └── pensees.css          # Default styling
├── js/
│   └── pensees.js           # AJAX handling and UI logic
├── src/
│   ├── PENSEES_Helper.php   # Core logic helper class
│   ├── pensee_ajax.php      # AJAX handlers
│   ├── pensee_post_type.php # Custom post type registration
│   └── pensee_viewer.php    # Viewer shortcode
├── pensees.php              # Plugin bootstrap file
├── readme.txt               # WordPress.org plugin info
├── README.md                # This file
└── LICENSE                  # MIT license
```

---

## 🛠 Development

- PHP 7.4+ recommended
- WordPress 6.0+
- Uses jQuery (included in WP)
- Follows best practices: encapsulated logic, global state avoidance, reusable AJAX endpoints

---

## 🧑‍💻 Author

**Alfredo Salata**  
[https://github.com/snowstorm-alfredosalata](https://github.com/snowstorm-alfredosalata)  
[as@salata.ovh](mailto:as@salata.ovh)

---

## 📝 License

MIT License — see [LICENSE](LICENSE)
