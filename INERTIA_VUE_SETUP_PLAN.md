# NativePHP + Inertia.js + Vue 3 Setup Plan
## The "Gold Standard" No-Reload Architecture

### 1. Architectural Overview
This stack creates a lightning-fast, desktop-native application that feels like a modern Single Page Application (SPA).
- **Backend:** Laravel (running locally via NativePHP) serves as the API, database manager (SQLite), and router.
- **Bridge:** Inertia.js replaces traditional API routing. It passes Laravel data directly to Vue components as props.
- **Frontend:** Vue 3 renders the UI dynamically. It handles all interactivity without full page reloads.

---

### 2. Component Separation Strategy (The "No-Reload" Secret)
To achieve the fast, app-like SPA feel, we will separate the UI into strict structural layers:

```text
resources/js/
├── app.js (Inertia & Vue Initialization)
├── Layouts/
│   ├── AppLayout.vue (Main wrapper: Sidebar, Header, Backgrounds)
│   └── GuestLayout.vue (For Login/Registration - minimal wrapper)
├── Pages/
│   ├── Home.vue (Migrated from h1.html)
│   ├── Dincharya.vue (Migrated from dincharya.html)
│   └── Auth/
│       ├── Login.vue (Migrated from login.html)
│       └── Register.vue (Migrated from registration.html)
└── Components/
    ├── UI/
    │   ├── PrimaryButton.vue (Reusable buttons)
    │   ├── TextInput.vue (Reusable inputs with validation)
    └── App/
        ├── RoutineCard.vue (For Dincharya timeline items)
        └── StatCard.vue (For Home dashboard stats)
```

**Why this makes it fast:**
- **Layout Persistence:** `AppLayout.vue` stays permanently mounted. When you click from *Home* to *Dincharya*, only the `Page` component swaps out. The sidebar, background image, and any global audio player never reload or flash.
- **Inertia `<Link>`:** We will replace all standard `<a href="...">` tags with Inertia's `<Link href="...">` components. This intercepts clicks and fetches the new page data via JSON instead of doing a full HTML document reload.

---

### 3. Page-by-Page Implementation Plan

#### A. Auth Pages (Login & Registration)
- **Layout:** `GuestLayout.vue` (Centered container, no sidebars).
- **Action:** Convert `login.html` and `registration.html` into `Pages/Auth/Login.vue` and `Pages/Auth/Register.vue`.
- **Data Handling:** 
  - Use Inertia's `useForm()` helper. 
  - Bind the inputs (e.g., `<input v-model="form.username">`).
  - `useForm` automatically handles loading spinners, disables buttons during submission, and catches validation errors from Laravel in real-time.

#### B. Home Page (Dashboard)
- **Layout:** `AppLayout.vue`
- **Action:** Convert `h1.html` to `Pages/Home.vue`.
- **Components:** 
  - Extract the sidebar navigation into the layout.
  - Extract the dynamic stats (Streak counter, Brahmacharya days) into reactive Vue properties (`ref` or `computed`).
  - This ensures that if a user updates their streak, the number animates and changes instantly without refreshing.

#### C. Dincharya Page
- **Layout:** `AppLayout.vue`
- **Action:** Convert `dincharya.html` to `Pages/Dincharya.vue`.
- **Interactivity:** 
  - Convert the daily routine timeline into a `v-for` loop rendering `RoutineCard.vue` components.
  - State Management: When a user checks a checkbox for a completed routine, Vue will instantly update the UI (optimistic UI update), while an Inertia `router.patch()` request quietly saves the progress to the local SQLite database in the background.

---

### 4. Setup Execution Steps

1. **Initialize Base Application**
   ```bash
   composer create-project laravel/laravel . --force
   composer require nativephp/electron
   php artisan native:install
   ```

2. **Install Server-Side Inertia**
   ```bash
   composer require inertiajs/inertia-laravel
   php artisan inertia:middleware
   # Register middleware in Kernel
   ```

3. **Install Client-Side Vue 3 & Vite**
   ```bash
   npm install @inertiajs/vue3 vue @vitejs/plugin-vue
   npm install -D tailwindcss postcss autoprefixer
   npx tailwindcss init -p
   ```

4. **Configure Vite & Tailwind**
   - Update `vite.config.js` to use the Vue plugin.
   - Configure `tailwind.config.js` to scan `resources/js/**/*.vue` files.

5. **Local Database Configuration**
   - Set Laravel to use `sqlite` so that NativePHP bundles the local database directly with the desktop application installer, requiring no server connection for the user.

---

### 5. NativePHP Specific Optimizations
- **System Tray & Notifications:** We can use NativePHP's API to trigger native OS desktop notifications (e.g., *"Time for Sandhya Vandanam"* or *"Wake up time"*).
- **Window Management:** Configure the NativePHP window size, remove the default browser menu bar, and set it to a fixed native application window.
- **Offline First:** Since the Vue frontend, Laravel backend, and SQLite database are all bundled locally, the app will have zero latency and work 100% offline.
