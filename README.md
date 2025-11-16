# HelpDeskly

A modern, full-featured help desk and ticketing system built with Laravel 12. HelpDeskly provides a comprehensive solution for managing customer support tickets with role-based access control, real-time messaging, and intelligent agent assignment.

## Features

### 🎫 Ticket Management
- **Create and manage tickets** with subjects, descriptions, and attachments
- **Ticket statuses**: Open, In Progress, Resolved, Closed
- **Priority levels**: Low, Medium, High
- **Category organization** for better ticket classification
- **Ticket filtering** by status, priority, and category

### 👥 Role-Based Access Control
- **Customer**: Create tickets, view own tickets, communicate with agents
- **Agent**: Manage assigned tickets, respond to customers, update ticket status
- **Admin**: Full system access, manage categories, view all tickets, system administration

### 💬 Real-Time Communication
- **Live messaging** between customers and agents using Pusher
- **Message history** stored in MongoDB for scalability
- **Instant notifications** for new messages

### 🤖 Intelligent Agent Assignment
- **Automatic agent assignment** based on availability
- **Load balancing** - assigns tickets to agents with fewer active tickets
- **Online/offline status** tracking for agents
- **Maximum ticket limit** per agent to ensure fair distribution

### 📎 File Attachments
- **Support for file attachments** on tickets
- **Secure file storage** and management

### 🔐 Authentication & Security
- **User registration and login** with email verification
- **Password hashing** and secure authentication
- **Session management** and remember me functionality
- **Rate limiting** on login attempts

## Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade templates with Tailwind CSS 4
- **Database**: 
  - PostgreSQL for primary data (users, tickets, categories)
  - MongoDB for ticket messages (scalable messaging)
- **Real-time**: Pusher for WebSocket connections
- **Build Tool**: Vite
- **Code Quality**: Laravel Pint

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js and npm
- PostgreSQL database
- MongoDB (for ticket messages)
- Pusher account (for real-time features)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/HelpDeskly.git
   cd HelpDeskly
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your `.env` file**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=helpdeskly
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

   MONGODB_URI=mongodb://localhost:27017
   MONGODB_DATABASE=helpdeskly

   PUSHER_APP_ID=your_pusher_app_id
   PUSHER_APP_KEY=your_pusher_key
   PUSHER_APP_SECRET=your_pusher_secret
   PUSHER_APP_CLUSTER=your_pusher_cluster
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database** (optional)
   ```bash
   php artisan db:seed
   ```

8. **Build frontend assets**
   ```bash
   npm run build
   ```

## Development

### Quick Setup
Use the provided setup script:
```bash
composer run setup
```

### Development Server
Run the development server with hot reloading:
```bash
composer run dev
```

This command runs:
- Laravel development server
- Queue worker
- Vite dev server

### Running Tests
```bash
composer run test
```

## Project Structure

```
HelpDeskly/
├── app/
│   ├── Actions/          # Action classes for business logic
│   ├── Console/          # Artisan commands
│   ├── DTOs/             # Data Transfer Objects
│   ├── Enums/            # Enum classes (Roles, TicketStatus, etc.)
│   ├── Events/           # Event classes
│   ├── Http/
│   │   ├── Controllers/  # Application controllers
│   │   ├── Middleware/   # Custom middleware
│   │   ├── Requests/     # Form request validation
│   │   └── Resources/    # API resources
│   ├── Interfaces/       # Service interfaces
│   ├── Models/           # Eloquent models
│   ├── Policies/         # Authorization policies
│   ├── Providers/        # Service providers
│   ├── Queries/          # Query builder classes
│   ├── Services/         # Business logic services
│   ├── Traits/           # Reusable traits
│   └── Utilities/        # Utility classes
├── database/
│   ├── migrations/       # Database migrations
│   └── seeders/          # Database seeders
├── resources/
│   ├── views/            # Blade templates
│   ├── css/              # Stylesheets
│   └── js/               # JavaScript files
└── routes/               # Route definitions
```

## Key Components

### Models
- **User**: Represents users with roles (Customer, Agent, Admin)
- **Ticket**: Main ticket entity with status, priority, and relationships
- **TicketMessage**: Messages within tickets (stored in MongoDB)
- **Category**: Ticket categories for organization
- **TicketAttachment**: File attachments for tickets

### Services
- **AuthService**: Handles authentication logic
- **TicketManager**: Manages ticket operations and agent assignment
- **ImageManager**: Handles image uploads and processing

### Enums
- **Roles**: Customer, Agent, Admin
- **TicketStatus**: Open, In Progress, Resolved, Closed
- **TicketPriority**: Low, Medium, High
- **ActivityStatus**: Online, Offline

## Usage

### For Customers
1. Register an account or log in
2. Create a new ticket with subject, description, and category
3. Attach files if needed
4. Communicate with assigned agents through the messaging system
5. Track ticket status and updates

### For Agents
1. Log in to the agent dashboard
2. View assigned tickets
3. Update ticket status and priority
4. Respond to customer messages
5. Manage ticket lifecycle

### For Admins
1. Access the admin dashboard
2. Manage ticket categories
3. View all tickets across the system
4. Monitor system activity
5. Manage users and roles

## Configuration

### Agent Assignment
The system automatically assigns tickets to available agents based on:
- Agent online status
- Current ticket load (maximum tickets per agent)
- Load balancing algorithm

Configure the maximum tickets per agent in `app/Utilities/Constants.php`.

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Support

For support, please open an issue in the GitHub repository or contact the development team.

---

Built with ❤️ using Laravel
