# Patient Management System

A role-based Laravel application designed to manage patients, doctors, visits, and medical reports.

## What has been built?
1. **Database & Migrations**: Designed relational tables for `users`, `doctors`, `patients`, `visits`, and `reports`. Configured Soft Deletes to safely hide deleted patients instead of permanently erasing them.
2. **Role-Based Access Control (RBAC)**: Developed a custom `RoleMiddleware` to secure routes based on user type.
3. **Tailwind Frontend**: 
   - Transformed the app from an API into a monolithic Blade UI using CDN Tailwind CSS (removing the need for complex Node.js build steps).
   - Created a modern Landing Page (`welcome.blade.php`).
   - Rebuilt the Dashboard with live statistical cards.
   - Built a complete Patient CRUD interface (`index`, `create`, `edit`, `trash`).
4. **Authentication**: Installed Laravel Breeze for out-of-the-box secure login and registration. Configured sessions to timeout automatically after 30 minutes for security.

---

## Role Matrix & Security Rules

| Role | Access Level | Permissions |
| :--- | :--- | :--- |
| **Admin** | Full Access | Can do everything. Has exclusive access to **Restore** and **Force Delete** patients from the trash. |
| **Receptionist** | Front Desk | Can **Create**, **Edit**, and **Soft Delete** patients. Cannot force-delete. |
| **Doctor** | Medical Staff | Cannot create/edit patient profiles. Can only view **assigned patients**. Can add visits and upload reports specifically for their assigned patients. |

---

## How to Test the Roles

I have seeded the database with fake data and pre-configured accounts. All accounts share the same password.

**Password for all accounts:** `password`

### 1. The Admin
- **Email:** `admin@example.com`
- **Testing Goal:** Log in and navigate to the Patients list. Try soft-deleting a patient, then click "View Trash" to permanently delete or restore them.

### 2. The Receptionist
- **Email:** `receptionist@example.com`
- **Testing Goal:** Log in and add a new patient. Try editing an existing patient. Notice how you do not have access to Force Delete buttons in the Trash.

### 3. The Doctor
- **Email:** `doctor@example.com`
- **Testing Goal:** Log in and visit the Patients tab. You will *only* see the specific patients that the factory randomly assigned to Dr. John Doe. You cannot see the full hospital roster.

---

## Technical Details

- **Tailwind Setup**: Tailwind is loaded via the official CDN `<script src="https://cdn.tailwindcss.com"></script>` inside the Blade layouts to prevent Vite manifest errors.
- **Storage**: Run `php artisan storage:link` if you haven't already. Uploaded reports are stored in `/storage/app/public/reports` and are publicly accessible via URL.
