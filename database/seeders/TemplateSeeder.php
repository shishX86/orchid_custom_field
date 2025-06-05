<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('templates')->insert([
            [
                'name' => 'Хэдер',
                'slug' => 'header',
                'visibility' => 'global',
                'content' => '[{"id": 1, "data": {"key": "qwe", "name": "qwe"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 15, "data": {"key": "аввап", "name": "ываыва"}, "title": "Повторитель полей", "value": "repeater", "isLeaf": false, "children": [{"id": 1, "data": {"key": "ппп", "name": "ыва"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 1, "data": {"key": "вапап", "name": "ыапыв"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": true}], "isSelected": false}]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Футер',
                'slug' => 'footer',
                'visibility' => 'global',
                'content' => '[{"id": 1, "data": {"key": "qwe", "name": "qwe"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 15, "data": {"key": "аввап", "name": "ываыва"}, "title": "Повторитель полей", "value": "repeater", "isLeaf": false, "children": [{"id": 1, "data": {"key": "ппп", "name": "ыва"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 1, "data": {"key": "вапап", "name": "ыапыв"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": true}], "isSelected": false}]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Слайдер',
                'slug' => 'slider',
                'visibility' => 'local',
                'content' => '[{"id": 1, "data": {"key": "qwe", "name": "qwe"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 15, "data": {"key": "аввап", "name": "ываыва"}, "title": "Повторитель полей", "value": "repeater", "isLeaf": false, "children": [{"id": 1, "data": {"key": "ппп", "name": "ыва"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 1, "data": {"key": "вапап", "name": "ыапыв"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": true}], "isSelected": false}]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'FAQ',
                'slug' => 'faq',
                'visibility' => 'local',
                'content' => '[{"id": 1, "data": {"key": "qwe", "name": "qwe"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 15, "data": {"key": "аввап", "name": "ываыва"}, "title": "Повторитель полей", "value": "repeater", "isLeaf": false, "children": [{"id": 1, "data": {"key": "ппп", "name": "ыва"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 1, "data": {"key": "вапап", "name": "ыапыв"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": true}], "isSelected": false}]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Баннер',
                'slug' => 'home',
                'visibility' => 'local',
                'content' => '[{"id": 1, "data": {"key": "qwe", "name": "qwe"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 15, "data": {"key": "аввап", "name": "ываыва"}, "title": "Повторитель полей", "value": "repeater", "isLeaf": false, "children": [{"id": 1, "data": {"key": "ппп", "name": "ыва"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": false}, {"id": 1, "data": {"key": "вапап", "name": "ыапыв"}, "title": "Текстовое поле", "value": "text", "isLeaf": true, "isSelected": true}], "isSelected": false}]',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
