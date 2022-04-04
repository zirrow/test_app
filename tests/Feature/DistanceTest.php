<?php

namespace Tests\Feature;

use Tests\TestCase;

class DistanceTest extends TestCase
{

    /**
     * Testing hamming url
     *
     * @return void
     */
    public function testHamming()
    {
        $response = $this->post('/api/hamming/submit', [
            'first_string' => 'this is test',
            'second_string' => 'the is test'
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'value' => 2,
            ]);
    }

    /**
     * Testing levenshtein url
     *
     * @return void
     */
    public function testLevenshtein()
    {
        $response = $this->post('/api/levenshtein/submit', [
            'first_string' => 'this is a test',
            'second_string' => 'this is test'
        ]);
        $response
            ->assertStatus(200)
            ->assertJson([
                'value' => 2,
            ]);
    }
}

