# VYOJIN Complete Ecommerce Build

This build keeps the supplied Vyojin visual direction and local image assets, removes the old scraped collection page from the homepage, and adds working category/product/ecommerce routes.

## Routes
/, /sarees, /salwar-kameez, /lehenga, /indo-western, /chaniya-choli, /wedding, /festive, /new, /best-sellers, /ready-to-ship, /diwali, /collection, /sale, /product/{slug}, /search, /wishlist, /cart, /login, /register, /checkout, /order-success, /about, /contact, /shipping, /returns, /faq, /privacy, /terms.

## Notes
- Product imagery is sourced only from the supplied local Vyojin assets.
- Cart/wishlist are browser-local for this PHP build.
- Login/register/checkout/order flow is functional as a demo storefront flow; connect your production payment gateway before taking real payments.
- `.htaccess` provides clean URL routing on Apache/Plesk.
- `router.php` can be used with `php -S 127.0.0.1:8000 router.php`.
