<?php

namespace Database\Seeders;

use App\Models\Membership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run()
    {
        // Create the root user (First Referral)
        $root = Membership::create([
            'referal_id' => 'BSE1100',
            'membership_id' => 'ROOT001',
            'user_id' => 1,
            'name' => 'Root User',
        ]);

        // Create Left Child
        $leftChild = Membership::create([
            'referal_id' => 'BSE1101',
            'membership_id' => 'LEFT001',
            'user_id' => 2,
            'name' => 'Left Child',
            'parent_id' => $root->id,
        ]);

        // Create Right Child
        $rightChild = Membership::create([
            'referal_id' => 'BSE1102',
            'membership_id' => 'RIGHT001',
            'user_id' => 3,
            'name' => 'Right Child',
            'parent_id' => $root->id,
        ]);

        // Assign left and right child to root
        $root->left_id = $leftChild->id;
        $root->right_id = $rightChild->id;
        $root->save();

        // Create another level (Left Child's left)
        $leftLeftChild = Membership::create([
            'referal_id' => 'BSE1103',
            'membership_id' => 'LEFT002',
            'user_id' => 4,
            'name' => 'Left Child - Left',
            'parent_id' => $leftChild->id,
        ]);

        // Assign child to Left Node
        $leftChild->left_id = $leftLeftChild->id;
        $leftChild->save();
    }

}
