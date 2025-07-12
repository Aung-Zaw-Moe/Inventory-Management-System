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

- **User Authentication**
  - Registration and login system
  - Password reset functionality

- **Product Management**
  - Complete CRUD operations
  - Image upload and storage
  - Soft delete functionality
  - Search and filtering

- **Inventory Control**
  - Category and Brand management
  - Stock adjustment (increase/decrease)
  - Real-time stock level tracking
  - Total inventory value calculation

- **Data Handling**
  - Export to Excel functionality
  - Pagination for large datasets

## Technology Stack

- **Backend**: Laravel 12
- **Frontend**: Bootstrap, jQuery
- **Database**: MySQL
- ### Prerequisites
- PHP 8.2.12+
- Composer
- Node.js 14.x+
- MySQL 5.7+
## Installation
1. Clone the repository:
   git clone https://github.com/Aung-Zaw-Moe/Inventory-Management-System.git
   cd Inventory-Management-System
2. Install dependencies:  
   - composer install
   - npm install
3. Create and configure the .env file:
   - cp .env.example .env
4. Generate application key:    
   - php artisan key:generate
5. Run migrations and seed the database:  
    - php artisan migrate --seed
6.Create a symbolic link for storage:
    - php artisan storage:link
7. Compile frontend assets:
    - npm run dev or npm run build
8. Start the development server:
    - php artisan serve

## Usage
1. Access the application at http://localhost:8000
2. Register a new user or log in with existing credentials
   - Email: admin@example.com
   - Password: password
3. Navigate through the menu to manage products, categories, and brands
   
## Troubleshooting
- composer config -g -- disable-tls true
## License
This project is open-source and available under the MIT License. [MIT license](https://opensource.org/licenses/MIT).

## ဤဖိုင်တွင်:

1. Installation steps အားလုံးကို အစအဆုံးထည့်ပေးထားပါတယ်
2. အသုံးပြုနည်းလမ်းညွှန်ကို ရှင်းလင်းစွာရေးထားပါတယ်
3. SSL error ဖြေရှင်းနည်းကိုပါ ထည့်ပေးထားပါတယ်
4. License နဲ့ contact information တွေကိုလည်း ပြည့်စုံစွာထည့်ပေးထားပါတယ်
