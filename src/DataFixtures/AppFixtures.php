<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Group;
use App\Entity\Media;
use App\Entity\Figure;
use App\Entity\Message;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
 
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // USERS 
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setLastName('DOE '.$i);
            $user->setFirstName('John');
            $user->setEmail('doe.john'.$i.'@gmail.com');
            $user->setRoles(['ROLE_USER']);
            $password = uniqid();
            $encoded = $this->encoder->encodePassword($user, $password);
            $user->setPassword($encoded);
            
            $mediaUser = $this->newImage(300,300, null, true);
            $manager->persist($mediaUser);

            $user->setImage($mediaUser);
            $manager->persist($user);
        }

        // GROUPS 
        for ($i = 0; $i < 3; $i++) {
            $group = new Group();
            $group->setName('Groupe '.$i);
            $manager->persist($group);
        }

        $manager->flush();

        $allUsers = $manager->getRepository(User::class)->findAll();
        $allGroups = $manager->getRepository(Group::class)->findAll();

        // FIGURES 
        for($i = 0; $i < 9; $i++) {
            $figure = new Figure();
            $figure->setName('Figure '.$i);

            $description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Mauris velit libero, facilisis non imperdiet eu, vehicula id ex. Proin sodales sagittis diam quis consequat.";

            $figure->setDescription($description);

            $date = new \DateTime(); 
            $figure->setCreatedAt($date);
            $figure->setUpdatedAt($date);

            $mediaPrincipal = $this->newImage(1000,400);
            $manager->persist($mediaPrincipal);
            $figure->setFeaturedImage($mediaPrincipal);

            $indice = $i % 3;

            $figure->setGroup($allGroups[$indice]);
            $figure->setUser($allUsers[$indice]);

            for($j = 0; $j < 3; $j++) {
                $message = new Message();
                $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit libero, facilisis non imperdiet eu, vehicula id ex.";
                $message->setContent($content);
                $message->setAddAt($date);
                $message->setFigure($figure);

                $newIndice = $j % 3;
                $message->setUser($allUsers[$newIndice]);
                $manager->persist($message);

                $image = $this->newImage(1000,400, $figure);
                $manager->persist($image);
            }
        }

        $manager->flush();
    }

    /**
     * Add Image
     * @param Int $width
     * @param Int $height
     * @param Figure|null $figure
     * @return Media $media
     */
    public function newImage($width, $height, $figure = null, $forUser = false)
    {
        $media = new Media();
        $media->setName('User One Media');

        if($figure != null){
            $media->setFigure($figure);
        }

        if($figure != null || $forUser = true) {
            $media->setUrl('https://fakeimg.pl/'.$width.'x'.$height);
            $media->setIsImage(false);

            return $media;
        }

        $media->setImgSrc('https://fakeimg.pl/'.$width.'x'.$height);
        $media->setIsImage(true);

        return $media;
    }
}
