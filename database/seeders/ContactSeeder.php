<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run()
    {
        Contact::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'nguyenvana@example.com',
            'subject' => 'Hỏi hàng',
            'message' => 'Xin hỏi còn hàng không?',
        ]);

        Contact::create([
            'name' => 'Trần Thị B',
            'email' => 'tranthib@example.com',
            'subject' => 'Hợp tác',
            'message' => 'Liên hệ hợp tác kinh doanh.',
        ]);
    }
}
