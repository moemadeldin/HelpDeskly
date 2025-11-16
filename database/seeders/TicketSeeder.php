<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

final class TicketSeeder extends Seeder
{
    public function run(): void
    {
        // Get the user and category
        $user = User::where('id', '019a7155-42cc-72d4-a667-3a7f383eb7ed')->first();
        // $category = Category::where('id', '019a7400-cb7e-7157-8833-dd237ec4cbe0')->first();
        $category = Category::where('id', '019a7687-fd20-7207-bc6d-889fad1fb626')->first();

        if (! $user || ! $category) {
            $this->command->error('User or Category not found. Please run UserSeeder and CategorySeeder first.');

            return;
        }

        // $tickets = [
        //     [
        //         'id' => '019a7450-1234-5678-9abc-def123456789',
        //         'subject' => 'Unable to login to my account',
        //         'description' => 'I\'m having trouble logging into my account. When I enter my credentials, I get an error message saying "Invalid credentials" even though I\'m sure my password is correct. I\'ve tried resetting my password but haven\'t received any email.',
        //         'user_id' => $user->id,
        //         'category_id' => $category->id,
        //         'status' => TicketStatus::OPEN->value,
        //         'priority' => TicketPriority::HIGH->value,
        //         'created_at' => now()->subDays(2),
        //         'updated_at' => now()->subDays(2),
        //     ],
        //     [
        //         'id' => '019a7450-2345-6789-0abc-def234567890',
        //         'subject' => 'Feature request: Dark mode option',
        //         'description' => 'I would like to request a dark mode feature for the application. The current bright interface is straining my eyes during night-time usage. Many users would benefit from this accessibility feature. Please consider adding this in future updates.',
        //         'user_id' => $user->id,
        //         'category_id' => $category->id,
        //         'status' => TicketStatus::IN_PROGRESS->value,
        //         'priority' => TicketPriority::LOW->value,
        //         'created_at' => now()->subDays(5),
        //         'updated_at' => now()->subDays(1),
        //     ],
        //     [
        //         'id' => '019a7450-3456-7890-1abc-def345678901',
        //         'subject' => 'Payment processing failed',
        //         'description' => 'I tried to upgrade my subscription today but the payment failed multiple times. My credit card has sufficient funds and is valid. The error message says "Payment gateway timeout". I\'ve attached screenshots of the error message and my payment details.',
        //         'user_id' => $user->id,
        //         'category_id' => $category->id,
        //         'status' => TicketStatus::OPEN->value,
        //         'priority' => TicketPriority::HIGH->value,
        //         'created_at' => now()->subHours(3),
        //         'updated_at' => now()->subHours(3),
        //     ],
        //     [
        //         'id' => '019a7450-4567-8901-2abc-def456789012',
        //         'subject' => 'Mobile app crashing on startup',
        //         'description' => 'The mobile application crashes immediately after opening on my iPhone 14 Pro running iOS 17.2. I\'ve tried reinstalling the app multiple times but the issue persists. This started happening after the latest app update. Other apps on my phone are working fine.',
        //         'user_id' => $user->id,
        //         'category_id' => $category->id,
        //         'status' => TicketStatus::IN_PROGRESS->value,
        //         'priority' => TicketPriority::MEDIUM->value,
        //         'created_at' => now()->subDays(1),
        //         'updated_at' => now()->subHours(6),
        //     ],
        //     [
        //         'id' => '019a7450-5678-9012-3abc-def567890123',
        //         'subject' => 'Data export not working correctly',
        //         'description' => 'When I try to export my project data to CSV, the exported file is missing some columns and the dates are formatted incorrectly. The export process completes without errors, but the resulting file doesn\'t match what I see in the application. I need this data for my monthly reporting.',
        //         'user_id' => $user->id,
        //         'category_id' => $category->id,
        //         'status' => TicketStatus::RESOLVED->value,
        //         'priority' => TicketPriority::MEDIUM->value,
        //         'resolved_at' => now()->subDays(1),
        //         'created_at' => now()->subDays(7),
        //         'updated_at' => now()->subDays(1),
        //     ],
        //     [
        //         'id' => '019a7450-6789-0123-4abc-def678901234',
        //         'subject' => 'API rate limiting too strict',
        //         'description' => 'The current API rate limiting of 100 requests per hour is too restrictive for our integration needs. We frequently hit the limit during peak business hours. Could you please consider increasing the limit or providing a way to request higher limits for business accounts?',
        //         'user_id' => $user->id,
        //         'category_id' => $category->id,
        //         'status' => TicketStatus::CLOSED->value,
        //         'priority' => TicketPriority::LOW->value,
        //         'closed_at' => now()->subDays(2),
        //         'created_at' => now()->subDays(14),
        //         'updated_at' => now()->subDays(2),
        //     ],
        // ];
        $tickets = [
            [
                'id' => '019a7450-1234-5678-9abc-def123256789',
                'subject' => 'Unable to process payment for my subscription',
                'description' => 'I\'m unable to make the payment for my subscription renewal. Every time I try, I get an error saying "Payment failed" even though my credit card details are correct. Can you please check and resolve this issue?',
                'user_id' => $user->id,
                'category_id' => $category->id,  // Assuming you have a billing-related category for this
                'status' => TicketStatus::OPEN->value,
                'priority' => TicketPriority::HIGH->value,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'id' => '019a7450-2345-6789-0abc-def214567890',
                'subject' => 'Refund request for overcharged subscription',
                'description' => 'I was charged an extra amount this month for my subscription. I believe I was billed incorrectly for an upgrade that I didn’t make. Please issue a refund for the overcharged amount and confirm when this will be processed.',
                'user_id' => $user->id,
                'category_id' => $category->id,  // Billing category
                'status' => TicketStatus::IN_PROGRESS->value,
                'priority' => TicketPriority::MEDIUM->value,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(1),
            ],
            [
                'id' => '019a7450-3456-7890-1abc-def645678901',
                'subject' => 'Subscription downgrade issue',
                'description' => 'I tried to downgrade my subscription from Premium to Basic, but I was still charged for the Premium plan. Could you please verify and adjust the charges accordingly? The downgrade was processed, but the billing did not reflect the change.',
                'user_id' => $user->id,
                'category_id' => $category->id,  // Billing category
                'status' => TicketStatus::OPEN->value,
                'priority' => TicketPriority::HIGH->value,
                'created_at' => now()->subHours(3),
                'updated_at' => now()->subHours(3),
            ],
            [
                'id' => '019a7450-4567-8901-2abc-def486789012',
                'subject' => 'Billing cycle not reflecting correctly',
                'description' => 'I have noticed that my billing cycle is not being correctly reflected in my account settings. The billing is being processed earlier than expected. Can you please check and fix the billing cycle to match the renewal date I selected?',
                'user_id' => $user->id,
                'category_id' => $category->id,  // Billing category
                'status' => TicketStatus::IN_PROGRESS->value,
                'priority' => TicketPriority::MEDIUM->value,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(6),
            ],
            [
                'id' => '019a7450-5678-9012-3abc-def507890123',
                'subject' => 'Unable to apply discount code to my order',
                'description' => 'I tried to apply a discount code to my order but received an error saying the code is invalid. The discount was advertised as available for my subscription plan, so I would like to know why it is not working and how I can get the discount applied.',
                'user_id' => $user->id,
                'category_id' => $category->id,  // Billing category
                'status' => TicketStatus::RESOLVED->value,
                'priority' => TicketPriority::MEDIUM->value,
                'resolved_at' => now()->subDays(1),
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(1),
            ],
            [
                'id' => '019a7450-6789-0123-4abc-def578901234',
                'subject' => 'Incorrect charge for add-on feature',
                'description' => 'I was recently charged for an add-on feature that I did not subscribe to. Can you please look into this charge and adjust my account accordingly? I did not authorize this additional fee.',
                'user_id' => $user->id,
                'category_id' => $category->id,  // Billing category
                'status' => TicketStatus::CLOSED->value,
                'priority' => TicketPriority::LOW->value,
                'closed_at' => now()->subDays(2),
                'created_at' => now()->subDays(14),
                'updated_at' => now()->subDays(2),
            ],
        ];

        foreach ($tickets as $ticket) {
            Ticket::updateOrCreate(
                ['id' => $ticket['id']],
                $ticket
            );
        }

        $this->command->info('Successfully seeded '.count($tickets).' tickets.');
    }
}
