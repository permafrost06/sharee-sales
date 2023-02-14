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
            (1, 'admin', NULL, NULL, 'admin', NULL, 'admin@admin.com', NULL, '\$2y$10\$pqSsKcTaktmaiubX/.ZhP.6fuz8IxHqyo8jBiiB3YEMwCUFCn1CrW', 'woKxxNKYi4QEDvmi0tjqJbx8CqibJonpUHE10E4rgYQHAPApi7jfLqA5kSHP', '2019-09-09 23:10:28', '2019-09-09 23:10:28'),
            (2, 'Saad', NULL, NULL, 'admin', NULL, 'test@example.com', NULL, '\$2y$10\$OErG.mAlpq7cOWNZnEV5GOkpBBu0MpxHA9n1Rug.F/NOWIaqMPqN2', 'isthisnecessary', '2019-09-09 23:10:28', '2019-09-09 23:10:28')"
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

        DB::insert(
            "INSERT INTO `stocks` (`id`, `type`, `brand`, `item_code`, `quantity`, `supplier_name`, `supplier_contact`, `carrier_name`, `carrier_contact`, `border`, `remarks`, `attachment`, `date_time`, `created_at`, `updated_at`) VALUES
            (1, 'in', 'Charkha', '1789', 25, 'Anshu Goyen', '+919331215598', 'Nazmul Bepari', '+8801717061437', 'Benapol', NULL, NULL, '2023-02-14 06:41:00', '2023-02-14 00:47:29', '2023-02-14 00:47:29'),
            (2, 'in', 'Julahaa', '1783', 12, 'Yogesh', NULL, 'Arafat', '+8801600203143', 'Khulna', '2 days late', '/storage/uploads/attachment/attachment_1676357299.png', '2023-02-14 06:47:00', '2023-02-14 00:48:19', '2023-02-14 00:55:55'),
            (3, 'out', 'Charkha', '1789', 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-14 06:49:00', '2023-02-14 00:49:53', '2023-02-14 00:57:17');"
        );
    }
}
