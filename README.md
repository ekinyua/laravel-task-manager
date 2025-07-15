# Laravel Task Manager

A modern task management system built with Laravel, Livewire, and Volt, featuring robust authentication, user roles, and permissions.

---

## 🚀 Features

-   **User Authentication**: Register, login, password reset, email verification.
-   **Role & Permission Management**: Admin and user roles, with fine-grained permissions (powered by [spatie/laravel-permission](https://spatie.be/docs/laravel-permission)).
-   **Task Management**: Create, assign, and track tasks.
-   **Email notifications**: Sends an email via SMTP to the assigned user whenever a new task is created.
-   **Admin Dashboard**: Manage users, roles, permissions, and tasks.
-   **User Dashboard**: View and manage your own tasks.
-   **Modern UI**: Built with Livewire, Volt, and Tailwind CSS.
-   **Comprehensive Testing**: Feature and unit tests included.

---

## 🗂️ Project Structure

-   `app/Models/` — Eloquent models (User, Task, etc.)
-   `app/Http/Controllers/` — Controllers for web and API routes
-   `app/Livewire/` — Livewire components for interactive UI
-   `database/migrations/` — Database schema
-   `database/seeders/` — Default roles, permissions, and users
-   `resources/views/` — Blade and Livewire views
-   `routes/web.php` — Main web routes
-   `routes/auth.php` — Authentication routes
-   `tests/` — Unit and feature tests

---

## 🛠️ Getting Started

### 1. **Clone the Repository**

```sh
git clone https://github.com/ekinyua/laravel-task-manager.git
cd laravel-task-manager
```

### 2. **Install Dependencies**

#### Backend (PHP/Laravel)

```sh
composer install
```

#### Frontend (Node/Vite)

```sh
npm install
```

### 3. **Environment Setup**

-   Copy the example environment file and update settings as needed:
    ```sh
    cp .env.example .env
    ```
-   Generate the application key:
    ```sh
    php artisan key:generate
    ```

### 4. **Database Setup**

-   Create a database (e.g., `laravel`).
-   Update your `.env` file with your DB credentials.
-   Run migrations and seeders:
    ```sh
    php artisan migrate --seed
    ```

### 5. **Running the Application**

#### Option A: **Laravel Sail (Docker)**

-   Start the containers:
    ```sh
    ./vendor/bin/sail up -d
    ```
-   Access the app at [http://localhost](http://localhost).

#### Option B: **Locally**

-   Start the Laravel server:
    ```sh
    php artisan serve
    ```
-   Start the Vite dev server (for assets):
    ```sh
    npm run dev
    ```
-   Visit [http://localhost:8000](http://localhost:8000).

---

## 👤 Default Users (from Seeder)

-   **Admin**
    -   Email: `admintest@example.com`
    -   Password: `Password`
-   **User**
    -   Email: `test@example.com`
    -   Password: `Password`


---

## 📚 Useful Commands

-   **Run migrations:** `php artisan migrate`
-   **Seed database:** `php artisan db:seed`
-   **Clear cache/config:** `php artisan optimize:clear`
-   **Install frontend assets:** `npm install && npm run build`

---

## 🤝 Contributing

Pull requests are welcome! For major changes, please open an issue first to discuss what you would like to change.

---

## 📄 License

This project is open-sourced under the [MIT license](https://opensource.org/licenses/MIT).

---

## 💡 Need Help?

-   [Laravel Documentation](https://laravel.com/docs)
-   [Livewire Documentation](https://livewire.laravel.com/docs)
-   [Spatie Permission Docs](https://spatie.be/docs/laravel-permission)

---

Happy coding! 🚀
