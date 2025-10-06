# Changelog

All notable changes to `humano-billing` will be documented in this file.

## [1.0.0] - 2025-10-06

### 🎉 Initial Release

#### Added
- **Complete Billing System**
  - Invoice management with full CRUD operations
  - Payment tracking and management
  - Invoice items and line-level details
  - Invoice download tracking

- **Models**
  - `Invoice` - Main invoice model with enterprise relationships
  - `InvoiceItem` - Line items for invoices
  - `InvoiceType` - Invoice type categorization (purchase/sale)
  - `Payment` - Payment records with transaction tracking
  - `PaymentAccount` - Bank/payment account management
  - `PaymentType` - Payment method types (cash, transfer, credit card, etc.)

- **DataTables**
  - `InvoiceDataTable` - Comprehensive invoice listing with:
    - Translated columns
    - Enterprise and type relationship display
    - Status badges with colors
    - Date formatting (d/m/Y)
    - Amount formatting with proper decimals
    - Sorted by date descending
  - `PaymentDataTable` - Advanced payment listing with:
    - Transaction type indicator (colored dot: red for expense, green for income)
    - Invoice number display
    - Enterprise name display
    - Account and type relationships
    - Amount formatting
    - Status labels with translations
    - Sorted by date descending

- **Enums**
  - `TransactionType` - Type-safe transaction types (income/expense) with:
    - `label()` method for translated display
    - `color()` method for badge colors
    - `badge()` method for HTML badge rendering

- **Controllers**
  - `InvoiceController` - Invoice management
  - `PaymentController` - Payment management
  - `AccountingController` - Accounting views and reports

- **Migrations**
  - `create_payment_types_table` - Payment method types
  - `create_invoice_types_table` - Invoice categorization
  - `create_invoices_table` - Main invoices table
  - `create_invoice_items_table` - Invoice line items
  - `create_invoice_downloads_table` - Download tracking
  - `create_payments_table` - Payments with ENUM transaction types

- **Factories**
  - `InvoiceFactory` - Generate test/demo invoices
  - `PaymentFactory` - Generate test/demo payments with proper team handling

- **Seeders**
  - `InvoiceTypeSeeder` - Seed invoice types
  - `PaymentTypeSeeder` - Seed 16 payment types including:
    - Cash, Bank Transfer, Bank Deposit
    - Check, Debit, Credit Card
    - PayPal, Stripe, Zelle
    - Venmo, Cash App, MercadoPago
    - Bank Draft, Wire Transfer, Other, N/A

- **Views**
  - Accounting dashboard views
  - Invoice index and show views
  - Payment index view
  - Blade components for consistency

- **Features**
  - Full Laravel 10+ compatibility
  - Team-based multi-tenancy support
  - Spatie Permission integration
  - Activity logging with `spatie/laravel-activitylog`
  - Stripe integration via Laravel Cashier
  - Comprehensive translations (English/Spanish)
  - Proper foreign key relationships
  - Global scopes for team isolation

#### Technical Details
- **PHP**: ^8.1
- **Laravel**: ^10.0 || ^11.0 || ^12.0
- **Database**: MySQL with proper indexes and foreign keys
- **Architecture**: Package-based modular design
- **Namespacing**: `Idoneo\HumanoBilling`
- **Service Provider**: Auto-discovery enabled
- **Migrations**: Publishable via `humano-billing-migrations` tag

#### Database Schema
- `payment_types` - 16 predefined payment methods
- `invoice_types` - Purchase/Sale categorization
- `invoices` - Main billing records
- `invoice_items` - Detailed line items
- `invoice_downloads` - Download tracking
- `payments` - Transaction records with:
  - ENUM `transaction_type` (income/expense)
  - DATE `date` field (not datetime)
  - Foreign keys to enterprises, invoices, accounts
  - Status tracking
  - Amount with decimals (15,2)

#### Import System Integration
- Seamless integration with `ImportDataCommand`
- Daily synchronization support
- Handles legacy data migration from remote databases
- Proper relationship mapping (enterprises ↔ invoices ↔ payments)
- Batch processing with progress tracking

### Fixed
- Payment date field changed from `datetime` to `date` for consistency
- Transaction type changed from single char ('I'/'E') to ENUM for type safety
- Removed foreign key from `enterprises.payment_type_id` (index only)
- Fixed migration order to prevent foreign key conflicts
- Corrected DataTable margins and styling
- Enhanced payment-enterprise-invoice relationship mapping

### Changed
- Moved all billing models from main app to package
- Consolidated DataTables in package namespace
- Updated factories with Demo Team support
- Improved translation coverage (20+ new keys)
- Enhanced payment import logic with multiple enterprise resolution strategies

### Security
- AGPL-3.0 License
- Team-based authorization via Laravel Policies
- Permission-based access control
- SQL injection protection via Eloquent ORM

---

## Development Notes

### Versioning
This package follows [Semantic Versioning](https://semver.org/).

### Contributing
Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

### Credits
- **Author**: Diego Adrián Mascarenhas Goytía
- **Email**: diego.mascarenhas@icloud.com
- **License**: AGPL-3.0

### Links
- **GitHub**: https://github.com/diego-mascarenhas/humano-billing
- **Documentation**: Coming soon
- **Issues**: https://github.com/diego-mascarenhas/humano-billing/issues
