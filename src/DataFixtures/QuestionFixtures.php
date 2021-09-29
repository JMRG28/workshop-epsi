<?php

namespace App\DataFixtures;

use App\Entity\Cour;
use App\Entity\Question;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class QuestionFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $c1 = new Cour();
        $c1->setIntitule("Mail")
        ->setTextcours("La technique du phishing est une technique d'« ingénierie sociale » c'est-à-dire consistant à exploiter non pas une faille informatique mais la « faille humaine » en dupant les internautes par le biais d'un courrier électronique semblant provenir d'une entreprise de confiance, typiquement une banque ou un site de commerce.

        Le mail envoyé par ces pirates usurpe l'identité d'une entreprise (banque, site de commerce électronique, etc.) et les invite à se connecter en ligne par le biais d'un lien hypertexte et de metre à jour des informations les concernant dans un formulaire d'une page web factice, copie conforme du site original, en prétextant par exemple une mise à jour du service, une intervention du support technique, etc.
        
        Dans la mesure où les adresses électroniques sont collectées au hasard sur Internet, le message a généralement peu de sens puisque l'internaute n'est pas client de la banque de laquelle le courrier semble provenir. Mais sur la quantité des messages envoyés il arrive que le destinataire soit effectivement client de la banque.
        
        Ainsi, par le biais du formulaire, les pirates réussissent à obtenir les identifiants et mots de passe des internautes ou bien des données personnelles ou bancaires (numéro de client, numéro de compte en banque, etc.).
        
        Grâce à ces données les pirates sont capables de transférer directement l'argent sur un autre compte ou bien d'obtenir ultérieurement les données nécessaires en utilisant intelligemment les données personnelles ainsi collectées.
        
        Lorsque vous recevez un message provenant a priori d'un établissement bancaire ou d'un site de commerce électronique il est nécessaire de vous poser les questions suivantes :
        
        Ai-je communiqué à cet établissement mon adresse de messagerie ?
        Le courrier reçu possède-t-il des éléments personnalisés permettant d'identifier sa véracité (numéro de client, nom de l'agence, etc.) ?
        Par ailleurs il est conseillé de suivre les conseils suivants :
        
        Ne cliquez pas directement sur le lien contenu dans le mail, mais ouvrez votre navigateur et saisissez vous-même l'URL d'accès au service.
        Méfiez-vous des formulaires demandant des informations bancaires.
        Il est en effet rare (voire impossible) qu'une banque vous demande des renseignements aussi importants par un simple courrier électronique. Dans le doute contactez directement votre agence par téléphone !
        Assurez-vous, lorsque vous saisissez des informations sensibles, que le navigateur est en mode sécurisé, c'est-à-dire que l'adresse dans la barre du navigateur commence par https et qu'un petit cadenas est affiché dans la barre d'état au bas de votre navigateur, et que le domaine du site dans l'adresse correspond bien à celui annoncé (gare à l'orthographe du domaine) !
        ");
        $manager->persist($c1);
        $q1 = new Question(); 
        $q1->setEnonce("Vous recevez un mail provenant de SFR")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Facile");
        $manager->persist($q1);
        $q2 = new Question(); 
        $q2->setEnonce("Vous recevez un mail de votre banque Banque Populaire <noreply@banquepopulaire.frx> que faîtes-vous ?")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Facile");
        $manager->persist($q2);
        $q3 = new Question(); 
        $q3->setEnonce("Vous êtes raccordé à une agence pour votre habitation et vous recevez une pièce jointe provenant du mail de l'agence présente sur le contrat : immobilierdelaplage@gmail.com, vous l'ouvrez ? ")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Facile");
        $manager->persist($q3);
        $q4 = new Question(); 
        $q4->setEnonce("Vous savez que vous devez recevoir un remboursement des impôts concernant une erreur dans votre déclaration ,cliquez-vous sur le lien reçu depuis ce mail ?")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Moyen");
        $manager->persist($q4);
        $q5 = new Question(); 
        $q5->setEnonce("Que faîtes vous ?")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Moyen");
        $manager->persist($q5);
        $q6 = new Question(); 
        $q6->setEnonce("Ce mail en provenance de SFR vous semble-t-il normal ?")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Moyen");
        $manager->persist($q6);
        $q7 = new Question(); 
        $q7->setEnonce("Ce mail en provenance de Chronopost vous semble-t-il normal ?")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Moyen");
        $manager->persist($q7);
        $q8= new Question(); 
        $q8->setEnonce("Qu'est-ce que le phishing")
        ->setTheme("Mail")
        ->setCour($c1)
        ->setDifficulte("Difficile");
        $manager->persist($q8);
        $q9 = new Question(); 
        $q9->setEnonce("Vous êtes dans l'attente de réception d'un mail d'une personne de votre entourage, enregistrez vous la pièce jointe ci-dessus présente dans le mail ?")
        ->setCour($c1)
        ->setTheme("Mail")
        ->setDifficulte("Difficile");
        $manager->persist($q9);
        ;
        $q10 = new Question(); 
        $q10->setEnonce("Jsp")
        ->setDifficulte("Difficile")
        ->setCour($c1)
        ->setTheme("Mail");
        $manager->persist($q10);
        
        $manager->flush();
    }
}
