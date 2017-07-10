<?php

use Illuminate\Database\Seeder;

class TemplateFactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('factory_templates')->insert([
            "name" => "nouveau",
            "slug" => "nouveau-template",
            "area_id" => 0,
            "object" => "Objet de ma lettre",
            "content" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur delectus hic impedit modi, natus soluta totam voluptatibus. Dolores facere illum ipsum iusto nobis officia perspiciatis, quasi suscipit ut velit! Excepturi!
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur numquam rem rerum. Cum dolores eos, iure magni molestias pariatur quae quaerat quam quis, quo quod reiciendis reprehenderit, repudiandae vel voluptatibus.
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid aperiam cum distinctio doloremque ex exercitationem facere harum numquam odit quia quo ratione rem repudiandae sed, tempore totam, vero, voluptate?"
        ]);
    }
}
