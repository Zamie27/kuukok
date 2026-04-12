# Kuukok Hosting Service Development Skill

This skill provides the necessary instructions and best practices for developing the **Hosting Web Service** module within the Kuukok project.

## 🛠️ Module Overview
The Hosting Web Service is a MVP (Minimum Viable Product) system for managing "Hosting Capstone" services. It includes user registration, package selection, payment verification, and automated/manual access provisioning (FTP & Database).

## 🚀 Key Implementation Guidelines

### 1. Authentication & Role Management
- **Default Role**: All new registrations via the public registration form MUST be assigned the `user` role.
- **Admin Roles**: `admin` and `super_admin` roles are reserved for administrative tasks and should only be assigned manually or via specific seeding.
- **Access Control**:
    - `user`: Access to personal dashboard and hosting orders.
    - `admin`: Manage all hosting orders, approve payments, and provision access.
    - `super_admin`: Full system access, including user management and system settings.

### 2. Database Schema Relationships
- **Referral System**: Implement a self-referencing relationship in the `users` table or a separate `referrals` table.
- **Referral Code**: Unique, auto-generated code for each user.
- **Hosting Order**: A `hosting_orders` table linked to `users`, containing project details and billing status.
- **Cashback**: Track cashback status with a 30-day expiration policy.

### 3. Workflow States
Hosting orders should follow a clear state transition:
1. `Pending Payment` (Default after order)
2. `Awaiting Verification` (After proof upload)
3. `Active` (After admin approval and provisioning)
4. `Rejected` (If payment is invalid)
5. `Suspended` (If resource limit exceeded)

### 4. Admin Provisining Logic
When an order is approved, the admin must provide:
- **FTP Access**: Host, Username, Password.
- **Database Info**: Host, DB Name, User, Password.
- **Deployment Status**: Indication if auto-deploy is configured.

### 5. Referral & Cashback Logic
- **Constraint**: Cashback is only valid if the referred user completes a successful payment within 30 days of registration using the referral code.
- **Limit**: Maximum cashback is capped at 30,000 IDR.

## 📁 Recommended Directory Structure
- `app/Models/HostingOrder.php`: Core model for hosting orders.
- `app/Models/Referral.php`: Optional model for tracking referral relationships.
- `app/Livewire/Hosting/`: Volt components for the hosting landing page and ordering flow.
- `app/Livewire/Admin/Hosting/`: Components for administrative order management.

## ⚠️ Security & Rules
- **Resource Limits**: Always include the "Rule penggunaan resource" warning in the UI.
- **Validation**: Strict validation for proof of payment uploads (images only, size limits).
- **Isolation**: Ensure users can only see their own hosting orders and access info.

---
> [!IMPORTANT]
> Always verify that the existing `Kuukok` systems (Portfolio, Blog) remain unaffected by the new Hosting module updates.
