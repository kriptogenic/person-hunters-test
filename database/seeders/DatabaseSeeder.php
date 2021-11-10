<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createCategories();
        $this->createPosts();
        $this->attachCategories();
    }

    private function createCategories()
    {
        $categories = [
            [
                'name' => 'Society',
                'children' => [
                    [
                        'name' => 'City life'
                    ],
                    [
                        'name' => 'Elections'
                    ]
                ]
            ],
            [
                'name' => 'Day of the city',
                'children' => [
                    [
                        'name' => 'Fireworks',
                    ],
                    [
                        'name' => 'Playground',
                        'children' => [
                            [
                                'name' => '0-3 years'
                            ],
                            [
                                'name' => '3-7 years'
                            ],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Sports'
            ],
        ];
        $i = 0;
        foreach ($categories as $category) {
            $i = $this->addCategory($category, $i);
        }
    }

    private function addCategory($category, int $i, int $parent_id = null): int
    {
        $children = $category['children'] ?? [];
        $category = Category::create([
            'name' => $category['name'],
            'left' => ++$i,
            'parent_id' => $parent_id
        ]);
        foreach ($children as $child) {
            $i = $this->addCategory($child, $i, $category->id);
        }
        $category->right = ++$i;
        $category->save();
        return $i;
    }

    private function createPosts()
    {
        Post::factory()->count(30)->create();
    }

    private function attachCategories()
    {
        $categories = Category::all();
        Post::all()->each(function (Post $post) use ($categories) {
            $post->categories()->attach($categories->random(rand(2,3)));
            $post->save();
        });
    }
}
