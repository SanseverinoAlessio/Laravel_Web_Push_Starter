# Laravel Web Push Starter

This repository is a **starter Laravel project** that includes a complete implementation of **Web Push Notifications**, with all required components already created and ready for customization.  
The project contains:

- `manifest.json`
- Service workers (already implemented)
- Web Push backend logic
- Frontend subscription logic
- PWA structure required for iOS push notifications

You only need to update values inside these existing files according to your application.

---

## Features

- Laravel Web Push Notification integration  
- VAPID key generation support  
- PWA-ready structure  
- iOS Safari push notification compatibility (requires PWA installation)  
- Frontend configured with Vite  
- Service workers and manifest already implemented  

---

## Installation

### Clone the repository

```bash
git clone <your-repository-url>
cd <project-folder>
```

### Install Composer dependencies

```bash
composer install
```

### Install NPM dependencies

```bash
npm install
npm run dev
```

---

## Environment Setup

Copy the environment template:

```bash
cp .env.example .env
```

Generate the Laravel key:

```bash
php artisan key:generate
```

---

## Generate VAPID Keys (Mandatory)

Web Push requires a VAPID key pair.

Run:

```bash
php artisan webpush:vapid
```

This command outputs:

- VAPID_PUBLIC_KEY  
- VAPID_PRIVATE_KEY  

You **must** set the public key also in Vite:

Add inside `.env`:

```
VITE_VAPID_PUBLIC_KEY=your_public_vapid_key_here
```

---

## PWA & iOS Push Notifications

iOS only supports push notifications through **installed PWAs**.

This project already includes:

- `manifest.json`
- Service workers
- Icons (or placeholders)
- Registration logic

You only need to update:

- App name  
- Colors  
- Icons  
- Start URL  

Ensure the manifest is referenced in your main Blade template:

```html
<link rel="manifest" href="/manifest.json">
```

---

## Service Worker

The service worker files included in the project handle:

- Push event reception  
- Notification display  
- Subscription logic  

These files are already implemented.  
Modify only project-specific details (notification title, icon, etc.) if needed.

Frontend registration:

```js
if ("serviceWorker" in navigator) {
    navigator.serviceWorker.register("/service-worker.js");
}
```

---

## Running the Project

Start backend:

```bash
php artisan serve
```

Start frontend:

```bash
npm run dev
```

---

## License

This project is provided as a starter boilerplate for personal or commercial projects.
