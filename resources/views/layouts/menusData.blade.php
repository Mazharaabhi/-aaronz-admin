{{-- For Developer Section --}}
{{-- $operation_name = [
    'Paytabs Json',
    'Errors',
];

$data_id = [
    "paytabs_json",
    "errors",
];

$admin_routes = [
    "route('admin.developer-section.index')",
    "route('admin.developer-section.errors.index')",

];

$company_routes = [
    "",
    "",
];

$is_add = [
    0,
    0,
];

$is_view = [
    1,
    1,
];
$is_edit = [
    0,
    0,
];
$is_delete = [
    0,
    0,
];
$is_status = [
    0,
    0,
];

$is_admin = [
    1,
    1,
];

$is_company = [
    0,
    0,
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 11;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data_id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}
{{-- For Accounts --}}
{{-- $operation_name = [
    'Profit Account',
    'Liabilities',
    'Journal Entries',
    'Super Journal',
    'Currency Rate',
    'Withdrawals',
];

$data_id = [
    "profit_account",
    "liabilities",
    "journal",
    "super_journal",
    "currency_rate",
    "withdrawals",
];

$admin_routes = [
    "route('admin.accounts.profit-account.index')",
    "route('admin.accounts.liabilites.index')",
    "route('admin.accounts.journal-entries.index')",
    "route('admin.accounts.super-journal-entries.index')",
    "",
    "",

];

$company_routes = [
    "",
    "",
    "",
    "route('portal.accounts.journal-entries.index')",
    "route('portal.accounts.currency.index')",
    "route('portal.accounts.withdrawal.index')",
];

$is_add = [
    0,
    0,
    0,
    0,
    0,
    1,
];

$is_view = [
    1,
    1,
    1,
    1,
    1,
    1,
];
$is_edit = [
    0,
    0,
    0,
    0,
    0,
    0,
];
$is_delete = [
    0,
    0,
    0,
    0,
    0,
    0,
];
$is_status = [
    0,
    0,
    0,
    0,
    0,
    0,
];

$is_admin = [
    1,
    1,
    1,
    1,
    0,
    0,
];

$is_company = [
    0,
    0,
    1,
    0,
    1,
    1,
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 10;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data_id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}
{{-- For Email Module --}}
{{-- $operation_name = [
    'Email Category',
    'Branded Email',
    'Email Settings',
    'Email Template',
];

$data_id = [
    "email_category",
    "branded_email",
    "email_settings",
    "email_template",
];

$admin_routes = [
    "route('admin.email.email-category.index')",
    "route('admin.email.branded-email.index')",
    "route('admin.email.email-setting.index')",
    "route('admin.email.email-template.index')"
];

$company_routes = [
    "",
    "route('portal.email.branded-email.index')",
    "route('portal.email.email-setting.index')",
    "route('portal.email.email-template.index')"
];

$is_add = [
    1,
    1,
    0,
    0
];

$is_view = [
    1,
    1,
    1,
    1
];
$is_edit = [
    1,
    1,
    1,
    1,
];
$is_delete = [
    0,
    0,
    0,
    0,
];
$is_status = [
    1,
    0,
    0,
    0,
];

$is_admin = [
    1,
    1,
    1,
    1
];

$is_company = [
    0,
    1,
    1,
    1,
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 9;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data_id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}
{{-- For Settings Module --}}
{{-- $operation_name = [
    'Account Configurations',
    'General Settings'
];

$data_id = [
    "paytabs_config",
    "profile_settings",
];

$admin_routes = [
    "",
    ""
];

$company_routes = [
    "route('portal.configurations.paytabs-config.index')",
    "route('portal.profile.index')",
];

$is_add = [
    1,
    0

];

$is_view = [
    1,
    1,

];
$is_edit = [
    1,
    0,
];
$is_delete = [
    0,
    0,
];
$is_status = [
    1,
    0,
];

$is_admin = [
    0,
    0,
];

$is_company = [
    1,
    1,
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 8;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data_id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}



{{-- For Configurations Module  --}}
{{-- $operation_name = [
    'MyridePay Account',
    'Profile Settings',
    'Currency',
];

$data_id = [
    "paytabs_config",
    "profile_settings",
    "currency",
];

$admin_routes = [
    "route('admin.configurations.paytabs-config.index')",
    "route('admin.profile.index')",
    "route('admin.configurations.currency.index')"
];

$company_routes = [
    "",
    "",
    "",
];

$is_add = [
    1,
    0,
    1,

];

$is_view = [
    1,
    1,
    1,

];
$is_edit = [
    1,
    0,
    1
];
$is_delete = [
    0,
    0,
    0
];
$is_status = [
    1,
    0,
    1
];

$is_admin = [
    1,
    1,
    1
];

$is_company = [
    0,
    0,
    0,
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 7;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data_id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
}



{{-- For Customers --}}
{{-- $operation_name = [
    'Manage Customers'
];

$data_id = [
    "manage_customer",
];

$admin_routes = [
    "route('admin.customers.manage-customer.index')",
];

$company_routes = [
    "route('portal.customers.manage-customer.index')",
];

$is_add = [
    0

];

$is_view = [
    1

];
$is_edit = [
    1
];
$is_delete = [
    0
];
$is_status = [
    0
];

$is_admin = [
    1
];

$is_company = [
    1
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 6;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data_id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}
{{-- FOr Transactions --}}
{{-- $operation_name = [
    'Transaction'
];

$data_id = [
    "pay_links",
];

$admin_routes = [
    "route('admin.customers.manage-customer.index')",
];

$company_routes = [
    "route('portal.paylinks.transactions.index')",
];

$is_add = [
    0

];

$is_view = [
    1

];
$is_edit = [
    0
];
$is_delete = [
    0
];
$is_status = [
    0
];

$is_admin = [
    1
];

$is_company = [
    1
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 5;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data_id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}
{{-- For Invoices --}}
{{-- $operation_name = [
    'Invoice'
];

$data_id = [
    "invoices",
];

$admin_routes = [
    "route('admin.invoices.invoice.index')",
];

$company_routes = [
    "route('admin.invoices.invoice.index')",
];

$is_add = [
    1

];

$is_view = [
    1

];
$is_edit = [
    0
];
$is_delete = [
    0
];
$is_status = [
    0
];

$is_admin = [
    1
];

$is_company = [
    1
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 4;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->data-id                   = $data_id[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}
{{-- For Companies Module  --}}


{{-- $operation_name = [
    'Manage Companies',
    'Companies Customers',
    'Companies Transactions',
    'Withdrawal Requests',
    'Packages'
];

$data_id = [
    "manage_companies",
    "companies_customers",
    "companies_transactions",
    "withdrawal_requests",
    "packages",
];

$admin_routes = [
    "route('admin.companies.manage-companies.index')",
    "",
    "route('admin.companies.companies-transactions.index')",
    "route('admin.companies.withdrawal-requests.index')",
    "route('admin.companies.packages.index')",
];

$company_routes = [
    "",
    "",
    "",
    "",
    "",
];

$is_add = [
    1,
    0,
    0,
    0,
    1,

];

$is_view = [
    1,
    0,
    1,
    1,
    1,

];
$is_edit = [
    1,
    0,
    0,
    0,
    1,
];
$is_delete = [
    1,
    0,
    0,
    0,
    0,
];
$is_status = [
    1,
    0,
    0,
    1,
    0
];

$is_admin = [
    1,
    1,
    1,
    1,
    1
];

$is_company = [
    0,
    0,
    0,
    0,
    0
];


for ($i = 0; $i < count($operation_name); $i++) {
    $operation = new \App\Models\Administrator\Operation;
    $operation->module_id                 = 3;
    $operation->name                      = $operation_name[$i];
    $operation->is_view                   = $is_view[$i];
    $operation->is_add                   = $is_add[$i];
    $operation->is_edit                   = $is_edit[$i];
    $operation->is_delete                   = $is_delete[$i];
    $operation->is_status                   = $is_status[$i];
    $operation->admin_route               = $admin_routes[$i];
    $operation->company_route             = $company_routes[$i];
    $operation->is_company                   = $is_company[$i];
    $operation->is_admin                   = $is_admin[$i];
    $operation->save();
} --}}

{{-- For Modules --}}

{{-- $modules_names = [
    'Dashboard',
    'Administrator',
    'Companies',
    'Invoices',
    'Transactions',
    'Customers',
    'Configurations',
    'Settings',
    'Email',
    'Accounts',
    'Developer Section',

];

$is_admin = [
    1,
    1,
    1,
    1,
    1,
    1,
    1,
    0,
    1,
    1,
    1,
];

$is_company = [
    1,
    1,
    0,
    1,
    1,
    1,
    0,
    1,
    1,
    1,
    0
];


$admin_routes = [
" route('admin.dashboard.index') ",
"",
" route('admin.companies.manage-companies.index') ",
" route('admin.invoices.invoice.index') ",
" route('admin.paylinks.transactions.index') ",
" route('admin.customers.manage-customer.index') ",
" route('admin.configurations.paytabs-config.index') ",
"",
" route('admin.email.email-category.index') ",
" route('admin.accounts.profit-account.index') ",
" route('admin.developer-section.index') ",
];

$company_routes = [
" route('portal.dashboard.index') ",
"",
"",
" route('portal.invoices.invoice.index') ",
" route('portal.paylinks.transactions.index') ",
" route('portal.customers.manage-customer.index') ",
"",
" route('portal.configurations.paytabs-config.index') ",
" route('portal.email.email-category.index') ",
" route('portal.accounts.profit-account.index') ",
""
];

for ($i = 0; $i < count($modules_names); $i++) {
    $module = new \App\Models\Administrator\Module;
    $module->fill( [
        'name'                       => $modules_names[$i],
        'admin_route'                     => $admin_routes[$i],
        'company_route'                     => $company_routes[$i],
    ] );
    $module->save(); --}}
