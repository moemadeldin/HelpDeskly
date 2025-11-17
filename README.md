# HelpDeskly 🎫

<div align="center">

**A modern, enterprise-grade help desk and ticketing system built with Laravel 12**

[![PHP Version](https://img.shields.io/badge/PHP-8.2%2B-blue.svg)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12-red.svg)](https://laravel.com/)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![Code Style](https://img.shields.io/badge/code%20style-PSR--12-orange.svg)](https://www.php-fig.org/psr/psr-12/)

</div>

---

## 📋 Table of Contents

-   [Overview](#overview)
-   [Key Features](#key-features)
-   [Architecture & Design](#architecture--design)
-   [Technology Stack](#technology-stack)
-   [Getting Started](#getting-started)
-   [Project Structure](#project-structure)
-   [Core Components](#core-components)
-   [API & Integration](#api--integration)
-   [Security Features](#security-features)
-   [Performance Optimizations](#performance-optimizations)
-   [Development Workflow](#development-workflow)
-   [Testing](#testing)
-   [Deployment](#deployment)
-   [Contributing](#contributing)

---

## 🎯 Overview

HelpDeskly is a production-ready, full-stack help desk management system designed to streamline customer support operations. Built with modern PHP practices and leveraging Laravel 12's latest features, it provides a scalable, maintainable solution for managing customer support tickets with real-time communication, intelligent agent assignment, and comprehensive role-based access control.

### Why HelpDeskly?

-   **🏗️ Clean Architecture**: Implements SOLID principles with service layers, DTOs, and repository patterns
-   **⚡ Real-Time Communication**: WebSocket-powered messaging using Pusher for instant customer-agent interactions
-   **📊 Hybrid Database Strategy**: PostgreSQL for relational data, MongoDB for scalable message storage
-   **🔒 Enterprise Security**: Comprehensive authentication, authorization, and data protection
-   **🎨 Modern UI/UX**: Responsive design with Tailwind CSS 4 and optimized frontend build pipeline
-   **🧪 Test-Driven Development**: PHPUnit test suite with feature and unit test coverage
-   **📦 Production Ready**: Queue workers, event-driven architecture, and notification system

---

## ✨ Key Features

### 🎫 Advanced Ticket Management

-   **Multi-Status Workflow**: Open → In Progress → Resolved → Closed lifecycle management
-   **Priority System**: Low, Medium, High priority levels with visual indicators
-   **Category Organization**: Hierarchical categorization for better ticket routing
-   **Advanced Filtering**: Filter by status, priority, category, date range, and assignee
-   **Soft Deletes**: Preserve ticket history with Laravel's soft delete functionality
-   **UUID Primary Keys**: Globally unique identifiers for better distributed system support

### 👥 Role-Based Access Control (RBAC)

-   **Three-Tier Permission System**:
    -   **Customer**: Create tickets, view own tickets, communicate with assigned agents
    -   **Agent**: Manage assigned tickets, update status/priority, respond to customers, view ticket history
    -   **Admin**: Full system access, category management, user administration, system-wide analytics
-   **Policy-Based Authorization**: Laravel policies for fine-grained access control
-   **Middleware Protection**: Route-level access control with custom middleware

### 💬 Real-Time Communication

-   **WebSocket Integration**: Pusher-powered real-time messaging between customers and agents
-   **Message Persistence**: MongoDB storage for scalable message history
-   **Private Channels**: Secure, ticket-specific communication channels
-   **Read Receipts**: Message seen status tracking
-   **Instant Notifications**: Real-time browser notifications for new messages
-   **Message Broadcasting**: Event-driven architecture with Laravel Broadcasting

### 🤖 Intelligent Agent Assignment

-   **Load Balancing Algorithm**: Distributes tickets evenly across available agents
-   **Availability-Based Routing**: Only assigns to online agents
-   **Ticket Limit Management**: Configurable maximum tickets per agent (default: 5)
-   **Automatic Assignment**: Seamless ticket routing on creation
-   **Agent Status Tracking**: Real-time online/offline status monitoring

### 📎 File Management

-   **Multi-File Attachments**: Support for up to 5 attachments per ticket
-   **Secure Storage**: Laravel Filesystem with configurable disk drivers
-   **File Validation**: MIME type and size validation
-   **Metadata Tracking**: File name, size, type, and upload timestamp
-   **Image Processing**: Dedicated ImageManager service for optimized image handling

### 🔔 Notification System

-   **Multi-Channel Notifications**: Database, email, and real-time browser notifications
-   **Event-Driven**: Laravel notification system with custom notification classes
-   **Notification Types**:
    -   Ticket assignment notifications
    -   Status change alerts
    -   Password reset confirmations
    -   New message notifications
-   **Unread Count Tracking**: Real-time unread notification badges

### 🔐 Authentication & Security

-   **Secure Authentication**: Laravel's built-in authentication with password hashing
-   **Email Verification**: Optional email verification workflow
-   **Password Recovery**: Secure password reset with token-based system
-   **Rate Limiting**: Throttled login attempts (4 attempts per minute)
-   **Session Management**: Secure session handling with remember me functionality
-   **CSRF Protection**: Built-in CSRF token validation
-   **SQL Injection Prevention**: Eloquent ORM with parameterized queries
-   **XSS Protection**: Blade template escaping

---

## 🏗️ Architecture & Design

### Design Patterns

-   **Service Layer Pattern**: Business logic separated into dedicated service classes
-   **Repository Pattern**: Data access abstraction through Eloquent models
-   **DTO Pattern**: Data Transfer Objects for type-safe data handling
-   **Action Pattern**: Single-responsibility action classes for complex operations
-   **Query Builder Pattern**: Dedicated query classes for complex database queries
-   **Interface Segregation**: Service interfaces for dependency injection and testing

### Code Organization

```
app/
├── Actions/          # Single-purpose action classes
├── DTOs/             # Data Transfer Objects (type-safe data structures)
├── Enums/            # Type-safe enumerations (Roles, Status, Priority)
├── Events/           # Domain events for event-driven architecture
├── Http/
│   ├── Controllers/  # Thin controllers delegating to services
│   ├── Middleware/   # Custom middleware (Admin, Agent, Customer)
│   ├── Requests/     # Form request validation
│   └── Resources/    # API resource transformers
├── Interfaces/       # Service contracts for dependency injection
├── Models/           # Eloquent models with relationships
├── Policies/         # Authorization policies
├── Queries/          # Reusable query builders
├── Services/         # Business logic services
├── Traits/           # Reusable code traits
└── Utilities/        # Helper classes and constants
```

### Database Architecture

-   **PostgreSQL**: Primary relational database for users, tickets, categories, and attachments
-   **MongoDB**: Document store for ticket messages (optimized for high-volume messaging)
-   **Hybrid Approach**: Best of both worlds - ACID compliance for critical data, scalability for messages

### Event-Driven Architecture

-   **Laravel Events**: Domain events for ticket assignment, status changes, message sending
-   **Event Listeners**: Decoupled event handlers for notifications and side effects
-   **Broadcasting**: Real-time event broadcasting via Pusher channels

---

## 🛠️ Technology Stack

### Backend

-   **Framework**: Laravel 12 (latest stable release)
-   **PHP**: 8.2+ (leveraging modern PHP features: enums, readonly properties, typed properties)
-   **Database**: PostgreSQL 14+ (primary), MongoDB 6+ (messages)
-   **Queue System**: Laravel Queue with database driver
-   **Real-Time**: Pusher WebSocket service
-   **Code Quality**: Laravel Pint (PSR-12 code style)

### Frontend

-   **Templating**: Blade (server-side rendering)
-   **CSS Framework**: Tailwind CSS 4 (utility-first CSS)
-   **JavaScript**: Vanilla JS with Laravel Echo for WebSockets
-   **Build Tool**: Vite 7 (fast HMR and optimized builds)
-   **HTTP Client**: Axios for AJAX requests

### Development Tools

-   **Testing**: PHPUnit 11.5+ (unit and feature tests)
-   **Code Style**: Laravel Pint (automated code formatting)
-   **Package Manager**: Composer (PHP), npm (JavaScript)
-   **Version Control**: Git

### Third-Party Services

-   **Pusher**: Real-time WebSocket infrastructure
-   **MongoDB**: Document database for message storage

---

## 🚀 Getting Started

### Prerequisites

-   PHP 8.2 or higher
-   Composer 2.x
-   Node.js 18+ and npm
-   PostgreSQL 14+ (or MySQL 8+)
-   MongoDB 6+ (for message storage)
-   Pusher account (free tier available)

### Installation

#### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/HelpDeskly.git
cd HelpDeskly
```

#### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

#### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### 4. Configure Environment Variables

Edit `.env` file with your configuration:

```env
# Application
APP_NAME=HelpDeskly
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database (PostgreSQL)
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=helpdeskly
DB_USERNAME=your_username
DB_PASSWORD=your_password

# MongoDB
MONGODB_URI=mongodb://localhost:27017
MONGODB_DATABASE=helpdeskly

# Pusher (Real-time)
PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_key
PUSHER_APP_SECRET=your_pusher_secret
PUSHER_APP_CLUSTER=your_pusher_cluster

# Broadcasting
BROADCAST_DRIVER=pusher
BROADCAST_CONNECTION=pusher

# Queue
QUEUE_CONNECTION=database
```

#### 5. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database (optional - creates roles and sample data)
php artisan db:seed
```

#### 6. Build Frontend Assets

```bash
# Production build
npm run build

# Or development with hot reload
npm run dev
```

#### 7. Start Development Servers

```bash
# Quick setup (one command for everything)
composer run dev
```

This command runs:

-   Laravel development server (http://localhost:8000)
-   Queue worker (processes background jobs)
-   Vite dev server (hot module replacement)

### Quick Setup Script

For a complete automated setup:

```bash
composer run setup
```

This will:

1. Install all dependencies
2. Create `.env` file if missing
3. Generate application key
4. Run migrations
5. Install npm packages
6. Build frontend assets

---

## 📁 Project Structure

```
HelpDeskly/
├── app/
│   ├── Actions/              # Business logic actions
│   │   ├── Auth/             # Authentication actions
│   │   └── CreateTicketMessageAction.php
│   ├── Console/              # Artisan commands
│   │   └── Commands/
│   ├── DTOs/                 # Data Transfer Objects
│   │   ├── Admin/
│   │   ├── Auth/
│   │   └── Tickets/
│   ├── Enums/                # Type-safe enumerations
│   │   ├── ActivityStatus.php
│   │   ├── Roles.php
│   │   ├── TicketPriority.php
│   │   └── TicketStatus.php
│   ├── Events/               # Domain events
│   │   ├── MessageSent.php
│   │   └── PasswordResetLinkCreated.php
│   ├── Http/
│   │   ├── Controllers/      # Application controllers
│   │   │   ├── Admin/
│   │   │   ├── Agent/
│   │   │   ├── Auth/
│   │   │   ├── Customer/
│   │   │   └── Ticket/
│   │   ├── Middleware/       # Custom middleware
│   │   ├── Requests/         # Form request validation
│   │   └── Resources/        # API resource transformers
│   ├── Interfaces/           # Service contracts
│   ├── Listeners/            # Event listeners
│   ├── Mail/                 # Email templates
│   ├── Models/               # Eloquent models
│   ├── Notifications/        # Notification classes
│   ├── Policies/             # Authorization policies
│   ├── Providers/            # Service providers
│   ├── Queries/              # Query builder classes
│   ├── Services/             # Business logic services
│   ├── Traits/               # Reusable traits
│   └── Utilities/            # Helper classes
├── bootstrap/                # Application bootstrap
├── config/                   # Configuration files
├── database/
│   ├── factories/            # Model factories
│   ├── migrations/           # Database migrations
│   └── seeders/              # Database seeders
├── public/                   # Public assets
├── resources/
│   ├── css/                  # Stylesheets
│   ├── js/                   # JavaScript files
│   └── views/                # Blade templates
│       ├── auth/
│       ├── components/
│       ├── customer/
│       ├── dashboard/
│       └── layouts/
├── routes/                   # Route definitions
│   ├── admin.php
│   ├── agent.php
│   ├── auth.php
│   ├── customer.php
│   └── web.php
├── storage/                  # Storage directory
├── tests/                    # Test suite
│   ├── Feature/
│   └── Unit/
└── vendor/                   # Composer dependencies
```

---

## 🔧 Core Components

### Models

#### User Model

-   **UUID Primary Keys**: Globally unique identifiers
-   **Role Relationships**: BelongsTo Role model
-   **Ticket Relationships**: HasMany customerTickets and agentTickets
-   **Status Tracking**: Online/offline activity status
-   **Scope Methods**: `assignRandomAgent()` for intelligent assignment
-   **Helper Methods**: `isAdmin()`, `isAgent()`, `isCustomer()`, `isOnline()`

#### Ticket Model

-   **Soft Deletes**: Preserve ticket history
-   **Enum Casting**: Type-safe status and priority
-   **Relationships**: BelongsTo customer, agent, category; HasMany attachments
-   **Query Scopes**: `filterStatus()`, `filterPriority()`, `filterCategory()`
-   **Status Helpers**: `isOpen()`, `isInProgress()`, `isResolved()`, `isClosed()`

#### TicketMessage Model (MongoDB)

-   **Document Storage**: MongoDB collection for messages
-   **Timestamps**: Automatic created_at/updated_at
-   **Enum Casting**: Role-based message typing
-   **Query Scopes**: `getTicketMessages()` for message retrieval

### Services

#### TicketManager Service

-   **Transaction Management**: Database transactions for data integrity
-   **Agent Assignment**: Automatic load-balanced agent assignment
-   **Attachment Handling**: Secure file upload and storage
-   **Status Change Notifications**: Event-driven status update alerts
-   **Interface-Based**: Implements `TicketManagerInterface` for testability

#### AuthService

-   **Authentication Logic**: Centralized auth operations
-   **Interface-Based**: `AuthServiceInterface` for dependency injection
-   **Password Management**: Secure password hashing and validation

#### ImageManager Service

-   **File Upload**: Secure multi-file upload handling
-   **Path Management**: Organized file storage structure
-   **Interface-Based**: `ImageManagerInterface` for flexibility

### Query Builders

-   **AdminTicketQuery**: Admin-level ticket queries (all tickets)
-   **AgentTicketQuery**: Agent-level queries (assigned tickets only)
-   **UserTicketQuery**: Customer-level queries (own tickets only)
-   **TicketQuery**: Base query class with shared functionality

### DTOs (Data Transfer Objects)

-   **Type Safety**: Strongly typed data structures
-   **Validation**: Built-in validation rules
-   **Immutability**: Read-only properties where applicable
-   **Categories**: Auth DTOs, Ticket DTOs, Admin DTOs

---

## 🔌 API & Integration

### Real-Time WebSocket Integration

The application uses Pusher for real-time communication:

```javascript
// Frontend WebSocket Connection
window.Echo.private(`ticket.${ticketId}`).listen(".message.sent", (e) => {
    // Handle new message
});
```

### Broadcasting Events

-   **MessageSent**: Broadcasts when a new message is created
-   **Private Channels**: Secure, ticket-specific channels
-   **Event Payload**: Structured JSON with message data

### Queue System

-   **Background Jobs**: Email sending, notifications
-   **Queue Workers**: Process jobs asynchronously
-   **Failed Jobs**: Automatic retry mechanism

---

## 🔒 Security Features

### Authentication Security

-   **Password Hashing**: Bcrypt with configurable rounds
-   **Rate Limiting**: Login attempt throttling (4 attempts/minute)
-   **CSRF Protection**: Token-based CSRF validation
-   **Session Security**: Secure session configuration
-   **Remember Me**: Secure token-based "remember me" functionality

### Authorization

-   **Policy-Based**: Laravel policies for model-level authorization
-   **Middleware Guards**: Route-level access control
-   **Role-Based**: Three-tier permission system
-   **Resource Protection**: Users can only access their own resources

### Data Protection

-   **SQL Injection Prevention**: Eloquent ORM with parameterized queries
-   **XSS Protection**: Blade template auto-escaping
-   **Mass Assignment Protection**: `$guarded` and `$fillable` properties
-   **File Upload Validation**: MIME type and size validation
-   **UUID Primary Keys**: Non-sequential IDs prevent enumeration attacks

### Best Practices

-   **Strict Types**: `declare(strict_types=1)` in all PHP files
-   **Type Hints**: Full type declarations for methods and properties
-   **Validation**: Form request validation for all user input
-   **Error Handling**: Proper exception handling and logging

---

## ⚡ Performance Optimizations

### Database Optimizations

-   **Eager Loading**: Prevents N+1 query problems
-   **Query Scopes**: Reusable, optimized query builders
-   **Indexes**: Database indexes on foreign keys and frequently queried columns
-   **Soft Deletes**: Efficient soft delete implementation

### Caching Strategy

-   **Configuration Caching**: `php artisan config:cache`
-   **Route Caching**: `php artisan route:cache`
-   **View Caching**: Compiled Blade templates

### Frontend Optimizations

-   **Vite Build**: Optimized production builds with code splitting
-   **Asset Optimization**: Minified CSS and JavaScript
-   **Lazy Loading**: Deferred loading of non-critical resources

### Scalability

-   **Hybrid Database**: PostgreSQL for ACID compliance, MongoDB for scalability
-   **Queue System**: Asynchronous job processing
-   **Event-Driven**: Decoupled architecture for horizontal scaling
-   **Load Balancing**: Intelligent agent assignment algorithm

---

## 💻 Development Workflow

### Code Style

The project uses Laravel Pint for code formatting:

```bash
# Format code
./vendor/bin/pint

# Check code style
./vendor/bin/pint --test
```

### Git Workflow

1. Create feature branch: `git checkout -b feature/amazing-feature`
2. Make changes and commit: `git commit -m 'Add amazing feature'`
3. Push to branch: `git push origin feature/amazing-feature`
4. Open Pull Request

### Development Commands

```bash
# Run development servers
composer run dev

# Run tests
composer run test

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

---

## 🧪 Testing

### Test Structure

-   **Unit Tests**: Test individual components in isolation
-   **Feature Tests**: Test complete user workflows
-   **Test Coverage**: PHPUnit with code coverage reporting

### Running Tests

```bash
# Run all tests
composer run test

# Run specific test suite
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

### Test Configuration

-   **Test Database**: SQLite in-memory database for fast tests
-   **Test Environment**: Isolated test environment configuration
-   **Factories**: Model factories for test data generation

---

## 🚢 Deployment

### Production Checklist

1. **Environment Configuration**

    - Set `APP_ENV=production`
    - Set `APP_DEBUG=false`
    - Generate new `APP_KEY`

2. **Optimize Application**

    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    composer install --optimize-autoloader --no-dev
    npm run build
    ```

3. **Database Migration**

    ```bash
    php artisan migrate --force
    ```

4. **Queue Workers**

    - Set up supervisor or systemd service for queue workers
    - Configure queue connection (Redis recommended for production)

5. **Web Server**

    - Configure Nginx or Apache
    - Set up SSL certificates
    - Configure PHP-FPM

6. **Monitoring**
    - Set up error logging
    - Configure application monitoring
    - Set up database backups

### Environment Variables

Ensure all production environment variables are set:

-   Database credentials
-   MongoDB connection string
-   Pusher credentials
-   Mail configuration
-   Queue connection

---

## 🤝 Contributing

Contributions are welcome! This project follows these guidelines:

1. **Fork the repository**
2. **Create a feature branch** (`git checkout -b feature/AmazingFeature`)
3. **Follow code style** (Laravel Pint will be enforced)
4. **Write tests** for new features
5. **Commit changes** (`git commit -m 'Add some AmazingFeature'`)
6. **Push to branch** (`git push origin feature/AmazingFeature`)
7. **Open a Pull Request**

### Contribution Guidelines

-   Follow PSR-12 coding standards
-   Write meaningful commit messages
-   Add tests for new features
-   Update documentation as needed
-   Ensure all tests pass before submitting

---

## 📄 License

This project is open-sourced software licensed under the [MIT License](https://opensource.org/licenses/MIT).

---

## 🙏 Acknowledgments

-   Built with [Laravel](https://laravel.com/) - The PHP Framework for Web Artisans
-   Styled with [Tailwind CSS](https://tailwindcss.com/) - A utility-first CSS framework
-   Real-time powered by [Pusher](https://pusher.com/) - WebSocket infrastructure
-   Database powered by [PostgreSQL](https://www.postgresql.org/) and [MongoDB](https://www.mongodb.com/)

---

## 📞 Support

For support, please:

-   Open an issue in the [GitHub repository](https://github.com/yourusername/HelpDeskly/issues)
-   Check existing issues and discussions
-   Review the documentation

---

<div align="center">

**Built with ❤️ using Laravel 12**

[⭐ Star this repo](https://github.com/yourusername/HelpDeskly) if you find it helpful!

</div>
