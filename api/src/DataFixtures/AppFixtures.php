<?php

namespace App\DataFixtures;

use App\Entity\Catalogue;
use App\Entity\Group;
use App\Entity\Product;
use App\Entity\Supplier;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Ramsey\Uuid\Uuid;

class AppFixtures extends Fixture
{
    private function loadSupplier(
        string $name,
        string $sourceOrganisation,
        string $kvk,
        ?string $logo,
        ObjectManager $manager
    ): Supplier {
        $supplier = new Supplier();
        $supplier->setName($name);
        $supplier->setSourceOrganization($sourceOrganisation);
        $supplier->setKvk($kvk);
        if ($logo) {
            $supplier->setLogo($logo);
        }
        $manager->persist($supplier);

        return $supplier;
    }

    private function loadCatalogue(
        string $name,
        string $sourceOrganisation,
        ?string $description,
        ?string $logo,
        ObjectManager $manager
    ): Catalogue {
        $catalogue = new Catalogue();
        $catalogue->setName($name);
        $catalogue->setSourceOrganization($sourceOrganisation);
        if ($description) {
            $catalogue->setDescription($description);
        }
        if ($logo) {
            $catalogue->setLogo($logo);
        }
        $manager->persist($catalogue);
        return $catalogue;
    }

    public function load(ObjectManager $manager)
    {
        // Catalogi
        $vng = new Catalogue();
        $vng->setName('Vereniging Nederlandse Gemeenten');
        $vng->setSourceOrganization('0000');
        $manager->persist($vng);

        $denbosch = new Catalogue();
        $denbosch->setName('Gemeente \'s-Hertogenbosch');
        $denbosch->setSourceOrganization('001709124');
        $manager->persist($denbosch);

        $eindhoven = new Catalogue();
        $eindhoven->setName('Gemeente Eindhoven');
        $eindhoven->setSourceOrganization('001902763');
        $manager->persist($eindhoven);

        $utrecht = new Catalogue();
        $utrecht->setName('Gemeente Utrecht');
        $utrecht->setSourceOrganization('002220647');
        $manager->persist($utrecht);

        $manager->flush();

        // Dan wat productgroepen
        $id = Uuid::fromString('5a6a1219-1e2d-4dc5-aa03-82ffe1ff6249');
        $burgerzakenDenBosh = new Group();
        $burgerzakenDenBosh->setName('Burgerzaken');
        $burgerzakenDenBosh->setDescription('Alle producten met betrekking tot burgerzaken');
        $burgerzakenDenBosh->setSourceOrganization('001709124');
        $burgerzakenDenBosh->setCatalogue($denbosch);
        $manager->persist($burgerzakenDenBosh);
        //
        $burgerzakenDenBosh->setId($id);
        $manager->persist($burgerzakenDenBosh);
        $manager->flush();
        $manager->refresh($burgerzakenDenBosh);

        $id = Uuid::fromString('d1cc2c8c-c87d-4bb1-b468-9546b4ce29a5');
        $burgerzakerEindhoven = new Group();
        $burgerzakerEindhoven->setName('Burgerzaken');
        $burgerzakerEindhoven->setDescription('Alle producten met betrekking tot burgerzaken');
        $burgerzakerEindhoven->setSourceOrganization('1234567');
        $burgerzakerEindhoven->setCatalogue($eindhoven);
        $manager->persist($burgerzakerEindhoven);
        //
        $burgerzakerEindhoven->setId($id);
        $manager->persist($burgerzakerEindhoven);
        $manager->flush();
        $manager->refresh($burgerzakerEindhoven);

        $id = Uuid::fromString('1138c620-223e-4def-ac84-f21a46369d56');
        $burgerzakenUtrecht = new Group();
        $burgerzakenUtrecht->setName('Burgerzaken');
        $burgerzakenUtrecht->setDescription('Alle producten met betrekking tot burgerzaken');
        $burgerzakenUtrecht->setSourceOrganization('002220647');
        $burgerzakenUtrecht->setCatalogue($utrecht);
        $manager->persist($burgerzakenUtrecht);
        //
        $burgerzakenUtrecht->setId($id);
        $manager->persist($burgerzakenUtrecht);
        $manager->flush();
        $manager->refresh($burgerzakenUtrecht);

        $id = Uuid::fromString('0c1f993d-f9e2-46c5-8d83-0b6dfb702069');
        $trouwenUtrecht = new Group();
        $trouwenUtrecht->setName('Trouwproducten');
        $trouwenUtrecht->setDescription('Alle producten met betrekking tot burgerzaken');
        $trouwenUtrecht->setSourceOrganization('002220647');
        $trouwenUtrecht->setCatalogue($utrecht);
        $manager->persist($trouwenUtrecht);
        //
        $trouwenUtrecht->setId($id);
        $manager->persist($trouwenUtrecht);
        $manager->flush();
        $manager->refresh($trouwenUtrecht);

        $id = Uuid::fromString('7f4ff7ae-ed1b-45c9-9a73-3ed06a36b9cc');
        $trouwenAmbtenarenUtrecht = new Group();
        $trouwenAmbtenarenUtrecht->setName('Trouwambtenaren');
        $trouwenAmbtenarenUtrecht->setDescription('<p>Een trouwambtenaar heet officieel een buitengewoon ambtenaar van de burgerlijke stand (babs ). Een babs waarmee het klikt is belangrijk. Hieronder stellen de babsen van de gemeente Utrecht zich aan u voor. U kunt een voorkeur aangeven voor een van hen, dan krijgt u data te zien waarop die babs beschikbaar is. Wanneer u een babs heeft gekozen zal deze na de melding voorgenomen huwelijk, zelf contact met u opnemen.</p>
        		
    <p>Kiest u liever voor een babs uit een andere gemeente? Of voor een vriend of familielid als trouwambtenaar? Dan kunt u hem of haar laten benoemen tot trouwambtenaar voor 1 dag bij de gemeente Utrecht. Dit kunt u hier ook opgeven.</p>
        		
    <p>Bij een gratis of een eenvoudig huwelijk of geregistreerd partnerschap kunt u niet zelf een babs kiezen, de gemeente wijst er een toe.</p>');
        $trouwenAmbtenarenUtrecht->setSourceOrganization('002220647');
        $trouwenAmbtenarenUtrecht->setCatalogue($utrecht);
        $manager->persist($trouwenAmbtenarenUtrecht);

        $trouwenAmbtenarenUtrecht->setId($id);
        $manager->persist($trouwenAmbtenarenUtrecht);
        $manager->flush();
        $manager->refresh($trouwenAmbtenarenUtrecht);

        $id = Uuid::fromString('170788e7-b238-4c28-8efc-97bdada02c2e');
        $trouwenLocatiesUtrecht = new Group();
        $trouwenLocatiesUtrecht->setName('Trouwlocaties');
        $trouwenLocatiesUtrecht->setDescription('<p>Een trouwlocatie; in Utrecht is er voor elk wat wils. De gemeente Utrecht heeft een aantal eigen trouwlocaties; het Stadhuis, het Wijkservicecentrum in Vleuten en het Stadskantoor. Een keuze voor een van deze trouwlocaties kunt u direct hier doen.</p>
        		
<p>Daarnaast zijn er verschillende andere vaste trouwlocaties. Deze trouwlocaties zijn door de gemeente Utrecht al goedgekeurd. Hieronder vindt u het overzicht van deze trouwlocaties. Heeft u een keuze gemaakt uit een van de vaste trouwlocaties? Maak dan eerst een afspraak met de locatie en geef dan aan ons door waar en wanneer u wilt trouwen.</p>
        		
<p>Maar misschien wilt u een heel andere locatie. Bijvoorbeeld het caf&eacute; om de hoek, bij u thuis of in uw favoriete restaurant. Zo\'n locatie heet een vrije locatie. Een aanvraag voor een vrije locatie kunt u hier ook doen.</p>');
        $trouwenLocatiesUtrecht->setSourceOrganization('002220647');
        $trouwenLocatiesUtrecht->setCatalogue($utrecht);
        $manager->persist($trouwenLocatiesUtrecht);

        $trouwenLocatiesUtrecht->setId($id);
        $manager->persist($trouwenLocatiesUtrecht);
        $manager->flush();
        $manager->refresh($trouwenLocatiesUtrecht);

        $id = Uuid::fromString('1cad775c-c2d0-48af-858f-a12029af24b3');
        $trouwenCeremoniersUtrecht = new Group();
        $trouwenCeremoniersUtrecht->setName('Ceremonies');
        $trouwenCeremoniersUtrecht->setDescription('Verschillende ceremonies voor uw huwelijk / partnerschap');
        $trouwenCeremoniersUtrecht->setSourceOrganization('002220647');
        $trouwenCeremoniersUtrecht->setCatalogue($utrecht);
        $manager->persist($trouwenCeremoniersUtrecht);
        //
        $trouwenCeremoniersUtrecht->setId($id);
        $manager->persist($trouwenCeremoniersUtrecht);
        $manager->flush();
        $manager->refresh($trouwenLocatiesUtrecht);

        $id = Uuid::fromString('f8298a12-91eb-46d0-b8a9-e7095f81be6f');
        $trouwenExtraUtrecht = new Group();
        $trouwenExtraUtrecht->setName('Extra producten');
        $trouwenExtraUtrecht->setDescription('Extra producten voor bij uw huwelijk');
        $trouwenExtraUtrecht->setSourceOrganization('002220647');
        $trouwenExtraUtrecht->setCatalogue($utrecht);
        $manager->persist($trouwenExtraUtrecht);
        //
        $trouwenExtraUtrecht->setId($id);
        $manager->persist($trouwenExtraUtrecht);
        $manager->flush();
        $manager->refresh($trouwenExtraUtrecht);

        $manager->clear();

        $trouwenExtraUtrecht = $manager->getRepository('App:Group')->findOneBy(['id'=> 'f8298a12-91eb-46d0-b8a9-e7095f81be6f']);
        $trouwenCeremoniersUtrecht = $manager->getRepository('App:Group')->findOneBy(['id'=> '1cad775c-c2d0-48af-858f-a12029af24b3']);
        $trouwenLocatiesUtrecht = $manager->getRepository('App:Group')->findOneBy(['id'=> '170788e7-b238-4c28-8efc-97bdada02c2e']);
        $trouwenAmbtenarenUtrecht = $manager->getRepository('App:Group')->findOneBy(['id'=> '7f4ff7ae-ed1b-45c9-9a73-3ed06a36b9cc']);
        $trouwenUtrecht = $manager->getRepository('App:Group')->findOneBy(['id'=> '0c1f993d-f9e2-46c5-8d83-0b6dfb702069']);
        $burgerzakenUtrecht = $manager->getRepository('App:Group')->findOneBy(['id'=> '1138c620-223e-4def-ac84-f21a46369d56']);

        $id = Uuid::fromString('d1a8b316-5966-4a29-8cf7-be15b8302301');
        $product = new Product();
        $product->setName('Trouwen / Partnerschap');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Trouwen');
        $product->setType('set');
        $product->setCatalogue($utrecht);
        $product->setPrice('627.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenCeremoniersUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('16353702-4614-42ff-92af-7dd11c8eef9f');
        $product = new Product();
        $product->setName('Eenvoudig Trouwen');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Eenvoudig Trouwen');
        $product->setType('set');
        $product->setCatalogue($utrecht);
        $product->setPrice('163.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        //$product->setParent($trouwen);
        $manager->persist($product);
        $product->setAudience("public");
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenCeremoniersUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('190c3611-010d-4b0e-a31c-60dadf4d1c62');
        $product = new Product();
        $product->setName('Gratis Trouwen');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Gratis Trouwen');
        $product->setType('set');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        //$product->setParent($trouwen);
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenCeremoniersUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('1edd4d62-d778-452a-8b2a-ac22f3dcdf4d');
        $product = new Product();
        $product->setName('Dhr Erik Hendrik');
        $product->setSourceOrganization('002220647');
        $product->setDescription('<p>Als Buitengewoon Ambtenaar van de Burgerlijke Stand geef ik, in overleg met het bruidspaar, invulling aan de huwelijksceremonie.</p>');
        $product->setType('person');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://huwelijksplanner.online/images/content/ambtenaar/erik.jpg');
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenAmbtenarenUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('477ea744-47b1-4690-bd2e-c9c15d5cf2d4');
        $product = new Product();
        $product->setName('Mvr Ike van den Pol');
        $product->setSourceOrganization('002220647');
        $product->setDescription('<p>Elkaar het Ja-woord geven, de officiële ceremonie. Vaak is dit het romantische hoogtepunt van de trouwdag. Een bijzonder moment, gedeeld met de mensen die je lief zijn. Een persoonlijke ceremonie, passend bij jullie relatie. Alles is bespreekbaar en maatwerk. Een originele trouwplechtigheid waar muziek, sprekers en kinderen een rol kunnen spelen. Een ceremonie met inhoud, ernst en humor, een traan en een lach, stijlvol, spontaan en ontspannen.</p>');
        $product->setType('person');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://huwelijksplanner.online/images/content/ambtenaar/ike.jpg');
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenAmbtenarenUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('4f7c5d73-0fcb-4363-9ebb-fd47e2209148');
        $product = new Product();
        $product->setName('Dhr. Rene Gulje');
        $product->setSourceOrganization('002220647');
        $product->setDescription('<p>Ik ben Rene Gulje, in 1949 in Amsterdam geboren. Ik studeerde Nederlands aan de UVA en journalistiek aan de HU.</p>');
        $product->setType('person');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://huwelijksplanner.online/images/content/ambtenaar/rene.jpg');
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenAmbtenarenUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('55af09c8-361b-418a-af87-df8f8827984b');
        $product = new Product();
        $product->setName('Toegewezen Trouwambtenaar');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Uw trouwambtenaar wordt toegewezen, over enkele dagen krijgt u bericht van uw toegewezen trouwambtenaar!');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://huwelijksplanner.online/images/content/ambtenaar/trouwambtenaar.jpg');
        $product->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenAmbtenarenUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('ea984e7b-0d0d-48ff-86ea-bd5d15286ae7');
        $product = new Product();
        $product->setName('Stagair Trouwambtenaar');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Een stagair trouwambtenaar wordt aan uw huwelijk toegewezen.');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://huwelijksplanner.online/images/content/ambtenaar/trouwambtenaar.jpg');
        $product->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $product->setAudience("internal");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenAmbtenarenUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        /*
        $id = Uuid::fromString('5a0ad366-9f10-4002-adcb-bac47143b93b');
        $product = new Product();
        $product->setName(v);
        $product->setSourceOrganization('002220647');
        $product->setDescription('U draagt zelf een trouwambtenaar voor en laat deze voor een dag be�digd'));
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('150.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://utrecht.trouwplanner.online/images/content/ambtenaar/trouwambtenaar.jpg');
        $product->setMovie('https://www.youtube.com/embed/RkBZYoMnx5w');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product= $manager->getRepository('App:Product')->findOneBy(array('id'=> $id));
        foreach ([$trouwenUtrecht, $trouwenAmbtenarenUtrecht] as $group) {
        	$product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();
        */

        $id = Uuid::fromString('7a3489d5-2d2c-454b-91c9-caff4fed897f');
        $product = new Product();
        $product->setName('Stadskantoor');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Deze locatie is speciaal voor eenvoudige en gratis huwelijken.
 De zaal ligt op de 6e etage van het Stadskantoor.
 De ruimte is eenvoudig en toch heel intiem.
 Het licht is in te stellen op een kleur die jullie graag willen.');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://www.utrecht.nl/fileadmin/uploads/documenten/9.digitaalloket/Burgerzaken/Trouwzaal-Stadskantoor-Utrecht.jpg');
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenLocatiesUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('7ebcc7a9-ce12-401b-b3a1-18497c54d79d');
        $product = new Product();
        $product->setName('Stadhuis kleine zaal');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Deze uiterst sfeervolle trouwzaal maakt de dag compleet');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://www.utrecht.nl/fileadmin/uploads/documenten/9.digitaalloket/Burgerzaken/kleine-trouwzaal-stadhuis-utrecht.jpg');
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        $manager->persist($product);
        foreach ([$trouwenUtrecht, $trouwenLocatiesUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('9d7c1c5b-3e65-4429-90ec-16e7371f2360');
        $product = new Product();
        $product->setName('Stadhuis grote zaal');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Deze uiterst sfeervolle trouwzaal maakt de dag compleet');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setLogo('https://www.utrecht.nl/fileadmin/uploads/documenten/9.digitaalloket/Burgerzaken/grote-trouwzaal-stadhuis-utrecht.jpg');
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenLocatiesUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('c7b556bb-a2f0-471c-9ff9-37543bc4d843');
        $product = new Product();
        $product->setName('Vrije locatie');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Vrije locatie');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenLocatiesUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('d7bd202b-27ae-4c09-aeb9-3806c5fba504');
        $product = new Product();
        $product->setName('Trouwboekje');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Een mooi in leer gebonden herinnering aan uw huwelijk');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('30.20');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        foreach ([$trouwenUtrecht, $trouwenExtraUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $id = Uuid::fromString('1fa3fbbc-0dee-442a-8431-3381b8cbc78a');
        $product = new Product();
        $product->setName('Ringen');
        $product->setSourceOrganization('002220647');
        $product->setDescription('Het uitwisselen van ringen tijdens de huwelijksceremonie');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('10.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setMovie('https://www.youtube.com/embed/DAaoMvj1Qbs');
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);

        foreach ([$trouwenUtrecht, $trouwenExtraUtrecht] as $group) {
            $product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();
        
        $id = Uuid::fromString('a6bbfcb3-e87d-4f6f-98da-821b71e45912');
        $product = new Product();
        $product->setName('Geen extra\'s');
        $product->setSourceOrganization('002220647');
        $product->setDescription('U wilt geen extra producten bij uw huwelijk');
        $product->setType('simple');
        $product->setCatalogue($utrecht);
        $product->setPrice('0.00');
        $product->setPriceCurrency('EUR');
        $product->setTaxPercentage(0);
        $product->setRequiresAppointment(false);
        $product->setAudience("public");
        $manager->persist($product);
        $product->setId($id);
        $manager->persist($product);
        $manager->flush();
        $product = $manager->getRepository('App:Product')->findOneBy(['id'=> $id]);
        
        foreach ([$trouwenUtrecht, $trouwenExtraUtrecht] as $group) {
        	$product->addGroup($group);
        }
        $manager->persist($product);
        $manager->flush();

        $manager->flush();
    }
}
