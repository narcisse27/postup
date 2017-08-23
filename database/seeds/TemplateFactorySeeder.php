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
            "email_object" => "Objet de mon email",
            "email_content" => "<p>Je vous propose ma candidature spontanée pour un poste de… . Afin que vous puissiez en savoir plus sur mes compétences et\"+
                \"mes motivations, je vous joins mon CV et ma lettre de motivation.\"+
                \"Disponible dans les plus brefs délais, je suis à votre disposition pour d’éventuelles informations complémentaires.\"+
                \"Cordialement\"+
                \"Prénom Nom\"+
                \"Numéro de téléphone</p>",
            "object" => "Objet de ma lettre",
            "content" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur delectus hic impedit modi, natus soluta totam voluptatibus. Dolores facere illum ipsum iusto nobis officia perspiciatis, quasi suscipit ut velit! Excepturi!
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur numquam rem rerum. Cum dolores eos, iure magni molestias pariatur quae quaerat quam quis, quo quod reiciendis reprehenderit, repudiandae vel voluptatibus.
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aliquid aperiam cum distinctio doloremque ex exercitationem facere harum numquam odit quia quo ratione rem repudiandae sed, tempore totam, vero, voluptate?"
        ]);
    }
}
