<?php

namespace Plu\RerBundle\Controller;

use Plu\RerBundle\Field\EntityField;
use Plu\RerBundle\Field\IntegerField;
use Plu\RerBundle\Field\StringField;
use Plu\RerBundle\Forge\Callback\CallbackRealEntityFactory;
use Plu\RerBundle\Forge\EntityBlueprint;
use Plu\RerBundle\Forge\EntityForge;
use Plu\RerBundle\Forge\ProtoEntityFactory;
use Plu\RerBundle\Forge\RealEntityFactory;
use Plu\RerBundle\Matcher\Entity\ExactEntityMatcher;
use Plu\RerBundle\Matcher\Integer\RangeIntegerMatcher;
use Plu\RerBundle\Matcher\String\ExactStringMatcher;
use Plu\RerBundle\Repository\FileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;


/**
 * @Route("/test")
 */
class TestController extends Controller
{

    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function testAction()
    {
        $repo = $this->getGameRepository();

        var_dump($repo->count());

        $repo2 = $this->getPersonRepository();
        var_dump($repo2->count());

        return array('games' => $repo->searchFor($repo->getProtoEntity()));
    }

    /**
     * @Route("/filtered", name="filtered")
     * @Template()
     */
    public function filteredAction()
    {
        $repo = $this->getGameRepository();
        $repo2 = $this->getPersonRepository();

        $proto2 = $repo2->getProtoEntity();
        $matcher = new ExactStringMatcher();
        $matcher->setValue('Derp mcDerp');
        $proto2->setName($matcher);

        $proto = $repo->getProtoEntity();

        $matcher = new ExactEntityMatcher();
        $matcher->setValue($proto2);
        $proto->setOwner($matcher);

        return array('games' => $repo->searchFor($proto));
    }

    /**
     * @Route("/add", name="add")
     */
    public function addAction()
    {

        $repo = $this->getGameRepository();

        $entity = $repo->newEntity();
        $entity->setName('Lascaux');
        $entity->setMinPlayers(3);
        $entity->setMaxPlayers(5);

        $repo2 = $this->getPersonRepository();
        $proto = $repo2->getProtoEntity();
        $matcher = new ExactStringMatcher();
        $matcher->setValue('Derp mcDerp');
        $proto->setName($matcher);
        $person = $repo2->searchFor($proto)[0];

        $entity->setOwner($person);
        $repo->persist($entity);


        /*
        $repo = $this->getGameRepository();

        $entity = $repo->newEntity();
        $entity->setName('RISK');
        $entity->setMinPlayers(2);
        $entity->setMaxPlayers(6);

        $repo2 = $this->getPersonRepository();
        $person = $repo2->newEntity();
        $person->setName("Herp Derpins");
        $person->setAge(15);

        $repo2->persist($person);
        $entity->setOwner($person);
        $repo->persist($entity);
*/
        return $this->redirect($this->generateUrl('index'));
    }

    private function getGameRepository()
    {
        return new FileRepository($this->getGameBlueprint(), new EntityForge(new ProtoEntityFactory(), new CallbackRealEntityFactory()), 'wherever');
    }

    private function getGameBlueprint()
    {
        $blueprint = new EntityBlueprint();
        $blueprint->addField(new StringField('Name'));
        $blueprint->addField(new IntegerField('MinPlayers'));
        $blueprint->addField(new IntegerField('MaxPlayers'));
        $blueprint->addField(new EntityField('Owner', 'person'));
        $blueprint->setEntityName('game');
        return $blueprint;
    }

    private function getPersonRepository()
    {
        return new FileRepository($this->getPersonBlueprint(), new EntityForge(new ProtoEntityFactory(), new CallbackRealEntityFactory()), 'whatever');
    }

    private function getPersonBlueprint()
    {
        $blueprint = new EntityBlueprint();
        $blueprint->addField(new StringField('Name'));
        $blueprint->addField(new IntegerField('Age'));
        $blueprint->setEntityName('person');
        return $blueprint;
    }


}
