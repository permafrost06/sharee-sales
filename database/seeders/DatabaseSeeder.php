<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::insert(
            "INSERT INTO `users` (`id`, `name`, `username`, `phone`, `type`, `gender`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
            (1, 'admin', NULL, NULL, 'admin', NULL, 'admin@admin.com', NULL, '$2y$10\$pqSsKcTaktmaiubX/.ZhP.6fuz8IxHqyo8jBiiB3YEMwCUFCn1CrW', 'woKxxNKYi4QEDvmi0tjqJbx8CqibJonpUHE10E4rgYQHAPApi7jfLqA5kSHP', '2019-09-09 23:10:28', '2019-09-09 23:10:28')"
        );

        DB::insert(
            "INSERT INTO `sales` (`id`, `customer_id`, `date`, `memo_number`, `goods_of_issues`, `lv`, `received_money`, `balance_due`, `comment`, `created_at`, `updated_at`) VALUES
            (4, 2, '09/02/2019', '123456', 33.00, 33.00, 32.00, 1.00, NULL, '2019-09-14 07:17:58', '2019-09-14 07:17:58'),
            (5, 3, '09/14/2019', '1234', 234.00, 43.00, 200.00, 34.00, NULL, '2019-09-15 03:45:26', '2019-09-15 03:45:26'),
            (9, 1, '09/16/2019', '123456', 21.00, 1.00, 1.00, 1.00, NULL, '2019-09-16 13:54:47', '2019-09-16 13:54:47');"
        );

        DB::insert(
            "INSERT INTO `customers` (`id`, `customers_id`, `name`, `address`, `limit`, `type`, `created_at`, `updated_at`) VALUES
            (1, 'cust-1', 'customer1', 'uttara dhaka', 20, 1, '2019-09-09 23:43:36', '2019-09-09 23:43:36'),
            (2, 'cust-2', 'customer2', 'Badda,dhaka', 30, 2, '2019-09-09 23:45:31', '2019-09-09 23:45:31'),
            (3, 'cs4', 'Customer 3', 'Badda, Dhaka', 30, 1, '2019-09-15 03:43:47', '2019-09-15 03:44:03');"
        );

        DB::insert(
            "INSERT INTO `purchases` (`id`, `vendor_id`, `memo_number`, `date`, `quantity`, `mark`, `ball`, `goods_of_issues`, `paid_money`, `balance_due`, `comment`, `created_at`, `updated_at`) VALUES
            (1, 1, '123', '10/11/2019', '1', '12', '2', 2.00, 2.00, 2.00, '2', '2019-10-11 17:51:42', '2019-10-11 17:51:42');"
        );

        DB::insert(
            "INSERT INTO `vendors` (`id`, `name`, `address`, `limit`, `type`, `created_at`, `updated_at`) VALUES
            (1, 'Test vendor', 'test address', 30, NULL, '2019-10-11 12:43:36', '2019-10-12 15:56:48');"
        );
    }
}
