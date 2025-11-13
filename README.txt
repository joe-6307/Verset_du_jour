
Verset du Jour - CBCA Mutiri (Design & Share-ready)
Files included:
- index.php            : frontend (renders verse server-side and includes share buttons)
- style.css            : responsive, modern CSS
- scripts.js           : share logic (WhatsApp, Facebook, X, Instagram/TikTok via image)
- api/verse.php        : API endpoint (auto-update if needed)
- api/generate_image.php : creates shareable PNG of the verse (for Instagram/TikTok)
- admin/add_verset.php : simple admin to add verses
- admin/liste.php      : list verses
- config.php           : DB config placeholder (edit with your credentials)
- assets/cbca_logo.png : default logo (blue/white)
- schema_reference.sql : reference SQL schema (you already created versetdb)

Deployment:
1. Upload all files to your LAMP host (public folder).
2. Ensure PHP GD is enabled for image generation (generate_image.php).
3. Edit config.php with DB credentials.
4. Go to /admin/add_verset.php to add verses (or import into versetdb).
5. Open index.php to view and test shares.
6. For Facebook/Twitter share previews, ensure index.php has appropriate Open Graph meta tags (optional).

Notes:
- Instagram/TikTok do not support direct text sharing via URL: the app generates an image you can download and upload to those platforms.
- The "Télécharger image" link provides a PNG generated on-the-fly (api/generate_image.php).
- Secure the admin folder before production (HTTP auth or simple login).
