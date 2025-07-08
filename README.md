# Inventory Management System
A Laravel-based inventory management system with authentication, product management, category management, brand management, and stock tracking.
## Features
- User authentication
- Product CRUD operations with image upload
- Category and Brand management
- Stock adjustment (increase/decrease)
- Search and filter products
- Export to Excel
- Pagination
- Soft deletes for products
- Total stock value calculation
## Installation
1. Clone the repository:
   git clone https://github.com/yourusername/inventory-system.git
   cd inventory-system
2. Install dependencies:  
   composer install
   npm install
3. Create and configure the .env file:
   cp .env.example .env
 4. Generate application key:    
    php artisan key:generate
 5. Run migrations and seed the database:  
    php artisan migrate --seed
 6.Create a symbolic link for storage:
    php artisan storage:link
 7. Compile frontend assets:
    npm run dev or npm run build
8. Start the development server:
    php artisan serve

## Usage
1. Access the application at http://localhost:8000
2. Register a new user or log in with existing credentials
3. Navigate through the menu to manage products, categories, and brands

## Testing
To run the test:
- php artisan test
## License

This project is open-source and available under the MIT License. [MIT license](https://opensource.org/licenses/MIT).
