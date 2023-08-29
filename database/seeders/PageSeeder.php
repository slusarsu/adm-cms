<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::query()->create([
            'title' => 'Contacts',
            'slug' => 'contacts',
            'short' => "<p><span style=\"color: #333333; font-family: 'Work Sans', sans-serif; font-size: 16px; background-color: #ffffff;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labor.</span></p>",
            'custom_fields' => [
                [
                    "data" => [
                        "text" => "hello@reporter.com",
                        "field_name" => "email"
                    ],
                    "type" => "text_input"
                ],
                [
                    "data" => [
                        "text" => "+211234565523",
                        "field_name" => "phone"
                    ],
                    "type" => "text_input"
                ],
                [
                    "data" => [
                        "text" => "9567 Turner Trace Apt. BC C3G8A4",
                        "field_name" => "address"
                    ],
                    "type" => "text_input"
                ],
                [
                    "data" => [
                        "text" => "Mtwstsqf0sLQccF",
                        "field_name" => "form_hash"
                    ],
                    "type" => "text_input"
                ],
                [
                    "data" => [
                        "text" => "Send Message",
                        "field_name" => "form_button_text"
                    ],
                    "type" => "text_input"
                ],
            ],
            'images' => [],
            'template' => 'contacts',
            'is_enabled' => 1,
            'views' => rand(5,400),
        ]);

        Page::query()->create([
            'title' => 'About',
            'slug' => 'about',
            'short' => "<p><span style=\"color: #333333; font-family: 'Work Sans', sans-serif; font-size: 16px; background-color: #ffffff;\">Hello, I&rsquo;m John Doe. A Content writter, Developer and Story teller. Working as a Content writter at CoolTech Agency. Quam nihil &hellip;</span></p>",
            'content' => "<p><span style=\"color: #333333; font-family: 'Work Sans', sans-serif; font-size: 16px; background-color: #ffffff;\">Hello, I&rsquo;m John Doe. A Content writter, Developer and Story teller. Working as a Content writter at CoolTech Agency. Quam nihil enim maxime corporis cumque totam aliquid nam sint inventore optio modi neque laborum officiis necessitatibus, facilis placeat pariatur! Voluptatem, sed harum pariatur adipisci voluptates voluptatum cumque, porro sint minima similique magni perferendis fuga! Optio vel ipsum excepturi tempore reiciendis id quidem? Vel in, doloribus debitis nesciunt fugit sequi magnam accusantium modi neque quis, vitae velit, pariatur harum autem a! Velit impedit atque maiores animi possimus asperiores natus repellendus excepturi sint architecto eligendi non, omnis nihil. Facilis, doloremque illum. Fugit optio laborum minus debitis natus illo perspiciatis corporis voluptatum rerum laboriosam.</span></p>
<blockquote>
<p><span style=\"color: #333333; font-family: 'Work Sans', sans-serif; font-size: 20px; font-style: italic; background-color: #ffffff;\">Facilis, doloremque illum. Fugit optio laborum minus debitis natus illo perspiciatis corporis voluptatum rerum laboriosam.</span></p>
</blockquote>
<p><span style=\"color: #333333; font-family: 'Work Sans', sans-serif; font-size: 16px; background-color: #ffffff;\">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam nihil enim maxime corporis cumque totam aliquid nam sint inventore optio modi neque laborum officiis necessitatibus, facilis placeat pariatur! Voluptatem, sed harum pariatur adipisci voluptates voluptatum cumque, porro sint minima similique magni perferendis fuga! Optio vel ipsum excepturi tempore reiciendis id quidem.</span></p>",
            'custom_fields' => [
                [
                    "data" => [
                        "text" => "John Doe",
                        "field_name" => "name"
                    ],
                    "type" => "text_input"
                ],
                [
                    "data" => [
                        "text" => "Know More",
                        "field_name" => "button_text"
                    ],
                    "type" => "text_input"
                ]
            ],
            'images' => [],
            'template' => 'about-me',
            'is_enabled' => 1,
            'views' => rand(5,400),
        ]);

        Page::query()->create([
            'title' => 'Our Privacy Policy',
            'slug' => 'privacy-policy',
            'short' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus. Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra se",
            'content' => '<h4 id="responsibility-of-contributors">Responsibility of Contributors</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus. Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra sed</p>
						<p>pretium, aliquam sit. Praesent elementum magna amet, tincidunt eros, nibh in leo. Malesuada purus, lacus, at aliquam suspendisse tempus. Quis tempus amet, velit nascetur sollicitudin. At sollicitudin eget amet in. Eu velit nascetur sollicitudin erhdfvssfvrgss eget viverra nec elementum. Lacus, facilisis tristique lectus in.</p>
						<h4 id="gathering-of-personal-information">Gathering of Personal Information</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus. Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra sed</p>
						<h4 id="protection-of--personal--information">Protection of Personal- Information</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus.</p>
						<p>Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra sed Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat</p>
						<h4 id="privacy-policy-changes">Privacy Policy Changes</h4>
						<ol>
							<li>Sll the Themefisher items are designed to be with the latest , We check all</li>
							<li>comments that threaten or harm the reputation of any person or organization</li>
							<li>personal information including, but limited to, email addresses, telephone numbers</li>
							<li>Any Update come in The technology Customer will get automatic Notification.</li>
						</ol>',
            'images' => [],
            'template' => 'page',
            'is_enabled' => 1,
            'views' => rand(5,400),
        ]);

        Page::query()->create([
            'title' => 'Terms And Conditions',
            'slug' => 'terms-conditions',
            'short' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus. Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra se",
            'content' => '<h4 id="responsibility-of-contributors">Responsibility of Contributors</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus. Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra sed</p>
						<p>pretium, aliquam sit. Praesent elementum magna amet, tincidunt eros, nibh in leo. Malesuada purus, lacus, at aliquam suspendisse tempus. Quis tempus amet, velit nascetur sollicitudin. At sollicitudin eget amet in. Eu velit nascetur sollicitudin erhdfvssfvrgss eget viverra nec elementum. Lacus, facilisis tristique lectus in.</p>
						<h4 id="gathering-of-personal-information">Gathering of Personal Information</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus. Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra sed</p>
						<h4 id="protection-of--personal--information">Protection of Personal- Information</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat quisque aliquam sagittis. Sem turpis sed viverra massa gravida pharetra. Non dui dolor potenti eu dignissim fusce. Ultrices amet, in curabitur a arcu a lectus morbi id. Iaculis erat sagittis in tortor cursus.</p>
						<p>Molestie urna eu tortor, erat scelerisque eget. Nunc hendrerit sed interdum lacus. Lorem quis viverra sed Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus, donec nunc eros, ullamcorper id feugiat</p>
						<h4 id="privacy-policy-changes">Privacy Policy Changes</h4>
						<ol>
							<li>Sll the Themefisher items are designed to be with the latest , We check all</li>
							<li>comments that threaten or harm the reputation of any person or organization</li>
							<li>personal information including, but limited to, email addresses, telephone numbers</li>
							<li>Any Update come in The technology Customer will get automatic Notification.</li>
						</ol>',
            'images' => [],
            'template' => 'page',
            'is_enabled' => 1,
            'views' => rand(5,400),
        ]);
    }
}
