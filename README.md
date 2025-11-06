# Laravel Company Management System

A complete Laravel application with authentication and company CRUD operations.

## Features

- User Authentication (Sign Up & Login)
- Company CRUD Operations
- Image Upload (Company Logo)
- Country, State, City Dropdowns
- Multiple Services Selection
- Multiple Branch Selection
- Responsive UI with Tailwind CSS

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js & NPM

## Installation Steps

### 1. Clone the Repository

```bash
git clone 
cd bsp-company
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=company_management
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Create Database

```bash
mysql -u root -p
CREATE DATABASE company_management;
exit;
```

### 5. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

### 6. Create Storage Link

```bash
php artisan storage:link
```

### 7. Build Assets

```bash
npm run dev
```

### 8. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Project Structure

```
app/
├── Http/
│   ├── Controllers/
│      ├── Auth/
│      │   ├── LoginController.php
│      │   └── RegisterController.php
│      ├── CompanyController.php
│      └── LocationController.php
├── Models/
   ├── User.php
   ├── Company.php
   ├── Country.php
   ├── State.php
   ├── City.php
   ├── Service.php
   ├── CompanyService.php
   ├── BranchCompany.php
   └── Branch.php

database/
├── migrations/
│   ├── create_users_table.php
│   ├── create_companies_table.php
│   ├── create_countries_table.php
│   ├── create_states_table.php
│   ├── create_cities_table.php
│   ├── create_services_table.php
│   ├── create_branches_table.php
│   └── create_pivot_tables.php
└── seeders/
    ├── CountrySeeder.php
    ├── ServiceSeeder.php
    └── BranchSeeder.php

resources/
├── views/
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── companies/
│   │   ├── index.blade.php
│   │   ├── create.blade.php
│   │   ├── edit.blade.php
│   │   └── show.blade.php
│   └── layouts/
│       └── app.blade.php

routes/
└── web.php
```

## Database Schema

### Users Table
- id
- name
- email (unique)
- password
- timestamps

### Companies Table
- id
- user_id (foreign key)
- logo (nullable)
- name
- email
- mobile
- country_id (foreign key)
- state_id (foreign key)
- city_id (foreign key)
- timestamps

### Pivot Tables
- company_service (company_id, service_id)
- branch_company (company_id, branch_id)

### Reference Tables
- countries (id, name, code)
- states (id, country_id, name)
- cities (id, state_id, name)
- services (id, name)
- branches (id, name)

## Key Features Implementation

### 1. Authentication
- Laravel's built-in authentication
- Custom controllers for registration and login
- Password hashing using bcrypt
- Session-based authentication
- CSRF protection

### 2. Company CRUD
- **Create**: Form with all fields including file upload
- **Read**: List view with pagination and show details
- **Update**: Edit form pre-filled with existing data
- **Delete**: Soft delete with confirmation

### 3. Dropdowns
- AJAX-based state loading based on country selection
- AJAX-based city loading based on state selection
- Real-time updates without page refresh

### 4. File Upload
- Company logo upload
- Image validation (type, size)
- Storage in public disk

### 5. Multiple Selection
- Services: Checkbox group with validation
- Branches: Checkbox group with validation
- Many-to-many relationships

## Security Features

### 1. SQL Injection Prevention
- Eloquent ORM with parameter binding
- Query builder with prepared statements
- Input sanitization

### 2. XSS Protection
- Blade templating with automatic escaping
- `{{ }}` syntax for output
- `{!! !!}` only for trusted content

### 3. CSRF Protection
- `@csrf` directive in all forms
- Automatic token verification
- Token refresh on every request

### 4. Authentication
- Middleware protection on routes
- Password hashing
- Session management

### 5. File Upload Security
- File type validation
- File size limits
- Secure storage path
- Random filename generation

### 6. Mass Assignment Protection
- `$fillable` properties in models
- Request validation
- No direct input usage

## Performance Optimization

### 1. Database Queries
- Eager loading to prevent N+1 queries
- Indexed foreign keys
- Proper relationship definitions

### 2. Caching
- Query result caching for countries/services/branches
- View caching in production

### 3. Image Optimization
- Image intervention library
- Thumbnail generation
- Lazy loading

## API Endpoints

### Authentication
- `GET /register` - Show registration form
- `POST /register` - Register new user
- `GET /login` - Show login form
- `POST /login` - Authenticate user
- `POST /logout` - Logout user

### Companies
- `GET /companies` - List all companies
- `GET /companies/create` - Show create form
- `POST /companies` - Store new company
- `GET /companies/{id}` - Show company details
- `GET /companies/{id}/edit` - Show edit form
- `PUT /companies/{id}` - Update company
- `DELETE /companies/{id}` - Delete company

### AJAX Endpoints
- `GET /api/states/{country_id}` - Get states by country
- `GET /api/cities/{state_id}` - Get cities by state

## Testing

### Run Tests
```bash
php artisan test
```

### Test Coverage
- Unit tests for models
- Feature tests for controllers
- Browser tests for UI flows

## Libraries & Third-Party Services

### Backend
1. **Laravel 11.x**: Core framework

### Frontend
1. **Tailwind CSS**: Styling framework

### Development
1. **Laravel Pint**: Code formatting
3. **Laravel Debugbar**: Debugging

## Challenges & Solutions

### Challenge 1: Dynamic Cascading Dropdowns
**Problem**: Loading states and cities dynamically based on parent selection.

**Solution**: 
- Implemented AJAX endpoints for states and cities
- Used Alpine.js for reactive updates
- Cached country/state/city data for performance

### Challenge 2: Multiple File Upload with Validation
**Problem**: Validating and storing company logos securely.

**Solution**:
- Used Laravel's storage facade
- Implemented custom validation rules
- Generated unique filenames to prevent conflicts
- Created symbolic link for public access

### Challenge 3: Many-to-Many Relationships
**Problem**: Managing multiple services and branches per company.

**Solution**:
- Created pivot tables with proper foreign keys
- Used Eloquent's `sync()` method for updates
- Implemented eager loading to prevent N+1 queries

### Challenge 4: Form Validation
**Problem**: Complex validation rules for company creation/update.

**Solution**:
- Created custom FormRequest class
- Implemented conditional validation rules
- Added custom error messages
- Used AJAX validation for better UX

### Challenge 5: Responsive UI
**Problem**: Creating a mobile-friendly interface.

**Solution**:
- Used Tailwind CSS responsive utilities
- Implemented mobile-first design
- Added hamburger menu for mobile
- Tested across different screen sizes

## Architecture Overview

### MVC Pattern
- **Models**: Handle data and business logic
- **Views**: Blade templates for UI
- **Controllers**: Handle HTTP requests and responses

### Repository Pattern (Optional)
- Abstraction layer between controllers and models
- Easier testing and maintenance
- Swappable data sources

### Service Layer
- Business logic separation
- Reusable code
- Single Responsibility Principle

### Request Validation
- Form Request classes
- Centralized validation rules
- Custom error messages

## Best Practices Followed

1. **Code Organization**: Clear folder structure and file naming
2. **Naming Conventions**: PSR-12 coding standards
3. **Documentation**: Inline comments and PHPDoc blocks
4. **Error Handling**: Try-catch blocks and proper error messages
5. **Validation**: Server-side and client-side validation
6. **Security**: Input sanitization and output escaping
7. **Performance**: Query optimization and caching
8. **Maintainability**: DRY principle and SOLID principles

## Future Enhancements

1. API with authentication tokens
2. Advanced search and filtering
3. Export to Excel/PDF
4. Email notifications
5. Role-based access control
6. Activity logs
7. Company reports and analytics
8. Multi-language support

## Troubleshooting

### Common Issues

**Issue**: Storage link not working
```bash
php artisan storage:link
```

**Issue**: Permission denied for storage
```bash
chmod -R 775 storage bootstrap/cache
```

**Issue**: Migrations failing
```bash
php artisan migrate:fresh --seed
```

**Issue**: Assets not loading
```bash
npm run build
php artisan optimize:clear
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is open-sourced software licensed under the MIT license.

## Contact

For any queries or issues, please create an issue in the GitHub repository.

---

**Note**: Make sure to configure your environment variables properly before running the application. Never commit `.env` file to version control.
