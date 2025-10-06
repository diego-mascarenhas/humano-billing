# Humano Billing Package

[![Latest Version](https://img.shields.io/badge/version-1.0.0-blue.svg)](CHANGELOG.md)
[![Laravel](https://img.shields.io/badge/Laravel-10%20%7C%2011%20%7C%2012-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1%2B-purple.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-AGPL--3.0-green.svg)](LICENSE)

Comprehensive billing and payment management system for Humano applications. This package provides a complete solution for managing invoices, payments, and accounting operations with multi-tenant support.

---

## 📦 Features

### Core Functionality
- ✅ **Invoice Management** - Full CRUD operations for invoices
- ✅ **Payment Tracking** - Comprehensive payment records with transaction types
- ✅ **Multi-Tenant** - Team-based isolation with global scopes
- ✅ **DataTables Integration** - Beautiful, searchable, sortable tables
- ✅ **Type Safety** - PHP 8.1 ENUMs for transaction types
- ✅ **Stripe Integration** - Via Laravel Cashier
- ✅ **Activity Logging** - Track all billing changes
- ✅ **Permissions** - Spatie Permission integration
- ✅ **Translations** - English and Spanish support

### Models
- `Invoice` - Main invoice records
- `InvoiceItem` - Line items for detailed billing
- `InvoiceType` - Purchase/Sale categorization
- `Payment` - Transaction records with status tracking
- `PaymentAccount` - Bank and payment account management
- `PaymentType` - 16 predefined payment methods

### Payment Methods Supported
1. Cash
2. Bank Transfer
3. Bank Deposit
4. Check
5. Debit Card
6. Credit Card
7. PayPal
8. Stripe
9. Zelle
10. Venmo
11. Cash App
12. MercadoPago
13. Bank Draft
14. Wire Transfer
15. Other
16. N/A

---

## 📋 Requirements

- PHP 8.1 or higher
- Laravel 10.x, 11.x, or 12.x
- MySQL 5.7+ or MariaDB 10.3+
- Composer

---

## 🚀 Installation

### Step 1: Install via Composer

```bash
composer require idoneo/humano-billing
```

### Step 2: Publish Migrations

```bash
php artisan vendor:publish --tag="humano-billing-migrations"
```

### Step 3: Run Migrations

```bash
php artisan migrate
```

### Step 4: Publish Configuration (Optional)

```bash
php artisan vendor:publish --tag="humano-billing-config"
```

### Step 5: Publish Views (Optional)

```bash
php artisan vendor:publish --tag="humano-billing-views"
```

---

## 📖 Usage

### Basic Invoice Creation

```php
use Idoneo\HumanoBilling\Models\Invoice;

$invoice = Invoice::create([
    'team_id' => auth()->user()->currentTeam->id,
    'enterprise_id' => $enterprise->id,
    'number' => 'INV-2025-001',
    'type_id' => 2, // Sale invoice
    'issue_date' => now(),
    'due_date' => now()->addDays(30),
    'subtotal' => 1000.00,
    'tax' => 150.00,
    'total' => 1150.00,
    'status' => 1, // Draft
]);
```

### Adding Invoice Items

```php
use Idoneo\HumanoBilling\Models\InvoiceItem;

InvoiceItem::create([
    'invoice_id' => $invoice->id,
    'service_id' => $service->id,
    'description' => 'Web Hosting - Monthly',
    'quantity' => 1,
    'unit_price' => 1000.00,
    'total' => 1000.00,
]);
```

### Recording Payments

```php
use Idoneo\HumanoBilling\Models\Payment;
use Idoneo\HumanoBilling\Enums\TransactionType;

$payment = Payment::create([
    'team_id' => auth()->user()->currentTeam->id,
    'enterprise_id' => $enterprise->id,
    'invoice_id' => $invoice->id,
    'transaction_type' => TransactionType::INCOME,
    'date' => now(),
    'amount' => 1150.00,
    'type_id' => 2, // Bank Transfer
    'account_id' => $account->id,
    'status' => 2, // Approved
    'remarks' => 'Payment received',
]);
```

### Using Transaction Type ENUM

```php
use Idoneo\HumanoBilling\Enums\TransactionType;

// Get label
echo TransactionType::INCOME->label(); // "Income"
echo TransactionType::EXPENSE->label(); // "Expense"

// Get color
echo TransactionType::INCOME->color(); // "success"
echo TransactionType::EXPENSE->color(); // "danger"

// Get badge HTML
echo TransactionType::INCOME->badge(); // <span class="badge..."></span>
```

---

## 🎨 DataTables

### Invoice DataTable

```php
use Idoneo\HumanoBilling\DataTables\InvoiceDataTable;

public function index(InvoiceDataTable $dataTable)
{
    return $dataTable->render('humano-billing::invoices.index');
}
```

### Payment DataTable

```php
use Idoneo\HumanoBilling\DataTables\PaymentDataTable;

public function index(PaymentDataTable $dataTable)
{
    return $dataTable->render('humano-billing::payments.index');
}
```

---

## 🗄️ Database Schema

### Invoices Table
- `id` - Primary key
- `team_id` - Foreign key to teams
- `enterprise_id` - Foreign key to enterprises
- `number` - Invoice number (unique per team)
- `type_id` - Foreign key to invoice_types
- `issue_date` - Invoice issue date
- `due_date` - Payment due date
- `subtotal` - Subtotal amount
- `tax` - Tax amount
- `total` - Total amount
- `status` - Invoice status

### Payments Table
- `id` - Primary key
- `team_id` - Foreign key to teams
- `enterprise_id` - Foreign key to enterprises
- `invoice_id` - Foreign key to invoices (nullable)
- `transaction_type` - ENUM (income, expense)
- `date` - Payment date
- `amount` - Payment amount (decimal 15,2)
- `type_id` - Foreign key to payment_types
- `account_id` - Foreign key to payment_accounts
- `status` - Payment status
- `remarks` - Additional notes

---

## 🔐 Permissions

The package respects Laravel's authorization system. Make sure to define appropriate policies:

```php
// In AuthServiceProvider
use Idoneo\HumanoBilling\Models\Invoice;
use App\Policies\InvoicePolicy;

protected $policies = [
    Invoice::class => InvoicePolicy::class,
];
```

---

## 🌍 Translations

The package includes translations for English and Spanish. Add your own translations by publishing the language files:

```bash
php artisan vendor:publish --tag="humano-billing-lang"
```

---

## 🧪 Testing

```bash
cd packages/humano-billing
composer test
```

---

## 📝 Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

---

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

---

## 🔒 Security

If you discover any security-related issues, please email diego.mascarenhas@icloud.com instead of using the issue tracker.

---

## 👨‍💻 Credits

- **Diego Adrián Mascarenhas Goytía** - [GitHub](https://github.com/diego-mascarenhas)

---

## 📄 License

The AGPL-3.0 License. Please see [License File](LICENSE) for more information.

---

## 💡 Support

For support, email diego.mascarenhas@icloud.com or open an issue on GitHub.

---

Made with ❤️ by [IDONEO](https://idoneo.net)
